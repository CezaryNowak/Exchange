<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="icon" href="https://img.icons8.com/dusk/344/cheap-2.png">
        <link rel="stylesheet" href="{{ url('css/site.css') }}">
    </head>
    <body>
        <nav class="bg-green d-flex justify-content-between align-content-center flex-wrap"> 
            <div class="d-flex p-1">
                <a href="{{ route('homepage') }}"> <img src="https://img.icons8.com/dusk/344/cheap-2.png" style="width: 60px; height:60px" title="{{ __('Main page') }}"></a>
                <x-langSwitch/>
            </div>

            @auth
            <div class="p-1">
                <img src="{{asset('storage/logos/'.auth()->user()->nickname.'.png')}}" alt="logo">
            </div>
            <div class="d-flex gap-2 flex-wrap m-1 align-content-center mobileWidth">
                <div class="mobileWidth"><a href="{{ route('userSettings') }}" class="btn mobileWidth btn-secondary ">{{ __('Settings') }}</a></div>
                <form class="mobileWidth" method="POST" action="/user/logout">
                    @csrf
                    <button type="submit" class="btn mobileWidth btn-danger">{{ __('Logout') }}</button>
                </form>
            </div>
            @endauth
        </nav>
        @auth
        <div class="d-flex justify-content-center position-relative mobileWidth">
            <div class=" ml-1 d-flex flex-wrap justify-content-center bg-green text-white rounded-bottom gap-1 mobileWidth">
                <a class="btn btn-success mobileWidth" href="{{ route('gold') }}">{{ __('Gold price') }}</a>
                <a class="btn btn-success txt-white mobileWidth" href="{{ route('watched') }}">{{__('Observed')}}</a>
                <a class="btn btn-success txt-white mobileWidth" href="{{ route('currency') }}">{{__('Currencies')}}</a>
            </div>
        </div>
        @endauth
        <main class="bg-money d-flex mt-5 align-items-center justify-content-center position-relative mobileWidth">
            {{$slot}}
        </main>
        <footer class="border-top bg-green border-5">
            <h2 class="text-center">{{ __('Project') }}</h2>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <x-message/>
</body>
</html>
<!--
Użyte obrazy:
https://unsplash.com/photos/ROQzKIAdY78
https://icons8.com/icon/103758/dollar-coin
-->