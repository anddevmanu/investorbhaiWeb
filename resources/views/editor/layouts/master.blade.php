<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta-tags')

    {{-- TAILWINDCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- CUSTOM CSS --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/global.css') }}">

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

    @yield('title')

</head>

<body class="flex flex-col min-h-screen">
    <!-- Navbar -->
    <header>
        @include('user.layouts.navbar')
    </header>

    <!-- Main Content -->
    <div class="flex flex-grow">
        <!-- Sidebar (separate from navbar) -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen mt-32">
            @include('editor.layouts.sidebar')
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow p-6 mt-24">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer>
        @include('user.layouts.footer')
    </footer>

        {{-- Toastr JS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            $(document).ready(function() {
                @if(Session::has('success'))
                    toastr.success("{{ Session::get('success') }}");
                @endif

                @if(Session::has('error'))
                    toastr.error("{{ Session::get('error') }}");
                @endif

                @if(Session::has('info'))
                    toastr.info("{{ Session::get('info') }}");
                @endif

                @if(Session::has('warning'))
                    toastr.warning("{{ Session::get('warning') }}");
                @endif
            });
        </script>

        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
                "extendedTimeOut": "1000"
            };
        </script>
</body>

</html>
