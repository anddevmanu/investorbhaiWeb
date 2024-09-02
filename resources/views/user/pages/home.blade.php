@extends('user.layouts.master')

@section('title')
    <title>Investorbhai - Home</title>
@endsection

@section('left-col-span', 'col-span-9')

@section('content')
    <div class="main_content_wrapper">
        <!-- Content for the left side -->
        <h3 class='page-header border-bottom pb-2 mb-3 border-b'>Recently Asked Questions</h3>

        <div id="post-container">
            @forelse($posts as $post)
                <div class="bg-white shadow-md rounded-lg mb-4">
                    <div class="px-4 py-2 bg-gray-100 border-b">
                        <p class="text-lg font-semibold m-0 mx-2">
                            <a href="{{ url('/questions/' . $post->slug) }}" class="text-blue-600 hover:underline">
                                {{ $post->title }}
                            </a>
                        </p>
                        @if (auth()->check() && (auth()->user()->role == 'editor' || auth()->user()->role == 'admin'))
                            <a href="{{ url('/user/questions/edit/' . $post->id) }}"
                                class="text-white bg-green-600 hover:bg-green-500 px-2 ml-3 mt-4 rounded-md float-right">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endif
                    </div>
                    <div class="px-4 py-2">
                        <span class="bg-green-500 text-white text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                            <i class="fa fa-check mr-1"></i>
                        </span>
                        <span class="bg-blue-500 text-white text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                            <i class="fa fa-eye mr-1"></i> {{ $post->views }}
                        </span>
                        <span class="bg-blue-500 text-white text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                            <i class="fa fa-thumbs-up mr-1"></i> {{ $post->likes }}
                        </span>

                        @php
                            $tags = json_decode($post->tags, true);
                        @endphp

                        @if ($tags && is_array($tags))
                            @foreach ($tags as $tag)
                                <span
                                    class="bg-gray-200 text-gray-700 text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        @endif
                        <span class="bg-yellow-400 text-gray-800 text-sm rounded-full px-2 py-1 float-right">
                            {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y') }}
                        </span>
                    </div>
                </div>
            @empty
                @include('user.components.NoFoundAnswer')
            @endforelse
        </div>

        <div class="my-3 text-center">
            @if ($posts->hasMorePages())
                <button id="load-more" class="bg-blue-500 px-4 py-2 rounded-lg text-white hover:bg-blue-600"
                    data-page="{{ $posts->currentPage() + 1 }}" data-url="{{ $posts->nextPageUrl() }}">Load More
                </button>
            @endif
        </div>

        @include('user.components.NoFoundAnswer')
    </div>
@endsection

@section('right-sidebar')
    @include('user.components.mostPopularQuestion')
    <section class='my-3 tags'>
        <h3 class='page-header border-bottom pb-2 mb-3'>Tags</h3>
        @php

            $tags = $posts
                ->flatMap(function ($post) {
                    return json_decode($post->tags, true);
                })
                ->unique()
                ->toArray();
        @endphp
        @if ($tags && is_array($tags) && count($tags) > 0)
            <div class="flex flex-wrap gap-2">
                @foreach ($tags as $tag)
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $tag }}</span>
                @endforeach
            </div>
        @else
            <p>No tags available.</p>
        @endif
    </section>
    {{-- CALCULATOR --}}
    @include('user.components.calculator')

    <script>
        $(document).ready(function() {

            $('#load-more').click(function() {
                var button = $(this);
                console.log("Working", button);
                var page = button.data('page');
                var url = button.data('url');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        if (data.data.length > 0) {
                            var posts = '';

                            $.each(data.data, function(index, post) {
                                var formattedDate = new Date(post.created_at)
                                    .toLocaleDateString('en-US', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    });

                                posts += `
                            <div class="bg-white shadow-md rounded-lg mb-4">
                                <div class="px-4 py-2 bg-gray-100 border-b">
                                    <p class="text-lg font-semibold m-0">
                                        <a href="/questions/${post.slug}" class="text-blue-600 hover:underline">${post.title}</a>
                                    </p>
                                    @if (auth()->check() && (auth()->user()->role == 'editor' || auth()->user()->role == 'admin'))
                                        <a href="/user/questions/edit/${post.id}" class="text-white bg-green-600 hover:bg-green-500 px-2 ml-3 mt-4 rounded-md float-right">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="px-4 py-2">
                                    <span class="bg-green-500 text-white text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                                        <i class="fa fa-check mr-1"></i>
                                    </span>
                                    <span class="bg-blue-500 text-white text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                                        <i class="fa fa-eye mr-1"></i> ${post.views}
                                    </span>
                                    <span class="bg-blue-500 text-white text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                                        <i class="fa fa-thumbs-up mr-1"></i> ${post.likes}
                                    </span>`;

                                if (post.tags) {
                                    // Decode JSON string to get tags array
                                    var tags = JSON.parse(post.tags);
                                    if (Array.isArray(tags)) {
                                        $.each(tags, function(index, tag) {
                                            posts += `
                            <span class="bg-gray-200 text-gray-700 text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                                ${$.trim(tag)}
                            </span>`;
                                        });
                                    }
                                }

                                posts += `
                                    <span class="bg-yellow-400 text-gray-800 text-sm rounded-full px-2 py-1 float-right">
                                        ${formattedDate}
                                    </span>
                                </div>
                            </div>`;
                            });

                            $('#post-container').append(posts);
                            button.data('page', page + 1);
                            if (!data.next_page_url) {
                                button.remove();
                            } else {
                                button.data('url', data.next_page_url);
                            }
                        } else {
                            button.remove();
                        }
                    },
                    error: function() {
                        alert('Failed to load more posts.');
                    }
                });
            });
        });
    </script>

@endsection
