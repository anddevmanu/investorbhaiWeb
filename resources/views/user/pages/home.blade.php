@extends('user.layouts.master')

@section('title')
    <title>Investorbhai - Home</title>
@endsection

@section('content')
    <div class="main_content_wrapper">
        <!-- Content for the left side -->
        <h3 class='page-header border-bottom pb-2 mb-3 border-b'>Recently asked questions
        </h3>
        <div class="my-3 text-center">

        </div>

        {{-- IF NOT FOUND QUESTION --}}
        @include('user.components.NoFoundAnswer')
    </div>
@endsection
