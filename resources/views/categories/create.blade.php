<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto p-10">
                    <h1 class="text-3xl font-bold mb-5">{{ __('Create Category') }}</h1>
                    @include('categories._form', [
                        'action' => route('categories.store'),
                        'buttonText' => trans('Save')
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
