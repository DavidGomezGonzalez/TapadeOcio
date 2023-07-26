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
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="text-left border px-4 py-2">{{ __('Icon') }}</th>
                                <th class="text-left border px-4 py-2">{{ __('Nombre') }}</th>
                                <th class="border px-4 py-2">{{ __('Accions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($icons as $icon)
                                <tr>
                                    <td class="border px-4 py-2">
                                        <x-icon name="{{ pathinfo($icon->filename, PATHINFO_FILENAME) }}"
                                            class="w-20 h-20" />
                                    </td>
                                    <td class="border px-4 py-2">{{ $icon->name }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex justify-center gap-4">
                                            <a style="" x-data="{ tooltip: 'Delete' }"
                                                onclick="document.getElementById('btn-delete-{{ $icon->id }}').click();"
                                                href="#" class="delete-button btn-rojo"
                                                data-user-id="{{ $icon->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-5 w-5" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </a>
                                            <form style="display: none;"
                                                action="{{ route('icons.destroy', $icon->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="btn-delete-{{ $icon->id }}" class="btn btn-danger ">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br />
                    <a href="{{ route('icons.create') }}"
                        class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 mt-5">{{ __('Add Icon') }}</a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
