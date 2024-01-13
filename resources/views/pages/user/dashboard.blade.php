@extends('layouts.main')

@section('content')
    <section class="dashboard my-5">
        <div class="container">
            <div class="row text-left mb-3">
                <div class="header-wrap mt-4">
                    <p class="story">
                        DASHBOARD
                    </p>
                    <h2 class="primary-header ">
                        My Bootcamps
                    </h2>
                </div>
            </div>
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! session('error') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Desktop View --}}
            <div class="row d-none d-lg-block">
                <table class="table">
                    <tbody>
                        @forelse ($checkouts as $checkout)
                            <tr class="align-middle">
                                <td width="18%">
                                    <img src="{{ asset('images/item_bootcamp.png') }}" height="120" alt="camp thumbnail">
                                </td>
                                <td>
                                    <p class="mb-2">
                                        <strong>{{ $checkout->camp->title }}</strong>
                                    </p>
                                    <p>
                                        {{ $checkout->created_at->format('d M Y') }}
                                    </p>
                                </td>
                                <td>
                                    <strong>
                                        Rp. {{ $checkout->total }}
                                        @if ($checkout->discount_id)
                                            <span class="badge bg-success">Disc {{ $checkout->discount_percentage }}%</span>
                                        @endif
                                    </strong>
                                </td>
                                <td>
                                    <strong>{{ $checkout->payment_status }}</strong>
                                </td>
                                <td>
                                    @if ($checkout->payment_status == 'waiting')
                                        <a href="{{ $checkout->midtrans_url }}" class="btn btn-primary">Pay Here</a>
                                    @else
                                        <a href="#" class="btn btn-primary">
                                            Get Invoice
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5">No Camp Register</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile View --}}
            <div class="row d-block d-lg-none">
                @forelse ($checkouts as $checkout)
                    <div class="mb-4 d-flex">
                        <img src="{{ asset('images/item_bootcamp.png') }}" height="120" alt="camp thumbnail">
                        <div class="d-flex flex-column px-3 py-2">
                            <strong>{{ $checkout->camp->title }}</strong>
                            <strong>
                                Rp. {{ $checkout->total }}
                                @if ($checkout->discount_id)
                                    <span class="badge bg-success">Disc {{ $checkout->discount_percentage }}%</span>
                                @endif
                            </strong>
                            <div class="mt-2">
                                @if ($checkout->payment_status == 'waiting')
                                    <a href="{{ $checkout->midtrans_url }}" class="btn btn-primary btn-sm">Pay Here</a>
                                @else
                                    <a href="#" class="btn btn-sm btn-primary">
                                        Get Invoice
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center mt-5">
                        No Camp Register
                    </p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
