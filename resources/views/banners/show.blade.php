@php
    use App\Models\Municipio;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Banners') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="flex flex-col sm:flex-row lg:flex-row items-center bg-white border border-gray-300 rounded-md h-60">
                @include('banners._banner', [
                    '$banner' => $banner,
                ])
            </div>
        </div>
    </div>
</x-app-layout>
