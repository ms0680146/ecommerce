<?php

use Illuminate\Database\Seeder;
use App\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'TEST123',
            'sale_type' => Coupon::SALE_TYPE_PRICE,
            'sale_string' => '100',
        ]);

        Coupon::create([
            'code' => 'TEST1234',
            'sale_type' => Coupon::SALE_TYPE_DISCOUNT,
            'sale_string' => '0.5',
        ]);

        Coupon::create([
            'code' => 'TEST12345',
            'sale_type' => Coupon::SALE_TYPE_DISCOUNT,
            'sale_string' => '0.85',
        ]);
    }
}
