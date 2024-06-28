@extends('layouts.master')
@push('css')
    <style>
        .hero-section {
            background-color: #282c34;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .features-section {
            padding: 50px 0;
        }
    </style>
@endpush
@section('content')
    <div class="hero-section">
        <div class="container">
            <h1>
                Welcome to Gouda AI
                <i class="fa-brands fa-rocketchat mx-1"></i>

            </h1>
            <p>Your Gateway to the Future of Artificial Intelligence</p>
            <a href="{{route('setting.create')}}" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </div>

    <div class="features-section">
        <div class="container">
            <h2 class="text-center mb-5">Our Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Feature One</h5>
                            <p class="card-text">Description of the first feature.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Feature Two</h5>
                            <p class="card-text">Description of the second feature.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Feature Three</h5>
                            <p class="card-text">Description of the third feature.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

