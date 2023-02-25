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
                    <h1 class="text-3xl font-bold mb-5">{{  __('Edit Category') }}</h1>
                    @include('categories._form', [
                        'action' => route('categories.update', $category),
                        'buttonText' => 'Update',
                        'method' => 'patch',
                    ])

                    <br>

                    <h1 class="text-3xl font-bold mb-5">{{  __('Subcategories') }}</h1>
                    @if ($subcategories)
                        @include('subcategories._grid', [
                            'subcategories' => $subcategories,
                            'category_id' => $category->id,
                        ])
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
