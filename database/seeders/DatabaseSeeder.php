<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::create([
             'name' => 'رضا نداف',
             'phone' => '09212969916',
             'password' => 12345678,
             'verified' => 1,
             'admin' => 1,
         ]);

         \App\Models\Category::create([
             'name' => 'بدون دسته بندی',
             'image' => 'default.png'
         ]);
    }
}
