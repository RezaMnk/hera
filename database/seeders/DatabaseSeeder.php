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

        $settings = [
            'shipping_price' => [
                'name' => 'هزینه ارسال',
                'value' => '15000',
            ],
            'start_time' => [
                'name' => 'ساعت شروع کار مجموعه',
                'value' => '12:00',
            ],
            'end_time' => [
                'name' => 'ساعت پایان کار مجموعه',
                'value' => '21:30',
            ],
            'sms_verify' => [
                'name' => 'پنل پیامکی - شناسه تایید 2 مرحله ای',
                'value' => 'verify',
            ],
            'sms_order_submit' => [
                'name' => 'پنل پیامکی - شناسه ثبت سفارش',
                'value' => 'new-order',
            ],
            'send_order_submit_sms' => [
                'name' => 'پنل پیامکی - ارسال تاییدیه ثبت سفارش',
                'value' => 'true',
            ],
        ];

        foreach ($settings as $id => $setting)
            \App\Models\Setting::create([
                'id' => $id,
                'name' => $setting['name'],
                'value' => $setting['value']
            ]);

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
