<x-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @section('title') Permuttio - {{ __('Observed currency') }} @endsection
    <div class="bg-greenish p-1 container">
        <h1 class="text-center txt-green p-1 font-bold">{{ __('Add new currency:') }}</h1>
        <div class="container d-flex flex-column">
            <input type="text" id="currencySearch" class="form-select-lg" placeholder="{{ __('Search currency') }}" title="{{ __('Write to search') }}">
            <form method="POST" action="/observe" class="d-flex flex-column">
                @csrf
                <select id="currencyChooseMenu" class="form-select-lg" name="currency" size="2" required>
                    @foreach ($currencies as $currency)
                    <option value="{{ $currency->id }}">{{ $currency->name }} | {{ $currency->symbol }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">{{ __('Add to watchlist') }}</button>
            </form>
            @error('currency')
            <p class="text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <h1 class="text-center txt-green font-bold">{{ __('Your watched currency:') }}</h1>
        <div class="d-flex p-1 flex-wrap justify-content-center gap-1">
            @if($observed==null)
            <h1>{{ __("You don't observe any currency") }}</h1>
            @endif
            @foreach($observed as $observe)
            <div class="border border-info p-1 currencyContainer">
                <div class="d-flex justify-content-between"><h2>1 {{ $observe['code']}}</h2><form method="POST" action="/observe/delete" >@csrf<button type="submit" value="{{$observe['id']}}" name="id" class="text-danger btn btn-dark btn-outline-light">X</button></form></div>
                {{ __('Price:')}} {{ $observe['price']}}PLN</div>
            @endforeach
        </div>
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