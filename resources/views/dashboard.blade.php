<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

<x-app-layout>
    <div class="lg:py-12 lg:px-12 sm:py-6 sm:px-6 ">
        <div class="mx-auto ">
            {{-- <x-jet-welcome /> --}}

            <div class="w-full h-20 flex justify-between">
                <div class="w-1/4 sm:rounded-md bg-white shadow-2xl mr-10 px-3 py-3">
                    <b>{{ __('Users') }}</b> {{-- <x-fas-user-circle class="h-14 float-right color-andalusia"/>--}}
                    <p>@php echo DB::table('users')->count(); @endphp</p>
                </div>
                <div class="w-1/4 sm:rounded-md bg-white shadow-2xl mr-10 px-3 py-3">
                    <b>{{ __('Money') }}</b> {{-- <x-ri-money-euro-circle-line class="h-14 float-right color-andalusia"/> --}}
                    <p></p>
                </div>
                <div class="w-1/4 sm:rounded-md bg-white shadow-2xl mr-10 px-3 py-3">
                    <b>{{ __('Categories') }}</b> {{-- <x-fas-list class="h-14 float-right color-andalusia"/> --}}
                    <p>@php echo DB::table('categories')->count(); @endphp</p>
                </div>
                <div class="w-1/4 sm:rounded-md bg-white shadow-2xl px-3 py-3">
                    <b>{{ __('Subcategories') }}</b> {{-- <x-carbon-category class="h-14 float-right color-andalusia"/> --}}
                    <p>@php echo DB::table('subcategories')->count(); @endphp</p>
                </div>
            </div>

            <div class="w-full mt-12 flex
            sm:min-h-28 sm:max-h-32 /*sm:bg-red-700*/
            md:min-h-64 md:max-h-64 /*md:bg-blue-700*/ 
            lg:min-h-max lg:max-h-full /*lg:bg-green-600*/ ">
                <div class="w-1/2 sm:rounded-md bg-white shadow-2xl mr-10 px-3 py-3">
                    <div class="w-full h-full">
                        @include('users.user-chart', ['labels' => $labels, 'data' => $data])
                    </div>
                </div>
                <div class="w-1/2 sm:rounded-md bg-white shadow-2xl px-3 py-3">
                    <canvas id="myChart" height="100%"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
