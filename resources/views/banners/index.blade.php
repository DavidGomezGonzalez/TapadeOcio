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
                                <th class="text-left border px-4 py-2">{{ __('Title') }}</th>
                                <th class="text-left border px-4 py-2">{{ __('Category') }}</th>
                                <th class="text-left border px-4 py-2">{{ __('Municipality') }}</th>
                                <th class="border px-4 py-2">{{ __('Accions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td class="border px-4 py-2">{{ $banner->title }}</td>
                                    <td class="border px-4 py-2">{{ $banner->category->name }}</td>
                                    <td class="border px-4 py-2">{{ $banner->municipality->municipio }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('banners.show', $banner->id) }}" class="btn-ver">
                                                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                                width="25" height="25" viewBox="0 0 1280.000000 662.000000"
                                                preserveAspectRatio="xMidYMid meet">
                                               <g transform="translate(0.000000,662.000000) scale(0.100000,-0.100000)"
                                               fill="#FFFFFF" stroke="white">
                                               <path d="M6330 6609 c-1718 -102 -3518 -884 -5200 -2260 -336 -274 -685 -593
                                               -956 -873 l-173 -178 91 -99 c144 -156 523 -517 803 -764 1394 -1232 2845
                                               -2012 4275 -2299 486 -97 816 -130 1320 -130 383 -1 517 7 845 49 1372 176
                                               2726 781 3982 1781 517 411 1037 915 1406 1362 l78 93 -27 32 c-463 555 -984
                                               1081 -1491 1504 -1537 1283 -3211 1885 -4953 1782z m464 -584 c362 -42 679
                                               -139 1002 -304 957 -491 1538 -1464 1501 -2511 -22 -585 -223 -1125 -593
                                               -1590 -87 -109 -314 -336 -424 -424 -403 -322 -876 -525 -1410 -607 -214 -33
                                               -590 -33 -810 0 -560 83 -1055 305 -1470 656 -119 101 -310 302 -403 423 -298
                                               389 -481 840 -542 1332 -30 243 -15 583 35 831 237 1162 1221 2047 2440 2193
                                               160 19 514 20 674 1z"/>
                                               <path d="M6325 4819 c-557 -58 -1040 -395 -1274 -889 -180 -380 -196 -802 -47
                                               -1188 166 -430 522 -771 959 -917 203 -68 276 -79 527 -79 212 0 232 1 345 28
                                               147 34 230 64 360 126 437 210 750 611 852 1090 28 130 25 469 -4 600 -58 259
                                               -165 475 -334 677 -331 394 -863 606 -1384 552z"/>
                                               </g>
                                               </svg>
                                            </a>
                                            <a x-data="{ tooltip: 'Edite' }" class="btn-andalusia"
                                                href="{{ route('banners.edit', $banner->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-5 w-5" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                            </a>
                                            <a style="" x-data="{ tooltip: 'Delete' }"
                                                onclick="document.getElementById('btn-delete-{{ $banner->id }}').click();"
                                                href="#" class="delete-button btn-rojo"
                                                data-user-id="{{ $banner->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-5 w-5" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </a>
                                            <form style="display: none;"
                                                action="{{ route('banners.destroy', $banner->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br />
                    <a href="{{ route('banners.create') }}"
                        class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 mt-5">{{ __('Add Banner') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
