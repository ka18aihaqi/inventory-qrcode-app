
    {{-- <div class="container">
        <h1>Detail Item</h1>
        <p><strong>Nama:</strong> {{ $item->name }}</p>
        <p><strong>Serial Number:</strong> {{ $item->serial_number }}</p>
        <p><strong>Kategori:</strong> {{ $item->category->name }}</p>
        <p><strong>Status:</strong> {{ $item->status }}</p>
        <p><strong>Lokasi:</strong> {{ $item->location->name }}</p>
        <img src="{{ asset('storage/' . $item->qr_code) }}" alt="QR Code">
    </div> --}}

@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid min-vh-100 d-flex flex-column">
        <div class="flex-grow-1 py-2">
            <div class="row justify-content-center mt-5">
                <div class="col-md-4">
                    <div class="card card-profile">
                        <img src="/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top bg-white">
                        <div class="row justify-content-center">
                            <div class="col-6 col-lg-6 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0" style="position: relative; top: -50px;">
                                    <a href="javascript:;">
                                        <img src="{{ asset('storage/' . $item->qr_code) }}" alt="QR Code"
                                            class="img-fluid" style="max-width: 300px; width: 100%;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="text-center mt-0">
                                <h5>{{ $item->name }}</h5>
                                <div class="h6 font-weight-300">
                                    <i class="ni location_pin mr-2"></i>{{ $item->serial_number }}
                                </div>
                                <div class="h6 mt-4">
                                    <i class="ni business_briefcase-24 mr-2"></i>{{ $item->category->name }}
                                </div>
                                <div class="h6 mt-4">
                                    <i class="ni business_briefcase-24 mr-2"></i>{{ $item->status }}
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>{{ $item->location->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- flex-grow-1 untuk mendorong footer ke bawah -->
    
        @include('layouts.footers.auth.footer')
    </div>
@endsection
