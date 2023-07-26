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
                    <h1 class="text-3xl font-bold mb-5">{{ __('Create Icon') }}</h1>

                    <form action="{{ route('icons.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="name">{{ __('Nombre del icono') }}:</label>
                            <input type="text" name="name" id="name">
                        </div>

                        <div>
                            <label for="icon">{{ __('Seleccionar archivo SVG') }}:</label>
                            <input type="file" name="icon" id="icon" accept=".svg">
                        </div>
                        <div class="w-20" id="preview"></div>

                        <br>
                        <div>
                            <button type="submit"
                                class="btn btn-primary bg-blue-500 text-white p-2 rounded hover:bg-blue-600">{{ __('Cargar Icono') }}</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.getElementById('icon').addEventListener('change', function(e) {
        var preview = document.getElementById('preview');
        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.innerHTML = '<img src="' + reader.result + '" />';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    });
</script>
