<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;
use App\Models\Update;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $url = 'https://api.nbp.pl/api/exchangerates/tables/a/?format=json';
        $url2 = 'https://api.nbp.pl/api/exchangerates/tables/b/?format=json';
        $data = json_decode(file_get_contents($url), true);
        $data2 = json_decode(file_get_contents($url2), true);

        $update = new Update();
        $update->number = $data[0]['no'];
        $update->tableAfe = 'A';
        $update->save();

        foreach ($data[0]['rates'] as $datum) {
            $currency = new Currency();
            $currency->name = $datum['currency'];
            $currency->symbol = $datum['code'];
            $currency->nbpTable = 'A';
            $currency->price = $datum['mid'];
            $currency->save();
        }


        $update = new Update();
        $update->number = $data2[0]['no'];
        $update->tableAfe = 'B';
        $update->save();

        foreach ($data2[0]['rates'] as $datum) {
            $currency = new Currency();
            $currency->name = $datum['currency'];
            $currency->symbol = $datum['code'];
            $currency->nbpTable = 'B';
            $currency->price = $datum['mid'];
            $currency->save();
        }
    }

}
