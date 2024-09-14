@extends('user.layouts.master')

@section('title')
    <title>About Us - Investorbhai</title>
@endsection

@section('left-col-span', 'col-span-12')

@section('content')
    <div class="about p-6">
        <div class="about-main grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="about-left">
                <h1 class="text-2xl font-bold mb-4">Know More About Us</h1>
                <p class="text-lg leading-relaxed mb-4">
                    Are you ready to embark on a journey towards financial prosperity
                    and independence? Look no further, because InvestorBhai is here to
                    guide you every step of the way. Whether you're a seasoned
                    investor or just starting to explore the world of finance, we're
                    your trusted partner on the path to building a brighter financial
                    future.
                </p>
                <div class="social flex space-x-4 text-2xl text-gray-700 mb-4">
                    <a href="#" class="hover:text-blue-600"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="hover:text-blue-400"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="hover:text-blue-700"><i class="fa fa-linkedin"></i></a>
                    <a href="#" class="hover:text-pink-500"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="hover:text-blue-500"><i class="fa fa-telegram"></i></a>
                </div>
                <span class="block text-lg font-semibold mb-4">Get in touch with our financial experts..</span>
                <a href="/contact" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">
                    Get Free Trial
                    <i class="fas fa-arrow-alt-circle-right ml-2"></i>
                </a>
            </div>
            <div class="about-right">
                <img src="{{ asset('frontend/img/about/trd.webp') }}" alt="about-img" class="rounded shadow-md">
            </div>
        </div>
    </div>
@endsection
