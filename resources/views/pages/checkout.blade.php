@extends('layouts.main')

@section('content')
    <section class="checkout">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">YOUR FUTURE CAREER</p>
                    <h2 class="primary-header">Start Invest Today</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-lg-5 col-12">
                            <div class="item-bootcamp">
                                <img src="{{ asset('images/item_bootcamp.png') }}" alt="camp image" class="cover">
                                <h1 class="package">GILA BELAJAR</h1>
                                <p class="description">
                                    Bootcamp ini akan mengajak Anda untuk belajar penuh mulai dari pengenalan dasar sampai
                                    membangun sebuah projek asli
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-1 col-12"></div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="mb-4">
                                <label for="occupation" class="form-label">Occupation</label>
                                <input type="text" class="form-control" id="occupation">
                            </div>
                            <div class="mb-4">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input type="number" class="form-control" id="card_number">
                            </div>
                            <div class="mb-5">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <label for="expired" class="form-label">Expired</label>
                                        <input type="text" class="form-control" id="expired">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="cvc" class="form-label">CVC</label>
                                        <input type="text" class="form-control" id="cvc">
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('checkout.success') }}" class="w-100 btn btn-primary">Pay Now</a>
                            <p class="text-center subheader mt-4">
                                <img src="{{ asset('images/ic_secure.svg') }}" alt=""> Your payment is secure and
                                encrypted.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
