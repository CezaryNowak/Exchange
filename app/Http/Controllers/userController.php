<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class userController extends Controller {

    // login form
    public function login() {
        if (auth()->check()) {
            return redirect('/');
        }

        return view('login');
    }

    // log in
    public function authenticate(Request $request) {
        if (auth()->check()) {
            return redirect('/');
        }

        $formFields = $request->validate([
            'nickname' => ['required'],
            'password' => ['required']
        ]);
        
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            if (Storage::disk('public')->exists('logos/' . auth()->user()->nickname . '.png') == false) {
                $url='https://ui-avatars.com/api/?name=' . auth()->user()->name . '+' . auth()->user()->surname . '&background=3ebe3e&color=ffffff&rounded=true';
                Storage::disk('public')->put('logos/' . $formFields['nickname'] . '.png', file_get_contents($url));
            }
           

            return redirect('/')->with('message', 'You are logged in');
        }

        return back()->withErrors(['nickname' => 'Invalid Credentials'])->onlyInput('nickname');
    }

    public function logout(Request $request) {
        auth()->logout();
        $lang = App::currentLocale();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::put('applocale', $lang);
        return redirect('/')->with('message', 'You have been logged out');
    }

    // Register form
    public function create() {
        if (auth()->check()) {
            return redirect('/');
        }

        return view('register');
    }

    // Add new user
    public function store(Request $request) {

        // Logged in?
        if (auth()->check()) {
            return redirect('/');
        }

        // Validate
        $formFields = $request->validate([
            'name' => ['required', 'min:3', 'alpha'],
            'surname' => ['required', 'min:3', 'alpha'],
            'nickname' => ['required', 'min:5', 'alpha_num', Rule::unique('users', 'nickname')],
            'password' => 'required|confirmed|min:5'
        ]);

        // Hash Password
        $formFields['password'] = Hash::make($formFields['password']);
        $formFields['name'][0] = strtoupper($formFields['name'][0]);
        $formFields['surname'][0] = strtoupper($formFields['surname'][0]);

        // Create User
        $user = User::create($formFields);
        $url = 'https://ui-avatars.com/api/?name=' . $formFields['name'] . '+' . $formFields['surname'] . '&background=3ebe3e&color=ffffff&rounded=true';
        Storage::disk('public')->put('logos/' . $formFields['nickname'] . '.png', file_get_contents($url));

        // Log in
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    //settings
    public function edit() {
        return view('user/userSettings');
    }

    //change password
    public function update(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:5'
        ]);

        if (!Hash::check($request->old_password, auth()->user()->getAuthPassword())) {
            return back()->withErrors(['old_password' => 'Wrong password'])->onlyInput('old_password');
        }

        User::whereId(auth()->id())->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('/')->with('message', 'Password was changed');
    }

    public function destroy(Request $request) {
        $request->validate([
            'password' => 'required'
        ]);
        if (!Hash::check($request->password, auth()->user()->getAuthPassword())) {
            return back()->withErrors(['password' => 'Wrong password'])->onlyInput('password');
        }
        $userId = Auth::id();
        $lang = App::currentLocale();
        Storage::disk('public')->delete('logos/' . auth()->user()->nickname . '.png');
        auth()->logout();
        User::whereId($userId)->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::put('applocale', $lang);
        return redirect('/')->with('message', 'Your account has been deleted');
    }

}
