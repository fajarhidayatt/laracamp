@extends('layouts.main')

@section('content')
    <section class="checkout-success container vh-100 d-flex align-items-center justify-content-center">
        <div class="row text-center">
            <img src="{{ asset('images/ill_register.png') }}" alt="checkout-success">
            <div class="mt-5">
                <p class="story">WHAT A DAY!</p>
                <h2 class="primary-header">Berhasil Checkout</h2>
                <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-3">My Dashboard</a>
            </div>
        </div>
    </section>
@endsection
