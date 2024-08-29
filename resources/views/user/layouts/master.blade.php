<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- TAILWINDCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- CUSTOM CSS --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/global.css') }}">
    @yield('title')
</head>

<body class="flex flex-col min-h-screen">
    @include('user.layouts.navbar')
    <main class="my-5 pt-5 container min-vh-100 flex-grow">
        <div class="container mx-auto" style="margin-top: 5rem; padding: 1rem 2rem 1rem;">
            <div class="grid grid-cols-12 gap-4">
                <!-- Left side (9 columns) -->

                <div class="col-span-9">
                    @yield('content')

                </div>

                <!-- Right side (3 columns) -->
                <div class="col-span-3 ">
                    @include('user.components.mostPopularQuestion')
                    <section class='my-3 tags'>
                        <h3 class='page-header border-bottom pb-2 mb-3'>Tags</h3>
                        @php
                            use App\Models\Post;

                            // Fetch all posts
                            $posts = Post::all();

                            $tags = $posts
                                ->flatMap(function ($post) {
                                    return json_decode($post->tags, true);
                                })
                                ->unique()
                                ->toArray();
                        @endphp
                        @if (isset($tags) && is_array($tags) && count($tags) > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach ($tags as $tag)
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p>No tags available.</p>
                        @endif
                    </section>
                    {{-- CALCULATOR --}}
                    @include('user.components.calculator')
                </div>
            </div>
        </div>

    </main>
    @include('user.layouts.footer')

</body>

</html>
