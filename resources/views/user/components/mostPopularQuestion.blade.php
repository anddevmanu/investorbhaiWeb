@php
    use App\Models\Post;

    $popularQuestions = Post::orderBy('views', 'desc')->take(5)->get();
@endphp

<section class="mb-3 most-popular-questions">
    <h3 class="text-2xl font-semibold border-b pb-2 mb-3">Most popular questions</h3>
    <ul class="list-none">
        @if($popularQuestions->count())
            @foreach($popularQuestions as $pq)
                <li class="py-2 px-4 flex justify-between items-center border-b last:border-none">
                    <a href="{{ url('/questions/' . $pq->slug) }}" class="text-blue-500 hover:underline">{{ $pq->title }}</a>
                    <span class="bg-blue-500 text-white text-sm font-medium rounded-full px-2 py-1">{{ $pq->views }}</span>
                </li>
            @endforeach
        @else
            <li class="py-2 px-4">No popular questions available.</li>
        @endif
    </ul>
</section>
