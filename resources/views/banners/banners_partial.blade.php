<!-- Banners de hoy -->
<section class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-xl font-bold mb-4">Eventos de hoy</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach ($todayBanners as $banner)
                <div class="banner w-full flex flex-col-reverse md:flex-row items-center bg-white border border-gray-300 rounded-md h-full md:h-60 cursor-pointer"
                    data-url="{{ route('banners.view', $banner->id) }}">
                    @include('banners._banner', [
                        'banner' => $banner,
                    ])
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Banners próximos -->
<section class="py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-xl font-bold mb-4">Próximos eventos</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach ($upcomingBanners as $banner)
                <div class="banner w-full flex flex-col-reverse md:flex-row items-center bg-white border border-gray-300 rounded-md h-full md:h-60 cursor-pointer"
                    data-url="{{ route('banners.view', $banner->id) }}">
                    @include('banners._banner', [
                        'banner' => $banner,
                    ])
                </div>
            @endforeach
        </div>
    </div>
</section>