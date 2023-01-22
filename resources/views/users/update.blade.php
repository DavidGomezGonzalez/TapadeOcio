<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-3 items-center font-normal text-gray-900">
            <div class="relative h-10 w-10">
                <img class="h-full w-full rounded-full object-cover object-center"
                    src="{{ $model->profile_photo_url }}" alt="{{ $model->name }}" />
                <span
                    class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
            </div>
            <div class="text-sm">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $model->name }}
                </h2>
            </div>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @include('users._form', ['model' => $model])
            </div>
        </div>
    </div>
</x-app-layout>