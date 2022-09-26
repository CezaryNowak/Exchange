<x-layout>

    @section('title') Permuttio - {{ __('Exchange rate and prices of gold') }} @endsection


    @auth

    <div class="bg-greenish">
        <h1 class="text-center p-3 txt-green font-bold mb-5 mt-5">{{ __('Welcome :name to exchange rate and prices of gold site',['name'=> auth()->user()->name]) }}</h1>
        <div class="d-flex justify-content-center flex-wrap relative gap-5 align-content-center">
        </div>
    </div>

    @else

    <div class="bg-greenish">
        <h1 class="text-center p-3 txt-green font-bold mb-5 mt-5">{{ __('Welcome to exchange rate and prices of gold site') }}</h1>
        <div class="d-flex justify-content-center flex-wrap relative gap-5 align-content-center">
            <div class="d-flex flex-column">
                <a href="{{ route('login') }}" class="btn btn-success text-center">{{ __('LOGIN') }}</a>
                <h5>{{ __('I already have an account') }}</h5>
                <br>
            </div>
            <div class="d-flex flex-column">
                <a href="{{ route('register') }}" class="btn btn-secondary">{{ __('REGISTER') }}</a>
                <h5>{{ __('I am new here') }}</h5>
            </div>
        </div>
    </div>
    @endauth
</x-layout>