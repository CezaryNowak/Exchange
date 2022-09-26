<x-layout>

    @section('title')Permuttio - {{ __('Log in') }}@endsection

    @section('content')
    <form method="POST" action="/user/login" class="bg-greenish p-5">
        @csrf
        <h1 class="h3 fw-normal text-center">{{ __('Log in') }}</h1>
        <div class="form-floating">
            <input type="text" class="form-control" id="Nickname" placeholder="Nickname" name="nickname" value="{{ old('nickname')}}">
            <label for="floatingInput">{{ __('Nickname') }}</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="Password" name="password" placeholder="Password">
            <label for="floatingPassword">{{ __('Password') }}</label>
        </div>
        </div>
        @error('nickname')
        <p class="text-danger">{{ __($message) }} </p>
        @enderror
        @error('password')
        <p class="text-danger">{{$message}} </p>
        @enderror
        <button class="w-100 btn btn-lg btn-success" type="submit">{{ __('LOG IN') }}</button>
        {{ __("You don't have an account?" )}} <a href="{{ route('register') }}">{{ __('REGISTER') }}</a>
    </form>
</x-layout>