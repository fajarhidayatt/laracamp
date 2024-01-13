@extends('layouts.main')

@section('content')
    <section class="checkout">
        <div class="container">
            <div class="row text-center mb-4 mt-5 mb-lg-5">
                <div class="col-12 header-wrap">
                    <p class="story">YOUR FUTURE CAREER</p>
                    <h2 class="primary-header">Start Invest Today</h2>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-12 col-xl-11 col-xxl-10">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-5 mb-5 mb-lg-0">
                            <div class="item-bootcamp">
                                <img src="{{ asset('images/item_bootcamp.png') }}" alt="camp image" class="cover">
                                <h1 class="package text-uppercase">{{ $camp->title }}</h1>
                                <p class="description">
                                    Bootcamp ini akan mengajak Anda untuk belajar penuh mulai dari pengenalan dasar sampai
                                    membangun sebuah projek asli
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <form action="{{ route('checkout.proccess', $camp->id) }}" method="post">
                                @csrf

                                <div class="mb-4">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input
                                        type="text"
                                        class="form-control rounded-pill @error('name') is-invalid @enderror"
                                        name="name"
                                        id="name"
                                        value="{{ $user->name }}"
                                        required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input
                                        type="email"
                                        class="form-control rounded-pill @error('email') is-invalid @enderror"
                                        name="email"
                                        id="email"
                                        value="{{ $user->email }}"
                                        readonly>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input
                                        type="text"
                                        class="form-control rounded-pill @error('occupation') is-invalid @enderror"
                                        name="occupation"
                                        id="occupation"
                                        value="{{ $user->occupation }}"
                                        required>
                                    @error('occupation')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input
                                        type="text"
                                        class="form-control rounded-pill @error('address') is-invalid @enderror"
                                        name="address"
                                        id="address"
                                        value="{{ $user->address }}">
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input
                                        type="number"
                                        class="form-control rounded-pill @error('phone_number') is-invalid @enderror"
                                        name="phone_number"
                                        id="phone_number"
                                        value="{{ old('phone_number') ?? $user->phone_number }}"
                                        required>
                                    @error('phone_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="discount" class="form-label">Discount Code</label>
                                    <input
                                        type="text"
                                        class="form-control rounded-pill @error('discount') is-invalid @enderror"
                                        name="discount"
                                        id="discount"
                                        maxlength="5"
                                        value="{{ old('discount') }}">
                                    @error('discount')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="w-100 btn btn-primary">Pay Now</button>
                                <p class="text-center subheader mt-4">
                                    <img src="{{ asset('images/ic_secure.svg') }}" alt="ic-secure">
                                    Your payment is secure and encrypted.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
