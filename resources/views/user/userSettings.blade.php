<x-layout>

    @section('title')Permuttio - {{ __('Settings') }} @endsection

    @section('content')
    <div >
        <form method="POST" action="/user/changePass" class="bg-greenish p-5 m-2">
            @csrf
            <h1 class="h3 fw-normal text-center">{{ __('Change password') }}</h1>
            <div class="form-floating">
                <input type="password" class="form-control" id="OldPassword" placeholder="Password" name="old_password">
                <label for="floatingInput">{{ __('Current password') }}</label>
                @error('old_password')
                <p class="text-danger">{{ __($message) }} </p>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="NewPassword" placeholder="NewPassword" name="new_password" >
                <label for="floatingInput">{{ __('New password') }}</label>
                @error('new_password')
                <p class="text-danger">{{ $message }} </p>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="PasswordConfirmation" placeholder="PasswordConfirmation" name="new_password_confirmation" >
                <label for="floatingInput">{{ __('Confirm new password') }}</label>
            </div>
            <button class="w-100 btn btn-lg btn-success" type="submit">{{ __('CHANGE PASSWORD') }}</button>
        </form>
        <form method="POST" action="/user/delete" class="bg-greenish p-5 m-2">
            @csrf
            <h1 class="h3 fw-normal text-center">{{ __('Delete account') }}</h1>
            <div class="form-floating">
                <input type="password" class="form-control" id="OldPassword" placeholder="Password" name="password">
                <label for="floatingInput">{{ __('Password') }}</label>
                @error('password')
                <p class="text-danger">{{ __($message) }} </p>
                @enderror
            </div>
            <button class="w-100 btn btn-lg btn-danger" type="submit">{{ __('DELETE ACCOUNT') }}</button>
        </form>
    </div>
</x-layout>
