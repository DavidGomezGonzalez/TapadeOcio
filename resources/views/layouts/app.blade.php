<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


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
                                <a href="{{ route('categories.index') }}" class="">Categories</a>
                            </li>
                            <li
                                class="@php echo request()->routeIs('banners.*') ? 'nav_active' : ''; @endphp py-3 px-6 border ">
                                <a href="{{ route('banners.index') }}" class="">Banners</a>
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
