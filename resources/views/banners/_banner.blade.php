<div class="w-1/5 h-full flex flex-col justify-center"
    style="
                        padding: 0 25px;
                        border-top-left-radius: 0.375rem;
                        border-top-right-radius: 0;
                        border-bottom-right-radius: 0;
                        border-bottom-left-radius: 0.375rem;
                    ">
    @include('banners._showpartial', [
        'fecha_inicio' => $banner->start_time,
        'fecha_fin' => $banner->end_time,
    ])
</div>
<div class="flex w-3/6 px-4 h-full flex-col justify-around">
    <h2 class="text-2xl font-bold mb-4">{{ $banner->title }}</h2>
    {{-- <p class="text-lgmb-2">$banner->content </p> --}}
    <div class="flex">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"></path>
        </svg>
        <p class="text-sm font-bold">{{ $banner->place }}</p>
    </div>
</div>
<div class="w-2/6 max-h-72 w-full h-full">
    <img src="{{ 'data:image/png;base64,' . $banner->image }}" alt="Anuncio Destacado"
        class="w-full max-w-full h-full object-cover rounded-md">
</div>
