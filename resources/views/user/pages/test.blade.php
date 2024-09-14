@extends('user.layouts.master') <!-- Adjust based on your layout -->

@section('title')
    <title>{{ $post->title }} - InvestorBhai</title>
@endsection

@section('left-col-span', 'col-span-9')

@section('content')
    <div class="main_content_wrapper">
        <!-- Main Post -->
        <div class="post bg-white shadow-md rounded-lg mb-6">
            <div class="post-header bg-gray-100 p-4 border-b">
                <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
                <div class="post-meta mt-2">
                    <span class="text-gray-600">Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y') }}</span>
                </div>
            </div>

            <div class="post-body p-4">
                <p>{{ $post->content }}</p>
            </div>

            <div class="post-actions flex justify-between items-center p-4 border-t">
                <div class="post-votes flex items-center">
                    <!-- Voting buttons -->
                    <button class="text-blue-600 hover:text-blue-800">
                        <i class="fa fa-thumbs-up"></i> {{ $post->likes }}
                    </button>
                    <button class="text-red-600 hover:text-red-800 ml-4">
                        <i class="fa fa-thumbs-down"></i> {{ $post->dislikes }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Answers -->
        <div class="answers mt-6">
            <h2 class="text-xl font-semibold mb-4">Answers</h2>
            @foreach ($post->answers as $answer)
                <div class="answer bg-white shadow-md rounded-lg mb-4">
                    <div class="answer-header bg-gray-100 p-4 border-b">
                        <div class="flex justify-between items-center">
                            <div class="answer-meta">
                                <span class="font-bold">{{ $answer->user->name }}</span>
                                <span class="text-gray-600">Answered on {{ \Carbon\Carbon::parse($answer->created_at)->format('F j, Y') }}</span>
                            </div>
                            <div class="answer-votes flex items-center">
                                <!-- Voting buttons for answers -->
                                <button class="text-blue-600 hover:text-blue-800">
                                    <i class="fa fa-thumbs-up"></i> {{ $answer->likes }}
                                </button>
                                <button class="text-red-600 hover:text-red-800 ml-4">
                                    <i class="fa fa-thumbs-down"></i> {{ $answer->dislikes }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="answer-body p-4">
                        <p>{{ $answer->content }}</p>
                    </div>

                    <div class="answer-comments mt-4">
                        <h3 class="text-lg font-semibold">Comments</h3>
                        @foreach ($answer->comments as $comment)
                            <div class="comment bg-gray-100 p-2 rounded-lg mb-2">
                                <span class="font-bold">{{ $comment->user->name }}:</span>
                                <p>{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('right-sidebar')
    @include('components.mostPopularQuestions')
    @include('components.tags')
    @include('components.calculator')
@endsection
