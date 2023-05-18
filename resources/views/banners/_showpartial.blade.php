@php
    //$fecha_inicio = '2023-03-20 00:00:00';
    //$fecha_fin = '2023-03-25 00:00:00';
    // Convertir las fechas a objetos DateTime
    $fecha_inicio_obj = new DateTime($fecha_inicio);
    $fecha_fin_obj = new DateTime($fecha_fin);
    
    // Obtener el día y el mes en formato numérico
    $dia_inicio = $fecha_inicio_obj->format('d');
    $dia_fin = $fecha_fin_obj->format('d');
    $mes_inicio = $fecha_inicio_obj->format('m');
    $mes_fin = $fecha_fin_obj->format('m');
    
    // Verificar si la fecha de inicio y fin son el mismo día
    $es_mismo_dia = $fecha_inicio_obj->format('Y-m-d') === $fecha_fin_obj->format('Y-m-d');
    
    // Obtener el nombre completo del mes en español
    setlocale(LC_TIME, 'es_ES.UTF-8');
    $nombre_mes_inicio = strftime('%B', strtotime("01-$mes_inicio-2023"));
    $nombre_mes_fin = strftime('%B', strtotime("01-$mes_fin-2023"));
@endphp

<div class="text-center">
    {{-- Mostrar la fecha y hora de acuerdo a si es el mismo día o no --}}
    @if ($es_mismo_dia)
        @php
            $nombre_dia = strftime('%A', $fecha_inicio_obj->getTimestamp());
            $hora_inicio = $fecha_inicio_obj->format('H:i');
            $hora_fin = $fecha_fin_obj->format('H:i');
        @endphp

        <div>
            <span class="text-4xl font-bold block mb-2">{{ $dia_inicio }}</span>
            <span class="text-lg font-bold block">{{ $nombre_mes_inicio }}</span>
        </div>
        <hr>
        <div class="text-2xl font-bold">{{ $nombre_dia }}</div>
        <br />
        <div class="flex items-center justify-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
            </svg>
            <span> {{ $hora_inicio }}</span>
        </div>
    @else
        <span class="text-4xl font-bold block mb-2">{{ $dia_inicio }}</span>
        <span class="text-lg font-bold block">{{ $nombre_mes_inicio }}</span>
        <hr class="my-2">
        <span class="text-4xl font-bold block mb-2">{{ $dia_fin }}</span>
        <span class="text-lg font-bold block">{{ $nombre_mes_fin }}</span>
    @endif
</div>
