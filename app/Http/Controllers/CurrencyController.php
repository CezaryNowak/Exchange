<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CurrencyController extends Controller {

    public function getCurrencies() {
        return Currency::all();
    }

    public function setUrl(Request $request) {
        return redirect('/currency/' . $request->currency . '/' . $request->date);
    }

    public function getCurrency($code = null, $date = null) {
        $price = null;
        if ($code == !null) {

            if (strlen($code) == !3)
                return redirect('/currency')->with('message', 'Currency is invalid');

            $tableVar = '';

            if (!$tableVar = Currency::where('symbol', $code)->pluck('nbptable')->first())
                return redirect('/currency')->with('message', 'Currency is invalid');
            $url = '';
            if ($date == !null) {
                try {
                    $date = Carbon::parse($date)->format('Y-m-d');
                } catch (\Exception $e) {
                    return redirect('/currency')->with('message', 'Data format is invalid');
                }
            }

            if ($date == !Carbon::today()->format('Y-m-d')) {
                $limit = Carbon::parse(strtotime('2002-01-02'))->format('Y-m-d');
                $limit = Carbon::createFromFormat('Y-m-d', $limit);
                $date = Carbon::createFromFormat('Y-m-d', $date);

                if ($date->gt($limit) == false || $date->gt(Carbon::today()) == true)
                    return redirect('/currency')->with('message', 'Date is not in limit');

                $url = 'https://api.nbp.pl/api/exchangerates/rates/' . $tableVar . '/' . $code . '/' . $date->format('Y-m-d') . '/?format=json';
            } else
                $url = 'https://api.nbp.pl/api/exchangerates/rates/' . $tableVar . '/' . $code . '/?format=json';

            $data = null;

            try {
                $data = json_decode(file_get_contents($url), true);
                $price = [
                    'error' => false,
                    'code' => $code,
                    'date' => $data['rates'][0]['effectiveDate'],
                    'price' => $data['rates'][0]['mid']
                ];
            } catch (\Exception $e) {
                $price = [
                    'error' => true,
                    'code' => $code,
                    'date' => $date->format('Y-m-d')];
            }
        }
        return view('user/currency', [
            'table' => self::getCurrencies(),
            'currency' => $price,
            'today' => Carbon::today()->format('Y-m-d')
        ]);
    }

}
