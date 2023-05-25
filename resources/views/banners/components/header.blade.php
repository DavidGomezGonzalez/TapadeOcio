@php
    use App\Models\Municipio;
@endphp
<header class="bg-andalusia text-white">
    <div class="container mx-auto px-4 py-8 flex ">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
            <!-- svg path aquí -->
        </svg>
        <h1 class="text-3xl font-bold mb-2 uppercase ml-2" style="line-height: 2.85rem;">{{ __('GUÍA DE EVENTOS') }}
            @if ($municipio)
                {{ __('DE')." ".Municipio::getMunicipioName($municipio) }}
        </h1>
        @endif
    </div>
</header>
