<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::with(['camp', 'user'])->get();

        return view('pages.admin.checkout.index', [
            'checkouts' => $checkouts
        ]);
    }
}
