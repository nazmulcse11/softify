<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shippingaddress;

class ShippingaddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = [
            ['user_id'=>1,'name'=>'Anamul Hoque','email'=>'nazmul@gmail.com','phone'=>'012---3434','address'=>
            'Panthapath, Kolabagan Dhaka'],
            ['user_id'=>1,'name'=>'Nazmul Hoque','email'=>'nazmul@gmail.com','phone'=>'012---3434','address'=>
            'Panthapath, Kolabagan Dhaka'],
        ];
        Shippingaddress::insert($address);
    }
}
