@extends('user.layouts.master')

@section('title')
    <title>{{ $post->title }} - InvestorBhai</title>
@endsection

@section('left-col-span', 'col-span-9')

@section('content')
    <div class="main_content_wrapper">
    @include('admin.layouts.message')

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
                                <span class="font-bold">{{ $answer->user->name ?? 'Unknown' }}</span>
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
                                <!-- Comment button -->
                                <button class="text-gray-600 hover:text-gray-800 ml-4 commentBtn" data-answer-id="{{ $answer->id }}">
                                    <i class="fa fa-comment"></i> Comment
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="answer-body p-4">
    {!! $answer->body !!}
</div>


                    <!-- Comments Section -->
                    <div class="answer-comments mt-4">
                        <h3 class="text-lg font-semibold">Comments</h3>
                        @foreach ($answer->comments as $comment)
                            <div class="comment bg-gray-100 p-2 rounded-lg mb-2">
                                <span class="font-bold">{{ $comment->user->name ?? 'Unknown User' }}:</span>
                                <p>{{ $comment->body }}</p>
                            </div>
                        @endforeach

                        <!-- Add Comment Form -->
                        <div class="add-comment mt-4 mb-2 hidden" id="comment-form-{{ $answer->id }}">
                            <form action="{{ route('comment.save') }}" method="POST">
                                @csrf
                                <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="mb-4">
                                    <textarea name="body" class="w-full p-2 border rounded-lg" rows="3" placeholder="Add your comment"></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                        Submit Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Answer Form -->
        <div class="add-answer mt-6 bg-white shadow-md rounded-lg p-4">
            <h3 class="text-xl font-semibold mb-4">Add Your Answer</h3>
            <form action="{{ route('answer.save') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-4">
                    <x-ckeditor id="editor1" name="body" value="{{ old('editor', $initialValue ?? '') }}" />
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Submit Answer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
                $('.commentBtn').on('click', function() {
                    var answerId = $(this).data('answer-id');
                    $('#comment-form-' + answerId).toggleClass('hidden');
                });
            });

        </script>
@endsection

@section('right-sidebar')
    @include('user.components.mostPopularQuestion')
@endsection
