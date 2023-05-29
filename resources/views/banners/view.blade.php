@php
    use App\Models\Municipio;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Banners') }}
        </h2>
    </x-slot>
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
                            <p class="text-xl">Categoría: {{ $banner->category->name }}</p>
                            @if ($banner->subcategory)
                                <div class="text-lg font-semibold mt-4">{{ $banner->subcategory->name }}</div>
                            @endif

                        </div>

                        <div class="mt-8">
                            <p class="text-xl">Provincia: {{ $banner->provincia->provincia }}</p>
                            <p class="text-xl">Municipio: {{ $banner->municipio->municipio }}</p>
                        </div>

                        <div class="mt-8">
                            <p class="text-xl">Lugar: {{ $banner->place }}</p>
                            {{--  
                                <p class="text-xl">Latitud: {{ $banner->latitud }}</p>
                                <p class="text-xl">Longitud: {{ $banner->longitud }}</p>
                            --}}
                        </div>

                        <div class="mt-8">
                            <p class="text-lg">{{ $banner->content }}</p>
                        </div>


                        <div class="form-group">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="place">
                                {{ __('Map') }}
                            </label>
                            <div id="map"></div>
                        </div>

                    </div>

                    <script type="text/javascript">
                        var position = [$banner->latitud, $banner->longitud];

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
