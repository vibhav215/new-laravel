@extends('master')

@section('internal-style')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .carousel-inner img {
        width: 100%;
        height: 600px;
    }

    .carousel-caption {
        position: absolute;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 20px;
        width: 100%;
    }

    @media (max-width: 768px) {
        .carousel-caption {
            position: static;
            background-color: transparent;
            color: black;
            padding: 0;
            text-align: center;
        }
    }
</style>
@endsection

@section('site-content')
<div>
    <h1 style="font-family:Georgia; text-align: center; margin-top: 20px;">Welcome To <span style="color:red;">Our Project</span></h1>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2000">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-target="1000">
                <img src="{{asset('assets/images/A3.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Activity Tracker Management Tool</h3>
                    <p>Modern Task Need Modern Solution</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-target="1000">
                <img src="{{asset('assets/images/A4.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Activity Tracker Management Tool</h3>
                    <p>Modern Task Need Modern Solution</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-target="1000">
                <img src="{{asset('assets/images/A5.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Activity Tracker Management Tool</h3>
                    <p>Modern Task Need Modern Solution</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
@endsection
