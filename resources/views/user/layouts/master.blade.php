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
                <!-- Left side (dynamic columns) -->
                <div class="@yield('left-col-span', 'col-span-9')">
                    @yield('content')
                </div>

                <!-- Right side (dynamic inclusion) -->
                @hasSection('right-sidebar')
                    <div class="col-span-3">
                        @yield('right-sidebar')
                    </div>
                @endif
            </div>
        </div>
    </main>
    @include('user.layouts.footer')
</body>

</html>
