<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Update;
use App\Models\Watched;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\each;

class WatchedCurrencyController extends Controller {

    public function index() {
        self::updateData();
        return view('user/watched', [
            'currencies' => self::getCurrencies()[0],
            'observed' => self::getCurrencies()[1]
        ]);
    }

    public function getCurrencies() {
        $data = self::getWatchedData();
        $id = [];

        foreach ($data as $dat)
            $id[] = $dat['id'];

        $curr = DB::table('currency')->whereNotIn('id', $id);
        return [$curr->get(), $data];
    }

//should also chceck current date if today is not weekend and if today was checked after 12 for table a
//for table b should check if todat is wensday and after 12 then chceck if it needs update

    public function updateData() {
        $url1 = 'https://api.nbp.pl/api/exchangerates/tables/a/?format=json';
        $url2 = 'https://api.nbp.pl/api/exchangerates/tables/b/?format=json';
        $data1 = json_decode(file_get_contents($url1), true);
        $data2 = json_decode(file_get_contents($url2), true);

        if ($data1[0]['no'] != Update::all()[0]->number) {

            foreach ($data1[0]['rates'] as $datum) {
                Currency::where('symbol', $datum['code'])->update([
                    'price' => $datum['mid']
                ]);
            }

            Update::whereId('1')->update([
                'number' => $data1[0]['no']
            ]);
        }
        if ($data2[0]['no'] != Update::all()[1]->number) {
            foreach ($data2[0]['rates'] as $datum) {
                Currency::where('symbol', $datum['code'])->update([
                    'price' => $datum['mid']
                ]);
            }
            Update::whereId('2')->update([
                'number' => $data2[0]['no']
            ]);
        }
    }

    public function getWatchedData() {
        $data = DB::table('watched')->where('user_id', '=', Auth::id())->get();
        $currencies = [];
        foreach ($data as $datum) {
            $currency = DB::table('currency')->where('id', '=', $datum->currency_id)->get();
            $currencies[] = [
                'id' => $datum->currency_id,
                'currency' => $currency[0]->name,
                'code' => $currency[0]->symbol,
                'price' => $currency[0]->price
            ];
        }
        return $currencies;
    }

    public function store(Request $request) {

        $formFields = $request->validate([
            'currency' => 'required'
        ]);
        if (!DB::table('watched')->where('user_id', '=', Auth::id())->where('currency_id', '=', $formFields['currency'])->get()->isEmpty()) {
            return back()->with('message', 'Adding error');
        }
        $watched = new Watched();
        $watched->user_id = Auth::id();
        $watched->currency_id = $formFields['currency'];

        $watched->save();

        return back()->with('message', 'Added new currency to watchlist');
    }

    public function destroy(Request $request) {
        if (DB::table('watched')->where('user_id', '=', Auth::id())->where('currency_id', '=', $request->id)->get()->isEmpty()) {
            return back()->with('message', 'Deleting error');
        }
        Watched::where('currency_id', $request->id)->where('user_id', Auth::id())->delete();
        return back()->with('message', 'Removed from watchlist');
    }

}
