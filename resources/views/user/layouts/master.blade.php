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


    {{-- CUSTOM CSS --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/global.css') }}">

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    {{-- GOOGLE AUTO ADSENSE --}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9390772892463957"
     crossorigin="anonymous"></script>

     {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @yield('title')

</head>

<body class="flex flex-col min-h-screen">
    @include('user.layouts.navbar')
    <main class="my-5 pt-5 container min-vh-100 flex-grow">
        <div class="container mx-auto" style="margin-top: 5rem; padding: 1rem 2rem 1rem;">
            <div class="grid grid-cols-12 gap-4">
                <!-- Left side (dynamic columns) -->
                <div class="@yield('left-col-span', 'col-span-9')">
                    <x-adsense ad-client="ca-pub-9390772892463957" ad-slot="8054387556" ad-format="rectangle" ad-style="bg-gray-100 display:block" ad-responsive="true" />
                    @yield('content')
                </div>

                <!-- Right side (dynamic inclusion) -->
                @hasSection('right-sidebar')
                    <div class="col-span-3">
                        @yield('right-sidebar')
                        <x-adsense ad-client="ca-pub-xxxxxxxxxxxxxxxx" ad-slot="1234567890" ad-format="rectangle" ad-style="bg-gray-100" ad-responsive="true" />
                    </div>
                @endif
            </div>
        </div>
    </main>


    @include('user.layouts.footer')

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
