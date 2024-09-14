@php
    use App\Models\Post;
    use Illuminate\Support\Carbon;

    $popularQuestions = Post::orderBy('views', 'desc')->take(5)->get();
@endphp

@foreach ($popularQuestions as $index => $question)
    <div class="bg-white shadow-md rounded-lg mb-4" key="question-key-{{ $index }}">
        <div class="px-4 py-2 bg-gray-100 border-b">
            <p class="text-lg font-semibold m-0">
                <a href="{{ url('/questions/' . $question->slug) }}" class="text-blue-600 hover:underline">
                    {{ $question->title }}
                </a>
            </p>
            @if (auth()->user()->role == 'editor' || auth()->user()->role == 'admin')
                <a href="{{ url('/user/questions/edit/' . $question->id) }}"
                    class="text-white bg-green-600 hover:bg-green-500 px-2 py-1 rounded-md float-right">
                    <i class="fa fa-edit"></i>
                </a>
            @endif
        </div>

        <div class="px-4 py-2">
            <span class="bg-green-500 text-white text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                <i class="fa fa-check mr-1"></i>
            </span>
            <span class="bg-blue-500 text-white text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                <i class="fa fa-eye mr-1"></i> {{ $question->views }}
            </span>
            <span class="bg-blue-500 text-white text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                <i class="fa fa-thumbs-up mr-1"></i> {{ $question->likes }}
            </span>

            @php
                // Decode the tags JSON for the current question
                $questionTags = json_decode($question->tags, true);
            @endphp

            @if (!empty($questionTags))
                @foreach ($questionTags as $tag)
                    <span class="bg-gray-200 text-gray-700 text-sm rounded-full px-2 py-1 inline-flex items-center mr-2">
                        {{ $tag }}
                    </span>
                @endforeach
            @endif

            <span class="bg-yellow-400 text-gray-800 text-sm rounded-full px-2 py-1 float-right">
                {{ Carbon::parse($question->created_at)->format('F j, Y') }}
            </span>
        </div>
    </div>
@endforeach
