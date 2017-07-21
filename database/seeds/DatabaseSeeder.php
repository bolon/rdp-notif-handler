<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call('NotifTableSeeder');
    }
}

class NotifTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('notifications')->insert([
          'response' => '{
              "redirect_url": "http://www.google.com",
              "notify_url": "https://en.wikipedia.org/wiki",
              "back_url": "https://json.org",
              "mid": "1000089484",
              "order_id": "OR123",
              "amount": "1000.00",
              "ccy": "SGD",
              "api_mode": "redirection_hosted",
              "payment_type": "S",
              "merchant_reference": "the things to reference",
              "signature": "c7e38e5c74f3f2ff91007e9bb2c90deb42f3eae5036b3b417e18bc0cd5ffce69673e7e7acc09c98a5da2f1bee5659f9cd917f94495ff17d3872ba0d185f313d0"
          }'
      ]);
    }
}
