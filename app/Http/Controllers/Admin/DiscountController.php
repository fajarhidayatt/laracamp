<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();

        return view('pages.admin.discount.index', [
            'discounts' => $discounts
        ]);
    }

    public function create()
    {
        return view('pages.admin.discount.create');
    }

    public function store(DiscountRequest $request)
    {
        $data = $request->validated();

        Discount::create($data);

        return redirect()->route('admin.discount.index');
    }

    public function edit(Discount $discount)
    {
        return view('pages.admin.discount.edit', [
            'discount' => $discount
        ]);
    }

    public function update(DiscountRequest $request, Discount $discount)
    {
        $data = $request->validated();

        $discount->update($data);

        return redirect()->route('admin.discount.index');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('admin.discount.index');
    }
}
