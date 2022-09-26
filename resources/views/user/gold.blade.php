<x-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @section('title') Permuttio - {{ __('Gold price') }} @endsection
    <div class="bg-greenish p-2 container">
        <h1 class="text-center txt-green font-bold">{{ __('Price of gold:') }}</h1>
        <div class="graphContener">
            <canvas id="goldGraph" width="600px"></canvas>
        </div>
    </div>

    <script>
const ctx = document.getElementById('goldGraph');
const myChart = new Chart(ctx, {
type: 'line',
        data: {
        labels: [
                @foreach ($data as $gold) @if ($loop -> last)"{{$gold['data'] }}"  @break @endif "{{$gold['data'] }}",
                @endforeach
        ],
                datasets: [{
                label: '{{ __('value of 1 g gold in PLN') }}',
                        data: [
                                @foreach ($data as $gold) @if ($loop -> last)"{{$gold['cena'] }}"  @break @endif "{{$gold['cena'] }}",
                                @endforeach
                        ],
                        borderColor:'rgb(49, 151, 9)',
                        fill: true,
                        borderWidth: 1
                }]
        },
        options: {
        maintainAspectRatio: false,
        }
});

    </script>





</x-layout>