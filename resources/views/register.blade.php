@auth

@else

<x-layout>

    @section('title') Permuttio - {{ __('Register') }} @endsection

    @section('content')
    <form method="POST" action="/users" class="bg-greenish p-5">
        @csrf
        <h1 class="h3 fw-normal text-center">{{ __('Register') }}</h1>
        <div class="form-floating">
            <input type="text" class="form-control" id="Name" placeholder="Name" name="name" value="{{ old('name') }}">
            <label for="floatingName">{{ __('First name') }}</label>
            @error('name')
            <p class="text-danger">{{ $message }} </p>
            @enderror
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="Surname" placeholder="Surname" name="surname" value="{{ old('surname') }}">
            <label for="floatingLastName">{{ __('Surname') }}</label>
            @error('surname')
            <p class="text-danger">{{ $message }} </p>
            @enderror
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="Nickname" placeholder="Nickname" name="nickname" value="{{ old('nickname') }}">
            <label for="floatingInput">{{ __('Nickname') }}</label>
            @error('nickname')
            <p class="text-danger">{{ $message }} </p>
            @enderror
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="Password" placeholder="Password" name="password">
            <label for="floatingInput">{{ __('Password') }}</label>
            @error('password')
            <p class="text-danger">{{ $message }} </p>
            @enderror
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="PasswordConfirmation" placeholder="PasswordConfirmation" name="password_confirmation">
            <label for="floatingInput">{{ __('Confirm password') }}</label>
            @error('password_confirmation')
            <p class="text-danger">{{ $message }} </p>
            @enderror
        </div>
        </div>
        <button class="w-100 btn btn-lg btn-success" type="submit">{{ __('REGISTER') }}</button>
        {{ __('You already have an account?') }} <a href="{{ route('login') }}">{{ __('LOG IN') }}</a>
    </form>
</x-layout>
@endauth