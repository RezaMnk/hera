<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
            'name' => 'بدون دسته بندی',
            'image' => 'default.png'
        ]);

        $categories = [
            'پلو' => 'polo.png',
            'چلو خورش' => 'khuresh.png',
            'چلو کباب' => 'chlo-kabab.png',
            'کباب' => 'kabab.png',
            'کتلت - کوکو - کوفه' => 'kookoo.png',
            'غذای سنتی' => 'default.png',
            'خوراک مرغ و گوشت' => 'default.png',
            'غذای دریایی' => 'daryayei-category.jpg',
            'سالاد' => 'default.png',
        ];

        $created_categories = [];
        foreach ($categories as $category => $image)
        {
            $category_model = \App\Models\Category::create([
                'name' => $category,
                'image' => $image
            ]);

            $created_categories[$category] = $category_model->id;
        }

        $foods = [
            // پلو ها
            [
                'name' => 'آلبالو پلو با مرغ',
                'description' => '۲۵۰ گرم برنج پخته - ۴۰ گرم نثار زعفران - ۶۰ گرم مایه آلبالو - یک تکه ته چین ۵۰ گرمی - یک تکه ران مرغ همراه با سس ۳۰۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 100000,
                'category_id' => $created_categories['پلو'],
                'image' => '58.jpg',
            ],
            [
                'name' => 'باقالی پلو با گوشت گوسفندی',
                'description' => '۳۱۰ گرم برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرمی - یک تکه گوشت گوسفندی با استخوان ۲۰۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 150000,
                'category_id' => $created_categories['پلو'],
                'image' => '11.jpg',
            ],
            [
                'name' => 'عدس پلو با گوشت چرخ کرده',
                'description' => '۲۹۰ گرم برنج عدس پلو - ۴۰ گرم نثار - یک تکه ته چین ۵۰ گرمی - ۸۰ گرم گوشت چرخ کرده - ۴۰ گرم کشمش و پیاز داغ - ۵ گرم روغن کرمانشاهی',
                'price' => 75000,
                'category_id' => $created_categories['پلو'],
                'image' => '47.jpg',
            ],
            [
                'name' => 'لوبیا پلو با گوشت',
                'description' => '۲۹۰ گرم برنج لوبیا پلو - ۴۰ گرم نثار - یک تکه ته چین ۵۰ گرم - ۸۰ گرم گوشت چرخ کرده - ۵ گرم روغن کرمانشاهی',
                'price' => 75000,
                'category_id' => $created_categories['پلو'],
                'image' => '51.jpg',
            ],
            [
                'name' => 'زرشک پلو با مرغ',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۲۵ گرم نثار زعفران - ۱۵ گرم نثار زرشک و خلال - یک تکه ته چین ۵۰ گرم - ۱ تکه ران مرغ ۳۰۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 90000,
                'category_id' => $created_categories['پلو'],
                'image' => '39.jpg',
            ],
            [
                'name' => 'باقالی پلو با مرغ',
                'description' => '۳۰۰ گرم برنج برنج پخته باقالی - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - یک تکه ران مرغ ۳۰۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 95000,
                'category_id' => $created_categories['پلو'],
                'image' => '12.jpg',
            ],
            [
                'name' => 'چلو اکبر جوجه',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - یک تکه مرغ اکبر جوجه ۴۰۰ گرم - ۵۰ گرم سس انار - ۵ گرم روغن کرمانشاهی',
                'price' => 100000,
                'category_id' => $created_categories['پلو'],
                'image' => '17.jpg',
            ],

            // چلو خورش ها
            [
                'name' => 'چلو خورش فسنجان با فیله مرغ',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - خورش فسنجان با یک عدد فیله مرغ ۲۲۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 90000,
                'category_id' => $created_categories['چلو خورش'],
                'image' => '20.jpg',
            ],
            [
                'name' => 'چلو خورش قرمه سبزی',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - خورش قرمه سبزی ۲۲۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 75000,
                'category_id' => $created_categories['چلو خورش'],
                'image' => '20.jpg',
            ],
            [
                'name' => 'چلو خورش قیمه بادمجان',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - خورش قیمه بادمجان ۲۲۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 75000,
                'category_id' => $created_categories['چلو خورش'],
                'image' => '21.jpg',
            ],
            [
                'name' => 'چلو خورش قیمه سیب زمینی',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - خورش قیمه سیب زمینی ۲۲۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 75000,
                'category_id' => $created_categories['چلو خورش'],
                'image' => '22.jpg',
            ],
            [
                'name' => 'چلو خورش کرفس',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - خورش کرفس ۲۲۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 75000,
                'category_id' => $created_categories['چلو خورش'],
                'image' => '20.jpg',
            ],
            [
                'name' => 'چلو خورش مسما بادمجان',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - خورش مسما بادمجان ۲۲۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 75000,
                'category_id' => $created_categories['چلو خورش'],
                'image' => '21.jpg',
            ],

            // چلو کباب ها
            [
                'name' => 'چلو جوجه کباب با استخوان',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - ۳۵۰ گرم جوجه با استخوان - یک تکه لیمو - یک عدد گوجه کبابی - یک عدد کره ۱۰ گرمی - ۵ گرم روغن کرمانشاهی',
                'price' => 98000,
                'category_id' => $created_categories['چلو کباب'],
                'image' => '29.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب زعفرانی',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - ۲۰۰ گرم جوجه - یک تکه لیمو - یک عدد گوجه کبابی - یک عدد کره ۱۰ گرمی - ۵ گرم روغن کرمانشاهی',
                'price' => 85000,
                'category_id' => $created_categories['چلو کباب'],
                'image' => '19.jpg',
            ],
            [
                'name' => 'چلوکباب لقمه زعفرانی',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - ۱۵۰ گرم لقمه زعفرانی - یک عدد سماق - یک عدد گوجه کبابی - یک عدد کره ۱۰ گرمی - ۵ گرم روغن کرمانشاهی',
                'price' => 90000,
                'category_id' => $created_categories['چلو کباب'],
                'image' => '35.jpg',
            ],
            [
                'name' => 'چلوکباب لقمه نگین دار',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - ۱۲۰ گرم لقمه زعفرانی ۳۰ گرم سینه مرغ - یک عدد سماق - یک عدد گوجه کبابی - یک عدد کره ۱۰ گرمی - ۵ گرم روغن کرمانشاهی',
                'price' => 97000,
                'category_id' => $created_categories['چلو کباب'],
                'image' => '35.jpg',
            ],
            [
                'name' => 'چلوکباب وزیری',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - ۱ سیخ لقمه ۱۵۰ گرم لقمه - ۱ سیخ جوجه کباب ۲۰۰ گرم - یک تکه لیمو - یک عدد سماق - یک عدد گوجه کبابی - یک عدد کره ۱۰ گرمی - ۵ گرم روغن کرمانشاهی',
                'price' => 140000,
                'category_id' => $created_categories['چلو کباب'],
                'image' => '26.jpg',
            ],
            [
                'name' => 'کباب دیگی با برنج',
                'description' => '۳۰۰ گرم برنج برنج پخته - ۴۰ گرم نثار زعفران - یک تکه ته چین ۵۰ گرم - ۲ تکه کباب دیگی ۷۵ گرمی جمعا ۱۵۰ گرم - ۵ گرم روغن کرمانشاهی',
                'price' => 97000,
                'category_id' => $created_categories['چلو کباب'],
                'image' => '35.jpg',
            ],

            // کباب ها
            [
                'name' => 'جوجه کباب با استخوان',
                'description' => '۲۲۵ گرم سبزیجات پخته - ۳۵۰ گرم جوجه با استخوان - یک تکه لیمو - یک عدد گوجه کبابی - ۳ بسته نان',
                'price' => 92000,
                'category_id' => $created_categories['کباب'],
                'image' => '29.jpg',
            ],
            [
                'name' => 'جوجه کباب زعفرانی',
                'description' => '۲۲۵ گرم سبزیجات پخته - ۲۰۰ گرم جوجه زعفرانی - یک تکه لیمو - یک عدد گوجه کبابی - ۳ بسته نان',
                'price' => 80000,
                'category_id' => $created_categories['کباب'],
                'image' => '30.jpg',
            ],
            [
                'name' => 'کباب لفمه زعفرانی',
                'description' => '۲۲۵ گرم سبزیجات پخته - ۱۵۰ گرم لقمه زعفرانی - یک عدد سماق - یک عدد گوجه کبابی - ۳ بسته نان',
                'price' => 85000,
                'category_id' => $created_categories['کباب'],
                'image' => '28.jpg',
            ],
            [
                'name' => 'کباب لفمه نگین دار',
                'description' => '۲۲۵ گرم سبزیجات پخته - ۱۵۰ گرم لقمه زعفرانی - ۳۰ گرم سینه مرغ - یک عدد سماق - یک عدد گوجه کبابی - ۳ بسته نان',
                'price' => 87000,
                'category_id' => $created_categories['کباب'],
                'image' => '28.jpg',
            ],
            [
                'name' => 'کباب وزیری',
                'description' => '۲۲۵ گرم سبزیجات پخته - یک سیخ لقمه ۱۵۰ گرم - یک سیخ جوجه کباب ۲۰۰ گرم - یک تکه لیمو - یک عدد سماق - یک عدد گوجه کبابی - ۳ بسته نان',
                'price' => 100000,
                'category_id' => $created_categories['کباب'],
                'image' => '26.jpg',
            ],

            // کتلت - کوکو - کوفه
            [
                'name' => 'کتلت (۲ برش ۱۰۰ گرمی)',
                'description' => '۲ تکه ۱۰۰ گرم کتلت - ۳ بسته نان ۰ ۱۰۰ گرم سبزیجات - ۲ عدد سس کچاپ',
                'price' => 70000,
                'category_id' => $created_categories['کتلت - کوکو - کوفه'],
                'image' => '3.jpg',
            ],
            [
                'name' => 'کوکو سیب زمینی (۲ تکه)',
                'description' => '۲ تکه ۱۵۰ گرم کوکو سیب زمینی - ۳ بسته نان - ۱۵۰ گرم سبزیجات',
                'price' => 60000,
                'category_id' => $created_categories['کتلت - کوکو - کوفه'],
                'image' => '5.jpg',
            ],
            [
                'name' => 'کوکو سبزی (۲ تکه ۱۵۰ گرمی)',
                'description' => '۲ تکه ۱۵۰ گرم کوکو سبزی - ۳ بسته نان - ۱۵۰ گرم سبزیجات',
                'price' => 60000,
                'category_id' => $created_categories['کتلت - کوکو - کوفه'],
                'image' => '49.jpg',
            ],
            [
                'name' => 'کوفته تبریزی',
                'description' => '۲ عدد کوفته تبریزی ۱۵۰ گرمی جمعا ۳۰۰ گرم - ۳ بسته نان',
                'price' => 65000,
                'category_id' => $created_categories['کتلت - کوکو - کوفه'],
                'image' => '63.jpg',
            ],

            // غذای سنتی
            [
                'name' => 'دلمه بادمجان (۲ تکه)',
                'description' => '۲ تکه دلمه بادمجان ۲۰۰ گرم جمعا ۴۰۰ گرم - ۳ بسته نان',
                'price' => 70000,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => '63.jpg',
            ],
            [
                'name' => 'دلمه فلفل (۲ تکه)',
                'description' => '۲ تکه دلمه فلفل ۲۰۰ گرم جمعا ۴۰۰ گرم - ۳ بسته نان',
                'price' => 70000,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => '63.jpg',
            ],
            [
                'name' => 'میرزاقاسمی',
                'description' => '۴۰۰ گرم میرزا قاسمی - ۳ بسته نان',
                'price' => 60000,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => '48.jpg',
            ],
            [
                'name' => 'کشک بادمجان',
                'description' => '۴۰۰ گرم کشک بادمجان - ۳ بسته نان',
                'price' => 55000,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => '48.jpg',
            ],
            [
                'name' => 'بشقاب سبزیجات فصل',
                'description' => '۴۵۰ گرم بشقاب سبزیجات',
                'price' => 65000,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => '14.jpg',
            ],

            // خوراک های مرغ و گوشت
            [
                'name' => 'خوراک جوجه چینی ۴ تکه',
                'description' => '۴ تکه جوجه چینی ۴۰ گرمی جمعا ۲۰۰ گرم - ۳ بسته نان - ۵۰ گرم سس تارتار',
                'price' => 90000,
                'category_id' => $created_categories['خوراک مرغ و گوشت'],
                'image' => '6.jpg',
            ],
            [
                'name' => 'خوراک شنیسل مرغ',
                'description' => 'یک تکه شنیسل مرغ ۲۰۰ گرم - ۲۲۵ گرم سبزیجات پخته - ۳ بسته نان - ۲ عدد سس کچاپ',
                'price' => 90000,
                'category_id' => $created_categories['خوراک مرغ و گوشت'],
                'image' => '7.jpg',
            ],
            [
                'name' => 'خوراک گراتن مرغ و بادمجان',
                'description' => '400 گرم گراتن مرغ و بادمجان',
                'price' => 70000,
                'category_id' => $created_categories['خوراک مرغ و گوشت'],
                'image' => '50.jpg',
            ],
            [
                'name' => 'خوراک مرغ',
                'description' => 'یک تکه مرغ ۳۰۰ گرمی - ۲۲۵ گرم سبزیجات پخته - ۳ بسته نان',
                'price' => 80000,
                'category_id' => $created_categories['خوراک مرغ و گوشت'],
                'image' => '32.jpg',
            ],
            [
                'name' => 'خوراک اکبر جوجه',
                'description' => '۴۰۰ گرم اکبر جوجه - ۲۲۵ گرم سبزیجات پخته - ۵۰ گرم سس انار - ۳ بسته نان',
                'price' => 95000,
                'category_id' => $created_categories['خوراک مرغ و گوشت'],
                'image' => '32.jpg',
            ],
            [
                'name' => 'چیکن استراگانوف',
                'description' => '۳۰۰ گرم استراگانف - ۳ بسته نان',
                'price' => 70000,
                'category_id' => $created_categories['خوراک مرغ و گوشت'],
                'image' => '2.jpg',
            ],
            [
                'name' => 'لازانیا',
                'description' => '۴۰۰ گرم لازانیا - ۲ عدد سس کچاپ',
                'price' => 85000,
                'category_id' => $created_categories['خوراک مرغ و گوشت'],
                'image' => '50.jpg',
            ],
            [
                'name' => 'خوراک امنسه',
                'description' => '۱۰۰ گرم سینه مرغ - ۲۰۰ گرم سبزیجات (گوجه، کدو، فلفل رنگی) - ۵۰ گرم قارچ',
                'price' => 60000,
                'category_id' => $created_categories['خوراک مرغ و گوشت'],
                'image' => '53.jpg',
            ],
            [
                'name' => 'دیزی',
                'description' => 'یک عدد دیزی - یک تکه پیاز - یک تکه لیمو - ۱/۳ نان سنگک',
                'price' => 90000,
                'category_id' => $created_categories['خوراک مرغ و گوشت'],
                'image' => '37.jpg',
            ],

            // غذای دریایی
            [
                'name' => 'سبزی پلو با ماهی قزل آلا',
                'description' => '۳۱۰ گرم سبزی پلو - ۴۰ گرم نثار - ۱ تکه ته چین - ماهی قزل آلا ۲۰۰ گرم - ۱ عدد لیمو',
                'price' => 120000,
                'category_id' => $created_categories['غذای دریایی'],
                'image' => '57.jpg',
            ],
            [
                'name' => 'خوراک ماهی قزل آلا',
                'description' => '۲۲۵ گرم سبزیجات پخته ۰ ماهی قزل آلا ۲۰۰ گرم - ۱ عدد لیمو',
                'price' => 105000,
                'category_id' => $created_categories['غذای دریایی'],
                'image' => '36.jpg',
            ],

            // سالاد ها
            [
                'name' => 'سالاد الویه',
                'price' => 60000,
                'category_id' => $created_categories['سالاد'],
                'image' => '40.jpg',
            ],
            [
                'name' => 'سالاد سزار',
                'price' => 75000,
                'category_id' => $created_categories['سالاد'],
                'image' => '41.jpg',
            ],
            [
                'name' => 'سالاد یونانی',
                'price' => 60000,
                'category_id' => $created_categories['سالاد'],
                'image' => '45.jpg',
            ],
        ];

        foreach ($foods as $food)
            Product::create($food);
    }
}
