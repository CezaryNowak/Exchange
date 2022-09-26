<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class GoldController extends Controller {

    public function getData() {
        $timeToday = Carbon::today()->format('Y-m-d');
        $time10 = Carbon::today()->subDays(11)->format('Y-m-d');
        $url = 'https://api.nbp.pl/api/cenyzlota/' . $time10 . '/' . $timeToday . '/?format=json';
        return json_decode(file_get_contents($url), true);
    }

    public function index() {
        return view('user/gold', [
            'data' => self::getData()
        ]);
    }

}
