<hr>
<!-- Banners de hoy -->
<section class="py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-xl font-bold mb-4">Eventos de hoy</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach ($todayBanners as $banner)
                <a class="md:flex banner w-full bg-white border border-gray-300 rounded-md h-full md:h-60 cursor-pointer"
                    href="{{ route('banners.view', $banner->id) }}">
                    <div class="flex p-2 justify-center md:flex-row">
                        @if ($banner->category->icon)
                            <x-icon name="{{ pathinfo($banner->category->icon->filename, PATHINFO_FILENAME) }}"
                                class="w-10 h-10 md:w-6 md:h-6" />
                        @endif
                    </div>
                    <div class="flex flex-col-reverse md:flex-row items-center">
                        @include('banners._banner', [
                            'banner' => $banner,
                        ])
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
<hr>
<!-- Banners próximos -->
<section class="py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-xl font-bold mb-4">Próximos eventos</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach ($upcomingBanners as $banner)
                <a class="banner w-full flex flex-col-reverse md:flex-row items-center bg-white border border-gray-300 rounded-md h-full md:h-60 cursor-pointer"
                    href="{{ route('banners.view', $banner->id) }}">
                    @include('banners._banner', [
                        'banner' => $banner,
                    ])
                </a>
            @endforeach
        </div>
    </div>
</section>
