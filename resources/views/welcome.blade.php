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

                <div id="category-list">
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

                </div>

                <div id="banners-container">
                    @include('banners.banners_partial', [
                        'todayBanners' => $todayBanners,
                        'upcomingBanners' => $upcomingBanners,
                    ])
                </div>

            </div>
        </div>
    </div>

</x-app-layout>


<script>
    document.querySelectorAll('.banner').forEach(function(banner) {
        banner.addEventListener('click', function() {
            window.location.href = banner.dataset.url;
        });
    });

    $(document).ready(function() {
        $(".accordion-button").click(function() {
            var categoryId = $(this).prev().prev().data('category-id');
            $("#subcategories-for-category-" + categoryId).toggleClass('hidden');
            $(this).find('.chevron-icon').toggleClass('rotate-180');
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
                    console.log(data);
                    $('#banners-container').html(data.html);
                }
            });
        });
    });
</script>
