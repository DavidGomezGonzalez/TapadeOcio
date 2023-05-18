@php
    use App\Models\Municipio;
@endphp
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
                <header class="bg-andalusia text-white">
                    <div class="container mx-auto px-4 py-8 flex ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <h1 class="text-3xl font-bold mb-2 uppercase ml-2" style="line-height: 2.85rem;">GUÍA DE EVENTOS
                            DE {{ Municipio::getMunicipioName($municipio) }}</h1>
                    </div>
                </header>

                <!-- Banners de hoy -->
                <section class="bg-gray-100 py-8">
                    <div class="container mx-auto px-4">
                        <h2 class="text-xl font-bold mb-4">Eventos de hoy</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
                            <!-- Aquí van los banners de eventos de hoy -->
                            @foreach ($banners as $banner)
                                @php
                                    // Convertir la fecha específica a un objeto DateTime
                                    $fecha = (new DateTime($banner->start_time))->format('Y-m-d');
                                    
                                    // Obtener la fecha actual en formato 'Y-m-d'
                                    $fechaActual = (new DateTime())->format('Y-m-d');
                                @endphp
                                @if ($fecha == $fechaActual)
                                    <div class="flex items-center bg-white border border-gray-300 rounded-md h-60">
                                        @include('banners._banner', [
                                            'banner' => $banner,
                                        ])
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </section>

                <!-- Banners próximos -->
                <section class="py-8">
                    <div class="container mx-auto px-4">
                        <h2 class="text-xl font-bold mb-4">Próximos eventos</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
                            <!-- Aquí van los banners de próximos eventos categorizados por categoría y municipio -->
                            @foreach ($banners as $banner)
                                @php
                                    // Convertir la fecha específica a un objeto DateTime
                                    $fecha = (new DateTime($banner->start_time))->format('Y-m-d');
                                    
                                    // Obtener la fecha actual en formato 'Y-m-d'
                                    $fechaActual = (new DateTime())->format('Y-m-d');
                                @endphp
                                @if ($fecha != $fechaActual)
                                    <div class="flex items-center bg-white border border-gray-300 rounded-md h-60">
                                        @include('banners._banner', [
                                            'banner' => $banner,
                                        ])
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </section>


            </div>
        </div>
    </div>
</x-app-layout>
