@extends('layouts.main')

@section('content')
    <section class="login-user vw-100 vh-100 overflow-hidden">
        <div class="row">
            <div class="left vh-100 col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                <img src="{{ asset('images/ill_login_new.png') }}" alt="">
            </div>
            <div
                class="right vh-100 col-12 col-lg-6 d-flex flex-column align-items-center justify-content-center p-4 mx-auto">
                <a href="{{ route('home') }}" class="align-self-start">
                    <img src="{{ asset('images/logo.png') }}" class="logo" alt="logo">
                </a>
                <div class="align-self-start mt-4">
                    <h1 class="header-third">Start Today</h1>
                    <p class="subheader">Because tomorrow become never</p>
                </div>
                <a href="{{ route('login.google') }}" class="btn btn-border btn-google-login my-5">
                    <img src="{{ asset('images/ic_google.svg') }}" class="icon" alt="google">
                    Sign In with Google
                </a>
                <img src="{{ asset('images/people.png') }}" class="people" alt="">
            </div>
        </div>
    </section>
@endsection
