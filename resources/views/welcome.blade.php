<style>
    .category-item.active {
        background-color: #c3e6c4;
    }

    .spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid #ccc;
        border-top-color: #999;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <!-- Cabecera -->
                @include('banners.components.header', ['municipio' => $municipio])

                {{-- <div id="category-list">
                    <div class="flex flex-col space-y-4 p-8">
                        <h2 class="text-2xl font-bold">Categorías</h2>
                        @foreach ($categories as $category)
                            <div>
                                <div class="form-check flex items-center gap-1">
                                    <input class="form-check-input category-checkbox" type="checkbox"
                                        value="{{ $category->id }}" id="category-{{ $category->id }}"
                                        data-category-id="{{ $category->id }}" checked>
                                    <label class="form-check-label" for="category-{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                    @if ($category->subcategories->isNotEmpty())
                                        <button class="accordion-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="chevron-icon h-4 w-4"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                                <div id="subcategories-for-category-{{ $category->id }}"
                                    class="subcategories-container hidden space-y-2">
                                    @foreach ($category->subcategories as $subcategory)
                                        <div class="ml-5 form-check">
                                            <input class="form-check-input subcategory-checkbox" type="checkbox"
                                                value="{{ $subcategory->id }}" id="subcategory-{{ $subcategory->id }}"
                                                name="subcategory" checked>
                                            <label class="form-check-label" for="subcategory-{{ $subcategory->id }}">
                                                {{ $subcategory->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> --}}


                <div id="category-list" class="category-container">
                    <div class="flex flex-col space-y-4 p-8">
                        <h2 class="text-2xl font-bold">{{ __('Categorías') }}</h2>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($categories as $category)
                                <div class="category-item rounded-md overflow-hidden cursor-pointer active">
                                    <div class="p-6 border border-gray-300 rounded-md text-center category-toggle">
                                        <div class="mb-2 flex justify-center">
                                            @if ($category->icon)
                                                <x-icon
                                                    name="{{ pathinfo($category->icon->filename, PATHINFO_FILENAME) }}"
                                                    class="w-6 h-6" />
                                            @endif
                                        </div>
                                        <p class="font-semibold">{{ $category->name }}</p>
                                    </div>
                                    <input class="form-check-input category-checkbox hidden" type="checkbox"
                                        value="{{ $category->id }}" id="category-{{ $category->id }}"
                                        data-category-id="{{ $category->id }}" checked>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="banners-container">
                    @include('banners.banners_partial', [
                        'todayBanners' => $todayBanners,
                        'upcomingBanners' => $upcomingBanners,
                    ])
                    <div class="flex justify-around hidden">
                        <span class="spinner"></span> <!-- Agrega el spinner oculto -->
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>


<script>
    $(document).ready(function() {
        $(".accordion-button").click(function() {
            var categoryId = $(this).prev().prev().data('category-id');
            $("#subcategories-for-category-" + categoryId).toggleClass('hidden');
            $(this).find('.chevron-icon').toggleClass('rotate-180');
        });
    });


    const categoryItems = document.querySelectorAll('.category-item');

    categoryItems.forEach(item => {
        const toggle = item.querySelector('.category-toggle');
        const checkbox = item.querySelector('.category-checkbox');

        toggle.addEventListener('click', () => {
            checkbox.checked = !checkbox.checked;

            if (checkbox.checked) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }

            checkbox.dispatchEvent(new Event('change'));
        });
    });

    const categoryCheckboxes = document.querySelectorAll('.category-checkbox, .subcategory-checkbox');
    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', (event) => {
            const checkedCategories = Array.from(categoryCheckboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);
            const checkedSubcategories = Array.from(categoryCheckboxes)
                .filter(checkbox => checkbox.checked && checkbox.name === 'subcategory')
                .map(checkbox => checkbox.value);

            const categoryItem = checkbox.closest('.category-item');

            if (checkbox.checked) {
                categoryItem.classList.add('active');
            } else {
                categoryItem.classList.remove('active');
            }

            //$('.spinner').removeClass('hidden'); // Muestra el spinner durante la carga

            $.ajax({
                type: 'POST',
                url: '/banners/filter',
                data: {
                    category_ids: checkedCategories,
                    subcategory_ids: checkedSubcategories,
                    municipio: '{{ $municipio }}',
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    //$('.spinner').addClass('hidden'); // Oculta el spinner al hacer clic
                    $('#banners-container').html(data.html);
                }
            });
        });
    });
</script>
