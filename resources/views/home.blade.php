@extends('layouts.app')

@section('title')
Desaku
@endsection

@section('content')
<div class="page-content page-home">
    <!-- Carusel Section -->
    <section class="store-carousel" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#storeCarousel" data-slide-to="0">
                            </li>
                            <li data-target="#storeCarousel" data-slide-to="1">
                            </li>
                            <li data-target="#storeCarousel" data-slide-to="2">
                            </li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/images/banner2.jpg" alt="Carousel Img" class="d-block w-100">
                            </div>
                            <div class="carousel-item ">
                                <img src="/images/banner1.jpg" alt="Carousel Img" class="d-block w-100">
                            </div>
                            <div class="carousel-item ">
                                <img src="/images/banner3.jpg" alt="Carousel Img" class="d-block w-100">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="store-name">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="d-flex justify-content-center flex-row bd-highlight">
                        <div class="p-2 bd-highlight"><img src="/images/ceklis.svg" alt=""></div>
                        <div class="p-1 bd-highlight">
                            <h2> Official store</h2>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>