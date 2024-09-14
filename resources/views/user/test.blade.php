@extends('user.layouts.master')

@section('title')
    <title>{{ $blog->meta_title ?? 'Blog Details - Investorbhai' }}</title>
@endsection

@section('meta-tags')
    <meta name="description" content="{{ $blog->meta_description ?? 'Read our latest blog post.' }}">
    <meta name="keywords" content="{{ $blog->meta_keywords ?? 'blog, latest news, updates' }}">
    <meta property="og:title" content="{{ $blog->meta_title ?? $blog->title }}">
    <meta property="og:description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->description), 150) }}">
    <meta property="og:image" content="{{ asset($blog->image) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $blog->meta_title ?? $blog->title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->description), 150) }}">
    <meta name="twitter:image" content="{{ asset($blog->image) }}">
@endsection

@section('left-col-span', 'col-span-9')

@section('content')
    <!-- Blog Details Section -->
    <section class="py-8 bg-gray-100">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="flex flex-wrap lg:flex-nowrap">
                <!-- Blog Content -->
                <div class="lg:w-2/3">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <!-- Blog Image -->
                        <img class="w-full h-96 object-cover" src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">

                        <!-- Blog Title and Meta Info -->
                        <div class="p-6">
                            <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $blog->title }}</h1>
                            <div class="text-gray-600 mb-4">
                                <span>By <span class="font-medium">{{ $blog->user->name }}</span></span>
                                <span> on {{ $blog->created_at->format('M d, Y') }}</span>
                            </div>

                            <!-- Blog Content -->
                            <div class="text-gray-700 mb-6">
                                {!! $blog->description !!}
                            </div>

                            <!-- Blog Tags -->
                            <div class="mb-6">
                                @php
                                    $tags = explode(',', $blog->tags);
                                @endphp
                                @foreach ($tags as $tag)
                                    <span class="inline-block bg-gray-200 text-xs text-gray-700 rounded-full px-3 py-1 mr-2">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Comments</h2>

                        <!-- Add Comment Form -->
                        <form action="#" method="POST">
                            @csrf
                            <div class="mb-4">
                                <textarea name="comment" rows="4" class="w-full px-4 py-2 border rounded-md" placeholder="Add your comment..."></textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
                        </form>

                        <!-- Display Comments -->
                        @foreach ($blog->comments as $comment)
                            <div class="mt-4 bg-gray-50 p-4 rounded-md shadow-sm">
                                <div class="font-medium text-gray-800">{{ $comment->user->name }}</div>
                                <div class="text-gray-600">{{ $comment->created_at->format('M d, Y') }}</div>
                                <p class="mt-2">{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3 lg:pl-6">
                    <!-- Popular Blogs -->
                    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Popular Blogs</h2>
                        <ul>
                            @foreach ($popularBlogs as $popular)
                                <li class="mb-4">
                                    <a href="{{ route('blog.details', $popular->slug) }}" class="text-blue-500 hover:underline">
                                        {{ Str::limit($popular->title, 50) }}
                                    </a>
                                    <p class="text-gray-600 text-sm">{{ $popular->created_at->format('M d, Y') }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Tags List -->
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Tags</h2>
                        <div class="flex flex-wrap">
                            {{-- @foreach ($allTags as $tag)
                                <a href="{{ route('blog.tag', $tag->slug) }}" class="bg-gray-200 text-xs text-gray-700 rounded-full px-3 py-1 mr-2 mb-2 inline-block hover:bg-gray-300">
                                    {{ $tag->name }}
                                </a>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Blogs -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Related Blogs</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($relatedBlogs as $related)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <a href="{{ route('blog.details', $related->slug) }}">
                                <img class="w-full h-48 object-cover" src="{{ asset($related->image) }}" alt="{{ $related->title }}">
                            </a>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                    <a href="{{ route('blog.details', $related->slug) }}">{{ Str::limit($related->title, 60) }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm">{{ $related->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
