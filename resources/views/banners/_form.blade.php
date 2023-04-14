<style>
    #map {
        height: 400px;
        width: 100%;
        margin-bottom: 20px;
    }
</style>

<form action="{{ $action }}" method="post">
    @csrf
    @if ($method ?? false)
        @method($method)
    @endif
    @csrf
    <div class="form-group">
        <label for="image" class="font-bold">{{ __('Image') }}</label>
        <input type="file" name="image" id="image" class="form-control">
        @if ($errors->has('image'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('image') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="title" class="font-bold">{{ __('Title') }}</label>
        <input type="text" name="title" id="title" class="form-control w-full"
            value="{{ old('title', $banner->title ?? '') }}">
        @if ($errors->has('title'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="description" class="font-bold">{{ __('Content') }}</label>
        <textarea name="content" id="content" rows="3" class="form-control w-full">{{ old('content', $banner->content ?? '') }}</textarea>
        @if ($errors->has('content'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('content') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="category_id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            {{ __('Category') }}
        </label>
        <select name="category_id" id="category_id"
            class="select2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="">{{ __('Choose a Value') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('category_id'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('category_id') }}</p>
        @endif
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="provincia">
                {{ __('Province') }}
            </label>
            <select
                class="select2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="provincia" name="provincia">
                <option value="">{{ __('Choose a Value') }}</option>
                @foreach ($provincias as $p)
                    <option value="{{ $p->id }}">{{ $p->provincia }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="municipality">
                {{ __('City') }}
            </label>
            <select
                class="select2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="municipality" name="municipality">
                <option value="">{{ __('Choose a Value') }}</option>
                @foreach ($municipalities as $m)
                    <option value="{{ $m->id }}">{{ $m->municipio }}</option>
                @endforeach
            </select>
            @if ($errors->has('municipality'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('municipality') }}</p>
            @endif
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="start_date">
                {{ __('Start Date') }}
            </label>
            <input type="text" id="start_date" name="start_date" class="w-full">
            @if ($errors->has('start_date'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('start_date') }}</p>
            @endif
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="end_date">
                {{ __('End Date') }}
            </label>
            <input type="text" id="end_date" name="end_date" class="w-full">
            @if ($errors->has('end_date'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('end_date') }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="place">
            {{ __('Place') }}
        </label>
        <input type="text" class="form-control" id="place" name="place">
    </div>

    <div class="form-group" style="/*display:none;*/">
        <label for="latitud">Latitud</label>
        <input type="text" class="form-control" id="latitud" name="latitud">
    </div>
    <div class="form-group" style="/*display:none;*/">
        <label for="longitud">Longitud</label>
        <input type="text" class="form-control" id="longitud" name="longitud">
    </div>

    <div id="map"></div>

    <button type="submit"
        class="btn btn-primary bg-blue-500 text-white p-2 rounded hover:bg-blue-600">{{ $buttonText }}</button>
</form>


<script type="text/javascript">
    $('#category_id').val({{ old('category_id', '') }});
    $('#category_id').select2();

    $('#provincia').val({{ old('provincia', '') }});
    $('#provincia').select2();

    $('#municipality').val({{ old('municipality', '') }});
    var path = "{{ route('autocomplete') }}";
    $('#municipality').select2({
        placeholder: 'Choose a Value',
        ajax: {
            url: path,
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page,
                    provincia: $('#provincia').val(),
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.municipio,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    flatpickr('#start_date', {
        dateFormat: 'd-m-Y',
        enableTime: false
    });
    flatpickr('#end_date', {
        dateFormat: 'd-m-Y',
        enableTime: false
    });


    // Crea el mapa en el contenedor "map" y establece la vista inicial en el centro del mundo
    var map = L.map('map').setView([51.505, -0.09], 13);

    // Crea un marcador en la posición [0, 0] y añádelo al mapa
    var marker = L.marker([51.505, -0.09]).addTo(map);

    // Añade el control de mapa de OpenStreetMap al mapa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18
    }).addTo(map);


    // Crea un objeto Geocoder de Leaflet para buscar direcciones
    var geocoder = L.Control.geocoder({
        inputField: 'place',
        defaultMarkGeocode: false,
        collapsed: true,
        placeholder: 'Ingrese una dirección',
        errorMessage: 'No se encontró la dirección',
        geocoder: L.Control.Geocoder.nominatim()
    }).on('markgeocode', function(e) {
        // Actualiza la posición del marcador y los campos ocultos al seleccionar una dirección
        var location = e.geocode.center;
        marker.setLatLng(location);
        map.setView(location, 13);
        document.getElementById('latitud').value = location.lat;
        document.getElementById('longitud').value = location.lng;
    }).addTo(map);

    map.on('click', function(e) {
        geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
          var r = results[0];
          if (r) {
            if (marker) {
              marker
                .setLatLng(r.center)
                .setPopupContent(r.html || r.name)
                .openPopup();
            } else {
              marker = L.marker(r.center)
                .bindPopup(r.name)
                .addTo(map)
                .openPopup();
            }
          }
        });
      });

</script>
