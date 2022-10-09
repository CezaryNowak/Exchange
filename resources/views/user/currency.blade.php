<x-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @section('title') Permuttio - {{ __('Check currency') }} @endsection
    <div class="bg-greenish p-1 container">
        <h1 class="text-center txt-green p-1 font-bold">{{ __('Choose currency:') }}</h1>
        <div class="container d-flex flex-column">
            <input type="text" id="currencySearch" class="form-select-lg" placeholder="{{ __('Write to search currency') }}" title="{{ __('Write to search') }}">
            <form method="POST" action="/setcurrency" class="d-flex flex-column">
                @csrf
                <select id="currencyChooseMenu" class="form-select" name="currency" size="2" required>
                    @foreach ($table as $tablum)
                    <option value="{{ $tablum->symbol }}">{{ $tablum->name }} | {{ $tablum->symbol }}</option>
                    @endforeach
                </select>
                <input type="date" name='date' min="2002-01-02" max="{{$today}}" value="{{$today}}" required>
                <button class="btn btn-primary" type="submit">{{ __('Search') }}</button>
                <b class="bg-warning">{{ __('Note:') }} {{ __("Some currencies don't have values on some days")}} </b>
            </form>
        </div>

        @if($currency)
        @if($currency['error']==false)
        <h1 class="text-center txt-green font-bold p-1"> {{ __('Value of') }} <b class="text-info">{{ $currency['code'] }}</b> <div class="text-danger">{{ $currency['price']}}PLN</div> {{ __('for')}} {{ $currency['date'] }}</h1>

        @elseif($currency['error']==true)
        <h1 class="text-center txt-green font-bold p-1"> {{ __('Value of') }} <b class="text-info">{{ $currency['code'] }}</b> <div class="text-danger">{{ __('was not found') }}</div> {{ __('for')}} {{ $currency['date'] }}</h1>
        @endif
        @endif
    </div>
    
    <script>
    //Search category on add
    var categorySearch = document.getElementById("currencySearch");
    if (categorySearch) {
        categorySearch.addEventListener("keyup", function () {
            filter = categorySearch.value.toUpperCase();
            menu = document.getElementById("currencyChooseMenu");
            options = menu.getElementsByTagName("option");

            for (i = 0; i < options.length; i++) {
                option = options[i];
                if (option.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    option.style.display = "";
                } else {
                    option.style.display = "none";
                }
            }
        });
    }
    </script>
</x-layout>