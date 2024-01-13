<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Mail\CheckoutSuccess;
use App\Models\Camp;
use App\Models\Checkout;
use App\Models\Discount;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    public function create(Request $request, Camp $camp)
    {
        /// jika sudah pernah mendaftar, arahkan ke dashboard
        if ($camp->isRegistered) {
            return redirect()->route('user.dashboard')
                ->with('error', "You already registered on <strong>{$camp->title}</strong> camp.");
        }

        $user = Auth::user();

        return view('pages.checkout', [
            'camp' => $camp,
            'user' => $user,
        ]);
    }

    public function store(CheckoutRequest $request, Camp $camp)
    {
        /// mapping request data
        $data = $request->validated();

        $data['user_id'] = Auth::id();
        $data['camp_id'] = $camp->id;

        /// update user data
        $user = User::findOrFail(Auth::id());
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->occupation = $data['occupation'];
        $user->phone_number = $data['phone_number'];
        $user->address = $data['address'];
        $user->save();

        /// jika menggunakan discount
        if ($request->discount) {
            $discount = Discount::whereCode($request->discount)->first();

            if ($discount) {
                $data['discount_id'] = $discount->id;
                $data['discount_percentage'] = $discount->percentage;
            }
        }

        /// create checkout
        $checkout = Checkout::create($data);

        /// get payment url midtrans
        $this->getSnapRedirect($checkout);

        /// sending email
        Mail::to(Auth::user()->email)->send(new CheckoutSuccess($checkout));

        return redirect()->route('checkout.success');
    }

    /**
     * Midtrans Handler
     */
    public function getSnapRedirect(Checkout $checkout)
    {
        $orderId = $checkout->id . '-' . Str::random(5);
        $price = $checkout->camp->price * 1000;

        $checkout->midtrans_booking_code = $orderId;

        $item_details[] = [
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Payment for {$checkout->camp->title} Camp"
        ];

        $discountPrice = 0;
        if ($checkout->discount) {
            $discountPrice = $price * $checkout->discount_percentage / 100;

            $item_details[] = [
                'id' => $checkout->discount->code,
                'price' => -$discountPrice,
                'quantity' => 1,
                'name' => "Discount {$checkout->discount->name} ({$checkout->discount_percentage}%)"
            ];
        }

        $total = $price - $discountPrice;
        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $total,
        ];

        $userData = [
            "first_name" => $checkout->user->name,
            "last_name" => "",
            "address" => $checkout->user->address,
            "city" => "",
            "postal_code" => "",
            "phone" => $checkout->user->phone_number,
            "country_code" => "IDN",
        ];

        $customer_details = [
            "first_name" => $checkout->user->name,
            "last_name" => "",
            "email" => $checkout->user->email,
            "phone" => $checkout->user->phone,
            "billing_address" => $userData,
            "shipping_address" => $userData,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $checkout->midtrans_url = $paymentUrl;
            $checkout->total = $total;
            $checkout->save();

            return $paymentUrl;
        } catch (Exception $e) {
            return false;
        }
    }

    public function midtransCallback(Request $request)
    {
        $orderId = $request->order_id;
        $notif = $request->method() == 'POST' ? new \Midtrans\Notification() : \Midtrans\Transaction::status($orderId);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $checkout_id = explode('-', $notif->order_id)[0];

        $checkout = Checkout::find($checkout_id);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $checkout->payment_status = 'pending';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $checkout->payment_status = 'paid';
            }
        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'failed';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'failed';
            }
        } else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $checkout->payment_status = 'failed';
        } else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $checkout->payment_status = 'paid';
        } else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $checkout->payment_status = 'pending';
        } else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $checkout->payment_status = 'failed';
        }

        $checkout->save();

        return redirect()->route('user.dashboard');
    }

    public function success()
    {
        return view('pages.checkout-success');
    }
}
