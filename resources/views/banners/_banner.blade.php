<div class="w-full md:w-1/4 h-full min-w-min flex flex-col justify-center px-4 border-r border-gray-300">
    @include('banners._showpartial', [
        'fecha_inicio' => $banner->start_time,
        'fecha_fin' => $banner->end_time,
    ])
</div>
<div class="w-full md:w-2/4 px-4 h-full min-w-min min-h-min overflow-hidden flex flex-col justify-around">
    <h2 class="text-lg text-center md:text-lg lg:text-lg font-bold mb-4">{{ $banner->title }}</h2>
    {{-- <p class="text-lgmb-2">$banner->content </p> --}}
    <div class="flex justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"></path>
        </svg>
        <p class="text-sm font-bold">{{ $banner->place }}</p>
    </div>
</div>
<div class="w-full md:w-1/3 h-full">
    <img src="{{ 'data:image/png;base64,' . $banner->image }}" alt="Anuncio Destacado"
        class="w-full h-full object-cover rounded-md">
</div>
