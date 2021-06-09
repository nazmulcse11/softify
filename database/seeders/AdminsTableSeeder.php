<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            ['name'=>'Nazmul Hoque','email'=>'nazmul@gmail.com','password'=>bcrypt('12345678')],
            ['name'=>'Anamul Hoque','email'=>'anamul@gmail.com','password'=>bcrypt('12345678')],
        ];
        Admin::insert($admins);
    }
}
