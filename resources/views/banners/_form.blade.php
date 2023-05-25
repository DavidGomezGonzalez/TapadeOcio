<style>
    #map {
        height: 400px;
        width: 100%;
        margin-bottom: 20px;
    }

    .ui-autocomplete {
        z-index: 9999;
    }
</style>

<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($method ?? false)
        @method($method)
    @endif
    @csrf
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

    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
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
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0" id="div-subcategory_id">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="municipality">
                {{ __('SubCategory') }}
            </label>
            <select
                class="select2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="subcategory_id" name="subcategory_id">
                <option value="">{{ __('Choose a Value') }}</option>
                @foreach ($subcategories as $sub)
                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('subcategory_id'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('subcategory_id') }}</p>
            @endif
        </div>
    </div>

    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="province">
                {{ __('Province') }}
            </label>
            <select
                class="select2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="province" name="province">
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
            <input type="text" id="start_time" name="start_time" class="w-full"
                value="{{ old('start_time', $banner->start_time ?? '') }}">
            @if ($errors->has('start_time'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('start_time') }}</p>
            @endif
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="end_date">
                {{ __('End Date') }}
            </label>
            <input type="text" id="end_time" name="end_time" class="w-full"
                value="{{ old('end_time', $banner->end_time ?? '') }}">
            @if ($errors->has('end_time'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('end_time') }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="place">
            {{ __('Place') }}
        </label>
        <input type="text" class="form-control w-full" id="place" name="place"
            value="{{ old('place', $banner->place ?? '') }}">
    </div>

    <div class="form-group" style="display:none;">
        <label for="latitud">Latitud</label>
        <input type="text" class="form-control" id="latitud" name="latitud"
            value="{{ old('latitud', $banner->latitud ?? '') }}">
    </div>
    <div class="form-group" style="display:none;">
        <label for="longitud">Longitud</label>
        <input type="text" class="form-control" id="longitud" name="longitud"
            value="{{ old('longitud', $banner->longitud ?? '') }}">
    </div>

    <br />

    <div class="form-group">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="place">
            {{ __('Map') }}
        </label>
        <div id="map"></div>
    </div>

    <div class="form-group">
        <label for="image" class="font-bold">{{ __('Image') }}</label>
        <input type="file" name="image" id="image" class="form-control">
        @if ($errors->has('image'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('image') }}</p>
        @endif
    </div>

    @if (isset($banner->image))
        <div class="flex justify-start items-center gap-4">
            <div>
                <img id="image-preview" src="{{ 'data:image/png;base64,' . $banner->image }}" alt="Preview Image"
                    style="max-width: 100%; max-height: 34vh; {{ $banner->image ? '' : 'display: none;' }}">
            </div>
            <a style="{{ $banner->image ? '' : 'display: none;' }}" x-data="{ tooltip: 'Delete' }" id="btn-delete-image"
                href="#" class="delete-button btn-rojo h-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-5 w-5" x-tooltip="tooltip">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </a>
        </div>
    @endif


    <br>

    <button type="submit"
        class="btn btn-primary bg-blue-500 text-white p-2 rounded hover:bg-blue-600">{{ $buttonText }}</button>
</form>


<script type="text/javascript">

    $('#category_id').val({{ old('category_id', $banner->category_id ?? '') }});
    $('#category_id').select2();

    $('#subcategory_id').val({{ old('subcategory_id', $banner->subcategory_id ?? '') }});
    var url = "{{ route('subcategory-autocomplete') }}";
    $('#subcategory_id').select2({
        placeholder: 'Choose a Value',
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page,
                    category_id: $('#category_id').val(),
                };
            },
            processResults: function(data) {
                /*if (data.length > 0)
                    $('#div-subcategory_id').removeClass('hidden');
                else
                    $('#div-subcategory_id').addClass('hidden');*/

                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });


    $('#province').val({{ old('province', $banner->province ?? '') }});
    $('#province').select2();

    $('#municipality').val({{ old('municipality', $banner->municipality ?? '') }});
    var path = "{{ route('municipality-autocomplete') }}";
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
                    provincia: $('#province').val(),
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

    const fechaInicioInput = document.getElementById('start_time');
    const fechaFinInput = document.getElementById('end_time');
    const fechaHoraActual = new Date(); // Obtener la fecha y hora actual

    const flatpickrOptions = {
        dateFormat: 'Y-m-d H:i:s', // Formato del valor interno
        altFormat: 'd/m/Y H:i:s', // Formato de visualización
        enableTime: true, // Habilitar la selección de hora
        time_24hr: true, // Utilizar formato de 24 horas sin AM o PM
        altInput: true, // Mostrar el valor interno en un campo de entrada oculto
        minDate: 'today',
        onChange: function(selectedDates, dateStr, instance) {
            if (instance === fechaInicioPicker) {
                // Validación al cambiar la fecha de inicio
                fechaFinPicker.set('minDate', selectedDates[0]); // Establecer fecha mínima en el campo de fin
                if (fechaFinInput.value && fechaInicioPicker.selectedDates[0] > fechaFinPicker.selectedDates[
                    0]) {
                    fechaFinPicker
                .clear(); // Limpiar el campo de fin si la fecha de inicio es posterior a la fecha de fin
                    fechaFinInput._flatpickr.setDate(fechaInicioPicker.selectedDates[0]);
                }
            }
        }
    };

    const fechaInicioPicker = flatpickr(fechaInicioInput, flatpickrOptions);
    const fechaFinPicker = flatpickr(fechaFinInput, flatpickrOptions);

    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
    if (latitud && longitud)
        var position = [$('#latitud').val(), $('#longitud').val()];
    else
        var position = [37.4384292, -4.1980422];

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


    // Crea un objeto Geocoder de Leaflet para buscar direcciones
    /*var geocoder = L.Control.geocoder({
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
    }).addTo(map);*/

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

    $('#place').autocomplete({
        source: function(request, response) {
            $.ajax({
                type: 'GET',
                url: '{{ route('search.geolocation') }}',
                data: {
                    address: $('#place').val()
                },
                success: function(data) {
                    var datos = JSON.parse(data);
                    //console.log(datos);
                    response([datos]);
                }
            });
        },
        select: function(event, ui) {
            $('#latitud').val(ui.item.lat);
            $('#longitud').val(ui.item.lon);
            var position = [$('#latitud').val(), $('#longitud').val()];
            if (marker)
                map.removeLayer(marker);
            map.flyTo(position, 15);
            marker = L.marker(position).addTo(map);
        },
        minLength: 3
    });


    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
        }
    });


    $(document).on('click', '#btn-delete-image', function(e) {
        e.preventDefault();
        const bannerId = '{{ old('id', $banner->id ?? '') }}';
        const url = '/banners/' + bannerId + '/delete-image';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#image-preview').hide();
                //$('#image-preview').attr('src', '#');
                $('#btn-delete-image').hide();
                // Do something on success, e.g. hide the image preview
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                // Do something on error, e.g. display an error message
            }
        });
    });
</script>
