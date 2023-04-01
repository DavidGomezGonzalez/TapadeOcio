<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Banners') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto p-10">
                    <h1 class="text-3xl font-bold mb-5">{{  __('Edit Banners') }}</h1>
                    @include('banners._form', [
                        'action' => route('banners.update', $banner),
                        'buttonText' => 'Update',
                        'method' => 'patch',
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
