<a @if (App::currentLocale()=="en") href="{{ route('lang.change', 'pl') }}" @endif >PL</a>
<a @if (App::currentLocale()=="pl") href="{{ route('lang.change', 'en') }}" @endif>EN</a>
