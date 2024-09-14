@extends('user.layouts.master')

@section('title')
    <title>Contact Us - Investorbhai</title>
@endsection

@section('left-col-span', 'col-span-12')

@section('content')
    <div class="contact p-6">
        @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Left Section: Contact Form and Text -->
            <div class="contact-left">
                <div class="contact-text mb-6">
                    <h1 class="text-3xl font-bold mb-2">Get in Touch</h1>
                    <p class="text-lg">Contact us to get free consultation with top experts.</p>
                </div>
                <div class="contact-form">
                    <form method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <input type="text" name="first_name" placeholder="First Name"
                            class="w-full mb-4 p-3 border border-gray-300 rounded-md" required />
                        <input type="text" name="last_name" placeholder="Last Name"
                            class="w-full mb-4 p-3 border border-gray-300 rounded-md" />
                        <input type="email" name="email" id="email-address" placeholder="Email"
                            class="w-full mb-4 p-3 border border-gray-300 rounded-md" required />
                        <input type="tel" name="telephone" id="telephone" placeholder="Phone"
                            class="w-full mb-4 p-3 border border-gray-300 rounded-md" />
                        <textarea name="message" placeholder="Say! What's Your Query?" id="message"
                            class="w-full mb-4 p-3 border border-gray-300 rounded-md" rows="5"></textarea>
                        <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-500">
                            Submit
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Section: Contact Image -->
            <div class="contact-right">
                <img src="{{ asset('frontend/img/about/contact.jpg') }}" alt="contact-img"
                    class="w-full h-auto rounded shadow-md">
            </div>
        </div>
    </div>
@endsection
