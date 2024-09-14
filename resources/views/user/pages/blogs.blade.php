@extends('user.layouts.master')

@section('title')
    <title>Blogs - Investorbhai</title>
@endsection

@section('left-col-span', 'col-span-12')

@section('content')
    <!-- Blog Section -->
    <section class="bg-gray-100 py-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Latest Blogs</h1>

            @if ($blogs->isEmpty())
                <p class="text-center text-lg text-gray-600">No blogs available at the moment. Check back later!</p>
            @else
                <!-- Blog Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($blogs as $blog)
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <!-- Blog Image -->
                            <a href="{{ route('blog.details', $blog->slug) }}">
                                <img class="w-full h-48 md:h-64 lg:h-80 object-cover" src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">

                            </a>

                            <!-- Blog Content -->
                            <div class="p-6">
                                <!-- Blog Title -->
                                <h2 class="text-lg font-semibold text-gray-800 hover:text-blue-500 mb-2">
                                    <a href="{{ route('blog.details', $blog->slug) }}">{{ Str::limit($blog->title, 60) }}</a>
                                </h2>

                                <!-- Blog Meta Info -->
                                <div class="mt-2 text-gray-600 text-sm">
                                    <span>By <span class="font-medium">{{ $blog->user->name }}</span></span>
                                    <span> on {{ $blog->created_at->format('M d, Y') }}</span>
                                </div>

                                <!-- Blog Description -->
                                <p class="mt-3 text-gray-700 text-sm">
                                    {{ Str::limit(strip_tags($blog->description), 100) }}
                                </p>

                                <!-- Blog Tags -->
                                <div class="mt-4">
                                    @php
                                        $tags = explode(',', $blog->tags);
                                    @endphp
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($tags as $tag)
                                            <span class="inline-block bg-gray-200 text-xs text-gray-700 rounded-full px-3 py-1">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Read More Button -->
                                <div class="mt-4 text-center">
                                    <a href="{{ route('blog.details', $blog->slug) }}" class="inline-block bg-blue-500 text-white font-semibold px-4 py-2 rounded transition duration-200 hover:bg-blue-600">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
