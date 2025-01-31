@php
    use App\Models\Municipio;
    use App\Models\Provincia;
@endphp
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Users') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <!-- component -->
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                    <input wire:model="search" class="form-input rounded-md shadow-sm block w-full border-gray-200"
                        type="text" placeholder="{{ __('Search Name') }}...">
                </div>
                @if ($users->count())
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">{{ __('Name') }}</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">{{ __('Province') }}
                                </th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">{{ __('City') }}
                                </th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900 ">{{ __('State') }}</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-right">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                        <div class="relative h-10 w-10">
                                            <img class="h-full w-full rounded-full object-cover object-center"
                                                src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                            <span
                                                class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                                        </div>
                                        <div class="text-sm">
                                            <div class="font-medium text-gray-700">{{ $user->name }}</div>
                                            <div class="text-gray-400">{{ $user->email }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ Provincia::getProvinciaName($user->provincia) }} 
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ Municipio::getMunicipioName($user->municipio) }} 
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-4">
                                            <a style="" x-data="{ tooltip: 'Delete' }"
                                                onclick="document.getElementById('btn-delete-{{ $user->id }}').click();"
                                                href="#" class="delete-button btn-rojo"
                                                data-user-id="{{ $user->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-5 w-5" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </a>
                                            <form style="display: none;"
                                                action="{{ route('users.destroy', ['id' => $user->id]) }}"
                                                method="POST" class="w-full max-w-lg">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    id="btn-delete-{{ $user->id }}">DELETE</button>
                                            </form>

                                            <a x-data="{ tooltip: 'Edite' }" class="btn-andalusia"
                                                href="{{ route('users.edit', ['id' => $user->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-5 w-5" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                        {{ $users->links() }}
                    </div>
                @else
                    <div class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6 text-gray-500">
                        {{ __('No hay resultados para la búsqueda ') }}"{{ $search }}"
                    </div>
                @endif

            </div>



        </div>
    </div>
</div>
