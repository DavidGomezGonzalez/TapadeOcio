@php
    use App\Models\Municipio;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Banners') }}
        </h2>
    </x-slot>
    <style>
        #mapa {
            height: 300px;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto p-10">

                    <div class="container mx-auto">
                        <div class="">
                            <h1 class="text-4xl font-bold">{{ $banner->title }}</h1>
                        </div>

                        <div class="mt-8">
                            <img src="{{ 'data:image/png;base64,' . $banner->image }}" alt="{{ $banner->title }}"
                                class="max-w-full h-auto">
                        </div>

                        <div class="mt-8">
                            <p class="text-xl">{{ $banner->start_time }} - {{ $banner->end_time }}</p>
                        </div>

                        <div class="mt-8">
                            <p class="text-xl flex gap-4">{{ __('Categoría') }}:
                                {{ $banner->category->name }}
                                @if ($banner->category->icon)
                                    <x-icon name="{{ pathinfo($banner->category->icon->filename, PATHINFO_FILENAME) }}"
                                        class="w-8 h-8" />
                                @endif
                            </p>
                            @if ($banner->subcategory)
                                <p class="text-xl flex gap-4">{{ __('Subcategoría') }}:
                                    {{ $banner->subcategory->name }}
                                </p>
                            @endif

                        </div>

                        <div class="mt-8">
                            <p class="text-lg">{{ $banner->content }}</p>
                        </div>

                        {{--  
                        <div class="mt-8">
                            <p class="text-xl">Latitud: {{ $banner->latitud }}</p>
                            <p class="text-xl">Longitud: {{ $banner->longitud }}</p>
                        </div>
                        --}}

                        <br>

                        <div class="form-group">
                            <div class="flex justify-between">
                                <span class="text-xs">{{ $banner->place }}</span>
                                <div>
                                    <span class="text-xs">{{ $banner->municipio->municipio }},
                                        {{ $banner->provincia->provincia }}</span>
                                </div>
                            </div>
                            <div id="mapa"></div>
                        </div>
                    </div>


                    <script type="text/javascript">
                        var position = [{{ $banner->latitud }}, {{ $banner->longitud }}];

                        // Crea el mapa en el contenedor "map" y establece la vista inicial en el centro del mundo
                        var map = L.map('mapa').setView(position, 15);

                        // Crea un marcador en la posición y añádelo al mapa
                        var marker = L.marker(position).addTo(map);

                        // Añade el control de mapa de OpenStreetMap al mapa
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                            maxZoom: 18
                        }).addTo(map);



                        // Crea el mapa en el contenedor "map" y establece la vista inicial en el centro del mundo
                        var map = L.map('map').setView(position, 15);

                        // Crea un marcador en la posición y añádelo al mapa
                        var marker;
                        if (latitud && longitud)
                            marker = L.marker(position).addTo(map);

                        // Añade el control de mapa de OpenStreetMap al mapa
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                            maxZoom: 18
                        }).addTo(map);
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
