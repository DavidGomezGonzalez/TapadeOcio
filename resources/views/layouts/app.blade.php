<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Agrega estos enlaces en la sección HEAD de tu plantilla -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <!-- Incluir jQuery UI desde CDN -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>

    <!-- Opcionalmente, incluir una hoja de estilos CSS para jQuery UI -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

</head>
<style>
    .nav_active {
        --tw-bg-opacity: 1;
        background-color: rgb(20 83 45 / var(--tw-bg-opacity));
        color: white;
    }
</style>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100 ">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        {{-- @if (isset($header))
            <header class="bg-white shadow">
                <div class=" mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif --}}


        <main>
            <div class="flex justify-between">
                @if (Auth::guard()->check() &&
                        auth()->user()->isAdmin())
                    <div class="bg-white w-max w-64 border border-gray-200 h-screen" style="">
                        <ul class="flex flex-col">
                            <li
                                class="@php echo request()->routeIs('dashboard') ? 'nav_active' : ''; @endphp py-3 px-6 border ">
                                <a href="{{ route('dashboard') }}" class="">{{ __('Dashboard') }}</a>
                            </li>
                            <li
                                class="@php echo request()->routeIs('users.*') ? 'nav_active' : ''; @endphp py-3 px-6 border ">
                                <a href="{{ route('users.index') }}" class="">{{ __('Users') }}</a>
                            </li>
                            <li
                                class="@php echo request()->routeIs('categories.*') ? 'nav_active' : ''; @endphp py-3 px-6 border ">
                                <a href="{{ route('categories.index') }}" class="">{{ __('Categories') }}</a>
                            </li>
                            <li
                                class="@php echo request()->routeIs('banners.*') ? 'nav_active' : ''; @endphp py-3 px-6 border ">
                                <a href="{{ route('banners.index') }}" class="">{{ __('Banners') }}</a>
                            </li>
                            <li
                                class="@php echo request()->routeIs('icons.*') ? 'nav_active' : ''; @endphp py-3 px-6 border ">
                                <a href="{{ route('icons.index') }}" class="">{{ __('Icons') }}</a>
                            </li>
                        </ul>
                    </div>
                @endif
                <div style="width: 100%">
                    <!-- Page Content -->
                    {{ $slot }}
                </div>
            </div>
        </main>

    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
