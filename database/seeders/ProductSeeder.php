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
            'چلوکباب' => 'chlo-kabab.png',
            'خوراک' => 'khurak.png',
            'غذای ایرانی' => 'irani.png',
            'خورشت' => 'khuresh.png',
            'غذای سنتی' => 'sonati.png',
            'غذای دریایی' => 'daryayi.png',
            'غذای فرنگی' => 'farangi.png',
            'سالاد و پیش غذا' => 'salad.png',
            'نوشیدنی' => 'noshidani.png',
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
            [
                'name' => 'چلو جوجه کباب با استخوان',
                'description' => 'یک سیخ جوجه با اسخوان ۶۰۰ گرمی، ۳۵۰-۴۰۰ گرم برنج ایرانی، کره، گوجه کبابی، لیموترش-۱ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب با استخوان.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب زعفرانی',
                'description' => 'ک سیخ جوجه سینه مرغ بدون استخوان ۳۰۰ گرمی، ۳۵۰-۴۰۰ گرم برنج ایرانی، کره، گوجه کبابی، لیموترش-۱ بسته نان لواش',
                'price' => 180000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب زعفرانی.jpg',
            ],
            [
                'name' => 'چلو کباب سلطانی',
                'description' => 'یک سیخ کباب برگ ۲۰۰ گرمی گوشت گوسفندی، یک سیخ کباب لقمه مخلوط گوشت گوساله و گوسفندی ۲۰۰ گرمی، ۳۵۰، ۴۰۰ گرم برنج ایرانی، کره، گوجه کبابی، لیموترش، ۱ بسته نان لواش',
                'price' => 480000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب سلطانی.jpg',
            ],
            [
                'name' => 'چلو کباب شیشلیک',
                'description' => 'یک سیخ کباب شیشلیگ ۴۰۰ گرمی گوشت گوسفندی-گوجه کبابی، فلفل کبابی، ۳۵۰-۴۰۰ گرم برنج ایرانی، کره-۱ بسته نان لواش',
                'price' => 390000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب شیشلیک.jpg',
            ],
            [
                'name' => 'چلو کباب لقمه زعفرانی نگین دار',
                'description' => 'یک سیخ کباب لقمه مخلوط گوشت گوساله و گوسفندی ۲۰۰ گرمی- سینه مرغ ۵۰ گرم -گوجه کبابی-۱ بسته نان لواش- ۳۵۰-۴۰۰ گرم برنج زعفرانی',
                'price' => 0,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب لقمه زعفرانی نگین دار.jpg',
            ],
            [
                'name' => 'چلو کباب وزیری',
                'description' => 'یک سیخ کباب لقمه مخلوط گوشت گوساله و گوسفندی ۲۰۰ گرمی، یک سیخ جوجه سینه مرغ بدون استخوان ۱۸۰ گرمی-۳۵۰-۴۰۰ گرم برنج ایرانی، کره، گوجه کبابی، لیموترش-۱ بسته نان لواش',
                'price' => 310000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب وزیری.jpg',
            ],
            [
                'name' => 'چلو کباب برگ ممتاز گوسفندی',
                'description' => 'یک سیخ کباب برگ ۲۰۰ گرمی گوشت گوسفندی- گوجه کبابی، ۲-۳ بسته نان لواش- ۳۵۰-۴۰۰ گرم برنج زعفرانی',
                'price' => 0,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب برگ ممتاز گوسفندی.jpg',
            ],
            [
                'name' => 'چلو کباب لقمه زعفرانی',
                'description' => 'یک سیخ کباب لقمه مخلوط گوشت گوساله و گوسفندی ۲۵۰ گرمی، ۳۵۰، ۴۰۰ گرم برنج ایرانی، کره، گوجه کبابی، ۱ بسته نان لواش',
                'price' => 200000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب لقمه زعفرانی.jpg',
            ],
            [
                'name' => 'کباب دیگی با برنج',
                'description' => '۲تکه کباب تابه ای ۸۰ گرمی، ۳۵۰-۴۰۰ گرم برنج ایرانی، کره، گوجه کبابی، لیموترش-۱ بسته نان لواش',
                'price' => 180000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'کباب دیگی با برنج.jpg',
            ],

            [
                'name' => 'خوراک کباب برگ ممتاز گوسفندی',
                'description' => 'یک سیخ کباب برگ ۲۰۰ گرمی گوشت گوسفندی- گوجه کبابی، فلفل کبابی، سیب زمینی سرخ کرده، پیازچه، گل کلم-۳ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب برگ ممتاز گوسفندی.jpg',
            ],
            [
                'name' => 'خوراک کباب شیشلیک',
                'description' => 'یک سیخ کباب شیشلیگ ۴۰۰ گرمی گوشت گوسفندی-گوجه کبابی، فلفل کبابی، سیب زمینی سرخ کرده، پیازچه-۳ بسته نان لواش',
                'price' => 370000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب شیشلیک.jpg',
            ],
            [
                'name' => 'خوراک کباب لقمه زعفرانی',
                'description' => 'یک سیخ کباب لقمه مخلوط گوشت گوساله و گوسفندی ۲۰۰ گرمی، دورچین: گوجه کبابی، فلفل کبابی۳ بسته نان لواش',
                'price' => 180000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب لقمه زعفرانی.jpg',
            ],
            [
                'name' => 'خوراک کباب لقمه زعفرانی نگین دار',
                'description' => 'یک سیخ کباب لقمه مخلوط گوشت گوساله و گوسفندی ۲۰۰ گرمی- سینه مرغ ۵۰ گرم دورچین: گوجه کبابی، فلفل کبابی۳ بسته نان لواش',
                'price' => 200000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب لقمه زعفرانی نگین دار.jpg',
            ],
            [
                'name' => 'خوراک گوشت',
                'description' => '۴۰۰-۴۵۰ گرم گوشت گوسفندی، سیب زمینی سرخ کرده، پیازچه، گل کلم، نخود فرنگی-۳ بسته نان لواش',
                'price' => 260000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک گوشت.jpg',
            ],
            [
                'name' => 'خوراک ماهیچه',
                'description' => '۴۰۰-۴۵۰ گرم ماهیچه گوسفندی، دورچین: سیب زمینی سرخ کرده، خیارشور، ۳ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک ماهیچه.jpg',
            ],
            [
                'name' => 'خوراک وزیری',
                'description' => '',
                'price' => 285000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک وزیری.jpg',
            ],
            [
                'name' => 'خوراک کباب سلطانی',
                'description' => '',
                'price' => 440000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب سلطانی.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب با استخوان',
                'description' => 'یک سیخ جوجه با اسخوان ۶۰۰ گرمی، دورچین: گوجه کبابی، فلفل کبابی، سیب زمینی سرخ کرده، پیازچه، گل کلم، ۳ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب با استخوان.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب زعفرانی',
                'description' => 'یک سیخ جوجه سینه مرغ بدون استخوان ۱۸۰ گرمی، دورچین: گوجه کبابی، فلفل کبابی، سیب زمینی پیازچه، گل کلم، ۳ بسته نان لواش',
                'price' => 170000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب زعفرانی.jpg',
            ],
            [
                'name' => 'خوراک اکبرجوجه',
                'description' => 'نصف یک مرغ کامل (۵۵۰-۶۰۰ گرم سرخ کرده)، رب انار، دورچین: سیب زمینی سرخ کرده، خیارشور، گوجه، ۳ بسته نان لواش',
                'price' => 180000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک اکبرجوجه.jpg',
            ],
            [
                'name' => 'خوراک جوجه چینی',
                'description' => '۳ تکه جوجه چینی، دورچین: گوجه کبابی، فلفل کبابی، سیب زمینی سرخ کرده، پیازچه، گل کلم، نخود فرنگی،۳ بسته نان لواش',
                'price' => 160000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه چینی.jpg',
            ],
            [
                'name' => 'خوراک شنیسل مرغ',
                'description' => '۳۰۰-۳۵۰ سینه مرغ شنیسل شده، دورچین: سیب زمینی سرخ کرده، خیارشور، گوجه-۳ بسته نان لواش',
                'price' => 160000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک شنیسل مرغ.jpg',
            ],

            [
                'name' => 'ته چین زعفرانی با ران مرغ',
                'description' => '۳۵۰-۴۰۰ گرم ته چین قالبی زعفرانی با برنج ایرانی، به همراه ۳۵۰ گرم ران مرغ کامل- زرشک',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'ته چین زعفرانی با ران مرغ.jpg',
            ],
            [
                'name' => 'باقالی پلو با گوشت گوسفندی',
                'description' => '۴۰۰، ۴۵۰ گرم گوشت گوسفندی، ۳۵۰ تا ۴۰۰ گرم باقالی پلو با برنج ایرانی، ۱ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'باقالی پلو با گوشت گوسفندی.jpg',
            ],
            [
                'name' => 'چلو گوشت',
                'description' => '۴۰۰-۴۵۰ گرم گوشت گوسفندی، ۳۵۰-۴۰۰ گرم برنج ایرانی، ۱ بسته نان لواش',
                'price' => 305000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو گوشت.jpg',
            ],
            [
                'name' => 'چلو ماهیچه',
                'description' => '۴۰۰-۴۵۰ گرم ماهیچه گوسفندی، ۳۵۰-۴۰۰ گرم برنج ایرانی-۱ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو ماهیچه.jpg',
            ],
            [
                'name' => 'آلبالو پلو با مرغ',
                'description' => '۳۵۰ گرم سینه مرغ، ۳۵۰-۴۰۰ گرم برنج ایرانی، خلال بادام، خلال پرتقال، زعفران، زرشک، یک بسته نان لواش',
                'price' => 205000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'آلبالو پلو با مرغ.jpg',
            ],
            [
                'name' => 'باقالی پلو با مرغ',
                'description' => '۳۵۰ گرم ران مرغ، ۳۵۰-۴۰۰ گرم باقالی پلو با برنج ایرانی-۱ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'باقالی پلو با مرغ.jpg',
            ],
            [
                'name' => 'چلو اکبر جوجه',
                'description' => 'نصف یک مرغ کامل (۵۵۰-۶۰۰ گرم سرخ کرده)، رب انار، ۳۵۰-۴۰۰ گرم برنج ایرانی-۱ بسته نان لواش',
                'price' => 200000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو اکبر جوجه.jpg',
            ],
            [
                'name' => 'چلو ماهی قزل آلا',
                'description' => '۳۵۰ گرم ماهی قزل آلا سرخ کرده، ۳۵۰-۴۰۰ گرم برنج ایرانی، یک بسته نان لواش',
                'price' => 225000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو ماهی قزل آلا.jpg',
            ],
            [
                'name' => 'زرشک پلو با مرغ',
                'description' => '۳۵۰ گرم ماهی قزل آلا سرخ کرده، ۳۵۰-۴۰۰ گرم برنج ایرانی، یک بسته نان لواش',
                'price' => 180000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'زرشک پلو با مرغ.jpg',
            ],
            [
                'name' => 'شیرین پلو با مرغ',
                'description' => '۳۵۰-۴۰۰,۳۵۰ گرم با ران مرغ سس پز- گرم شیرین پلو با برنج ایرانی- ۱ بسته نان لواش',
                'price' => 205000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'شیرین پلو با مرغ.jpg',
            ],
            [
                'name' => 'عدس پلو با گوشت چرخ کرده',
                'description' => '۴۵۰، ۵۵۰ گرم عدس پلو با برنج ایرانی، گوشت چرخ کرده، کشمش، ۱ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'عدس پلو با گوشت چرخ کرده.jpg',
            ],
            [
                'name' => 'لوبیا پلو با گوشت',
                'description' => '۳۵۰-۴۰۰ گرم لوبیا پلو با برنج ایرانی',
                'price' => 150000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'لوبیا پلو با گوشت.jpg',
            ],
            [
                'name' => 'آلبالو پلو',
                'description' => '۳۵۰-۴۰۰ گرم آلبالو پلو با برنج ایرانی',
                'price' => 100000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'آلبالو پلو.jpg',
            ],
            [
                'name' => 'باقالی پلو',
                'description' => '۳۵۰-۴۰۰ گرم برنج پخته شده ایرانی- باقالی',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'باقالی پلو.jpg',
            ],
            [
                'name' => 'زرشک پلو',
                'description' => '۳۵۰-۴۰۰ گرم زرشک پلو با برنج ایرانی',
                'price' => 75000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'زرشک پلو.jpg',
            ],
            [
                'name' => 'سبزی پلو',
                'description' => '۳۵۰-۴۰۰ گرم سبزی پلو با برنج ایرانی',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'سبزی پلو.jpg',
            ],
            [
                'name' => 'چلو زعفرانی',
                'description' => '۳۵۰-۴۰۰ گرم برنج ایرانی، کره',
                'price' => 65000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو زعفرانی.jpg',
            ],
            [
                'name' => 'ته چین زعفرانی',
                'description' => '۳۵۰-۴۰۰ گرم ته چین قالبی زعفرانی با برنج ایرانی',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'ته چین زعفرانی.jpg',
            ],
            [
                'name' => 'چلو گردن',
                'description' => '',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو گردن.jpg',
            ],
            [
                'name' => 'باقالی پلو با گردن',
                'description' => '',
                'price' => 0,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'باقالی پلو با گردن.jpg',
            ],

            [
                'name' => 'چلو خورشت فسنجان با فیله مرغ',
                'description' => '۲۵۰ گرم خورشت، ۲ تیکه فیله مرغ، ۳۵۰-۴۰۰ گرم برنج ایرانی-۱ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['خورشت'],
                'image' => 'چلو خورشت فسنجان با فیله مرغ.jpg',
            ],
            [
                'name' => 'چلو خورشت قرمه سبزی',
                'description' => '۲۵۰ گرم خورشت، ۳-۴ تکه گوشت گوسفندی، ۳۵۰-۴۰۰ گرم برنج ایرانی، یک بسته نان لواش',
                'price' => 160000,
                'category_id' => $created_categories['خورشت'],
                'image' => 'چلو خورشت قرمه سبزی.jpg',
            ],
            [
                'name' => 'چلو خورشت قیمه بادمجان',
                'description' => '۲۵۰ گرم خورشت، ۳-۴ تکه گوشت گوسفندی، بادمجان، ۳۵۰-۴۰۰ گرم برنج ایرانی-۱ بسته نان لواش',
                'price' => 160000,
                'category_id' => $created_categories['خورشت'],
                'image' => 'چلو خورشت قیمه بادمجان.jpg',
            ],
            [
                'name' => 'چلو خورشت قیمه سیب زمینی',
                'description' => '۲۵۰ گرم خورشت، ۳-۴ تکه گوشت گوساله، سیب زمینی، ۳۵۰-۴۰۰ گرم برنج ایرانی، یک بسته نان لواش',
                'price' => 160000,
                'category_id' => $created_categories['خورشت'],
                'image' => 'چلو خورشت قیمه سیب زمینی.jpg',
            ],
            [
                'name' => 'چلو خورشت آلو اسفناج',
                'description' => '',
                'price' => 0,
                'category_id' => $created_categories['خورشت'],
                'image' => 'چلو خورشت آلو اسفناج.jpg',
            ],
            [
                'name' => 'خورشت فسنجان با فیله مرغ (اضافه)',
                'description' => '۲۵۰ گرم خورشت، ۲ تیکه فیله مرغ',
                'price' => 0,
                'category_id' => $created_categories['خورشت'],
                'image' => 'خورشت فسنجان با فیله مرغ (اضافه).jpg',
            ],
            [
                'name' => 'خورشت قورمه سبزی (اضافه)',
                'description' => '۲۵۰ گرم خورشت، ۳-۴ تکه گوشت گوساله',
                'price' => 90000,
                'category_id' => $created_categories['خورشت'],
                'image' => 'خورشت قورمه سبزی (اضافه).jpg',
            ],
            [
                'name' => 'خورشت قیمه بادمجان (اضافه)',
                'description' => '۲۵۰ گرم خورشت، ۳-۴ تکه گوشت گوسفندی، بادمجان',
                'price' => 90000,
                'category_id' => $created_categories['خورشت'],
                'image' => 'خورشت قیمه بادمجان (اضافه).jpg',
            ],
            [
                'name' => 'خورشت قیمه سیب زمینی (اضافه)',
                'description' => '۲۵۰ گرم خورشت، ۳-۴ تکه گوشت گوساله، سیب زمینی',
                'price' => 70000,
                'category_id' => $created_categories['خورشت'],
                'image' => 'خورشت قیمه سیب زمینی (اضافه).jpg',
            ],
            [
                'name' => 'خورشت آلو اسفناج (اضافه)',
                'description' => '',
                'price' => 0,
                'category_id' => $created_categories['خورشت'],
                'image' => 'خورشت آلو اسفناج (اضافه).jpg',
            ],

            [
                'name' => 'دلمه بادمجان (دو تکه)',
                'description' => 'دلمه بادمجان ۲تکه ۲۰۰ گرمی- ۳ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => 'دلمه بادمجان (دو تکه).jpg',
            ],
            [
                'name' => 'دلمه فلفل (دو تکه)',
                'description' => 'دلمه بادمجان ۲تکه ۲۰۰ گرمی- ۳ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => 'دلمه فلفل (دو تکه).jpg',
            ],
            [
                'name' => 'کشک بادمجان',
                'description' => 'بادمجان کبابی- پیازداغ- نعنا- کشک -۳ بسته نان لواش',
                'price' => 100000,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => 'کشک بادمجان.jpg',
            ],
            [
                'name' => 'کوفته تبریزی (دو عدد)',
                'description' => '۲ عدد کوفته تبریزی ۴۰۰ گرم- گوشت چرخ کرده- لپه- برنج- آلو بخارا - سس مخصوص-۳ بسته نان لواش',
                'price' => 150000,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => 'کوفته تبریزی (دو عدد).jpg',
            ],
            [
                'name' => 'میرزا قاسمی',
                'description' => 'بادمجان کبابی- تخم مرغ- فلفل دلمه ای-۳ بسته نان لواش',
                'price' => 100000,
                'category_id' => $created_categories['غذای سنتی'],
                'image' => 'میرزا قاسمی.jpg',
            ],

            [
                'name' => 'خوراک ماهی قزل آلا',
                'description' => '۳۵۰ گرم ماهی قزل آلا سرخ کرده، دورچین: فلفل کبابی، سیب زمینی سرخ کرده، پیازچه، گل کلم، نخود فرنگی-۳ بسته نان لواش',
                'price' => 200000,
                'category_id' => $created_categories['غذای دریایی'],
                'image' => 'خوراک ماهی قزل آلا.jpg',
            ],
            [
                'name' => 'سبزی پلو با ماهی قزل آلا',
                'description' => '۳۵۰ گرم ماهی قزل آلا سرخ کرده، ۳۵۰-۴۰۰ گرم سبزی پلو با برنج ایرانی',
                'price' => 0,
                'category_id' => $created_categories['غذای دریایی'],
                'image' => 'سبزی پلو با ماهی قزل آلا.jpg',
            ],

            [
                'name' => 'بیف استراگانف',
                'description' => '۴۰۰ گرم بیف استراگانف - ۳ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['غذای فرنگی'],
                'image' => 'بیف استراگانف.jpg',
            ],
            [
                'name' => 'چیکن استرگانف',
                'description' => '۴۰۰ گرم چیکن استرگانف - ۳ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['غذای فرنگی'],
                'image' => 'چیکن استرگانف.jpg',
            ],
            [
                'name' => 'لازانیا',
                'description' => '۴۰۰ گرم لازانیا- ۲ عدد سس کچاب',
                'price' => 150000,
                'category_id' => $created_categories['غذای فرنگی'],
                'image' => 'لازانیا.jpg',
            ],

            [
                'name' => 'بشقاب سبزیجات فصل',
                'description' => '۴۰۰ گرم لازانیا- ۲ عدد سس کچاب',
                'price' => 80000,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'بشقاب سبزیجات فصل.jpg',
            ],
            [
                'name' => 'سوپ جو',
                'description' => '۴۰۰گرم سوپ جو - ۱ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'سوپ جو.jpg',
            ],
            [
                'name' => 'سوپ قارچ',
                'description' => '۴۰۰گرم سوپ قارچ - ۱ بسته نان لواش',
                'price' => 0,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'سوپ قارچ.jpg',
            ],
            [
                'name' => 'سالاد الویه (پرسی)',
                'description' => '',
                'price' => 0,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'سالاد الویه (پرسی).jpg',
            ],
            [
                'name' => 'سالاد سزار',
                'description' => '',
                'price' => 135000,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'سالاد سزار.jpg',
            ],
            [
                'name' => 'سالاد فصل',
                'description' => '',
                'price' => 75000,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'سالاد فصل.jpg',
            ],
            [
                'name' => 'سالاد یونانی',
                'description' => '',
                'price' => 120000,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'سالاد یونانی.jpg',
            ],
            [
                'name' => 'دورچین',
                'description' => '',
                'price' => 0,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'دورچین.jpg',
            ],
            [
                'name' => 'ماست موسیر (۲۴۰ گرم)',
                'description' => 'دست ساز',
                'price' => 45000,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'ماست موسیر (۲۴۰ گرم).jpg',
            ],
            [
                'name' => 'ماست و خیار (۲۴۰ گرم)',
                'description' => 'دست ساز',
                'price' => 45000,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'ماست و خیار (۲۴۰ گرم).jpg',
            ],
            [
                'name' => 'ماست برانی اسفناج',
                'description' => 'دست ساز',
                'price' => 0,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'ماست برانی اسفناج.jpg',
            ],
            [
                'name' => 'ماست شرکتی',
                'description' => '',
                'price' => 0,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => 'ماست شرکتی.jpg',
            ],

            [
                'name' => 'آب معدنی کوچک',
                'description' => '',
                'price' => 4000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'آب معدنی کوچک.jpg',
            ],
            [
                'name' => 'نوشابه قوطی فانتا',
                'description' => '',
                'price' => 4000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'نوشابه قوطی فانتا.jpg',
            ],
            [
                'name' => 'نوشابه قوطی کوکا کولا',
                'description' => '',
                'price' => 19000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'نوشابه قوطی کوکا کولا.jpg',
            ],
            [
                'name' => 'نوشابه قوطی اسپرایت',
                'description' => '',
                'price' => 19000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'نوشابه قوطی اسپرایت.jpg',
            ],
            [
                'name' => 'نوشابه قوطی کوکا کولا زیرو',
                'description' => '',
                'price' => 19000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'نوشابه قوطی کوکا کولا زیرو.jpg',
            ],
            [
                'name' => 'ماءالشعیر قوطی لیمو',
                'description' => '',
                'price' => 19900,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'ماءالشعیر قوطی لیمو.jpg',
            ],
            [
                'name' => 'ماءالشعیر قوطی استوایی',
                'description' => '',
                'price' => 19900,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'ماءالشعیر قوطی استوایی.jpg',
            ],
            [
                'name' => 'ماءالشعیر قوطی کلاسیک',
                'description' => '',
                'price' => 19900,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'ماءالشعیر قوطی کلاسیک.jpg',
            ],
            [
                'name' => 'دوغ قوطی',
                'description' => '',
                'price' => 18500,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'دوغ قوطی.jpg',
            ],
        ];

        foreach ($foods as $food)
            Product::create($food);
    }
}
