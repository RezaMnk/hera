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
            'غذای روزانه' => 'khuresh.png',
            'چلوکباب' => 'chlo-kabab.png',
            'کباب' => 'kabab.png',
            'ساندویچ' => 'kookoo.png',
            'غذای ایرانی' => 'sonati.png',
            'خوراک' => 'khurak.png',
            'غذای دریایی' => 'daryayi.jpg',
            'سالاد و پیش غذا' => 'salad.png',
            'نوشیدنی' => 'default.png',
            'سرویس اضافه' => 'default.png',
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
            // چلوکباب
            [
                'name' => 'چلو کباب برگ ممتاز گوسفندی',
                'description' => 'کباب برگ گوسفندی ۲۲۰ گرم، گوجه کبابی، لیموترش،فلفل کبابی ، کره حیوانی،۴۵۰ گرم برنج ایرانی',
                'price' => 250000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب برگ ممتاز گوسفندی.jpg',
            ],
            [
                'name' => 'چلوکباب سلطانی گوسفندی',
                'description' => 'یک سیخ کباب برگ گوسفندی ۲۰۰ گرمی، یک سیخ کباب کوبیده مخلوط گوشت گوساله و گوسفندی ۱۵۰ گرمی، گوجه کبابی، کره حیوانی، فلفل کبابی، لیموترش، برنج ایرانی ۴۵۰ گرم',
                'price' => 305000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلوکباب سلطانی گوسفندی.jpg',
            ],
            [
                'name' => 'چلو کباب بختیاری',
                'description' => 'یک سیخ کباب بختیاری ترکیب ۲۰۰ گرم جوجه کباب سینه و ۸۰ گرم کباب برگ گوسفندی، دورچین: گوجه کبابی، لیموترش، فلفل کبابی، کره حیوانی، ۴۵۰ گرم برنج ایرانی',
                'price' => 203000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب بختیاری.jpg',
            ],
            [
                'name' => 'چلو کباب کوبیده دوسیخ',
                'description' => 'کباب کوبیده مخلوط گوشت تازه گوساله و گوسفندی ۱۵۰ گرمی، گوجه کبابی، کره حیوانی، فلفل کبابی، لیوترش، ۴۵۰گرم برنج ایرانی',
                'price' => 150000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب کوبیده دوسیخ.jpg',
            ],
            [
                'name' => 'چلو کباب لقمه مخصوص قریشی',
                'description' => 'یک سیخ کباب لقمه مخلوط گوشت تازه گوساله و گوسفندی ۲۵۰گرمی، گوجه کبابی، لیموترش، فلفل کبابی، ۴۵۰گرم برنج ایرانی',
                'price' => 128000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو کباب لقمه مخصوص قریشی.jpg',
            ],
            [
                'name' => 'چلوکباب کوبیده یک سیخ',
                'description' => 'یک سیخ کباب کوبیده مخلوط گوشت گوساله و گوسفندی ۱۵۰گرمی، گوجه کبابی، لیموترش، فلفل کبابی، ۴۵۰ گرم برنج ایرانی',
                'price' => 96000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلوکباب کوبیده یک سیخ.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب زعفرانی سینه',
                'description' => 'یک سیخ جوجه کباب سینه زعفرانی ۳۵۰گرم ، گوجه کبابی، لیمو، فلفل کبابی ، روغن حیوانی. برنج ۴۰۰ گرم ایرانی',
                'price' => 121000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب زعفرانی سینه.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب ران',
                'description' => 'یک سیخ جوجه کباب ران زعفرانی ۳۰۰گرمی، لیموترش، گوجه کبابی، کره حیوانی، فلفل کبابی، ۴۵۰ گرم برنج ایرانی',
                'price' => 122000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب ران.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب سرآشپز',
                'description' => 'یک سیخ جوجه کباب ۳۵۰ گرم ران مرغ با سس سرآشپز، ۴۵۰ گرم برنج ایرانی، فلفل کبابی، گوجه کبابی، لیمو ترش، روغن حیوانی',
                'price' => 125000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب سرآشپز.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب با استخوان',
                'description' => 'یک عدد مرغ ۲۸ روزه ۷ تکه، ۴۵۰ گرم برنج ایرانی، گوجه کبابی، لیموترش، فلفل کبابی، کره حیوانی',
                'price' => 161500,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب باستخوان.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب ترش ران',
                'description' => 'یک سیخ جوجه کباب ترش ران ۳۵۰ گرمی، ۴۵۰ گرم برنج ایرانی، رب انار، فلفل کبابی، لیمو ترش، گوجه کبابی، روغن حیوانی',
                'price' => 126000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب ترش ران.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب سبزیجات ران',
                'description' => 'یک سیخ جوجه کباب ران مرغ طمع دار شده (سیر و سبزیجات) ۳۰۰گرمی، ۴۵۰گرم برنج ایرانی، دورچین: کره، فلفل کبابی، لیموترش، روغن حیوانی',
                'price' => 126000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب سبزیجات ران.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب مکزیکی ران',
                'description' => 'یک سیخ جوجه کباب ران مرغ ۳۵۰ گرمی طمع دارشده( ادویه فلفل و کاری)، ۴۵۰ گرم برنج ایرانی، دورچین: فلفل کبابی، گوجه کبابی، لیموترش، روغن حیوانی',
                'price' => 126000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب مکزیکی ران.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب باربیکیو ران',
                'description' => 'یک سیخ جوجه کباب ران مرغ طمع دار شده با سرکه بالزامیک و رب انار ۳۰۰ گرمی، ۴۵۰ گرم برنج ایرانی، دورچین: فلفل کبابی، گوجه کبابی، لیموترش، روغن حیوانی',
                'price' => 126000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => 'چلو جوجه کباب باربیکیو ران.jpg',
            ],
            [
                'name' => 'چلو جوجه کباب معمولی',
                'description' => 'یک سیخ جوجه کباب سینه زعفرانی ۲۵۰ گرمی، ۴۵۰ گرم برنج ایرانی، گوجه کبابی، لیموترش، فلفل کبابی، کره حیوانی',
                'price' => 105000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => '',
            ],
            [
                'name' => 'چلو کباب میکس ران',
                'description' => 'یک سیخ جوجه کباب ران ۳۵۰ گرمی، یک سیخ کباب کوبیده ۱۵۰ گرمی مخلوط گوشت تازه گوساله و گوسفندی، فلفل کبابی، گوجه کبابی، لیموترش، ۴۵۰ گرم برنج ایرانی',
                'price' => 176000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => '',
            ],
            [
                'name' => 'چلو کباب میکس سینه',
                'description' => 'یک سیخ جوجه سینه زعفرانی ۳۵۰ گرمی، یک سیخ کباب کوبیده ۱۵۰ گرمی مخلوط گوشت تازه گوساله و گوسفندی، گوجه کبابی، فلفل کبابی، لیموترش، روغن حیوانی، ۴۵۰ گرم برنج ایرانی',
                'price' => 177000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => '',
            ],
            [
                'name' => 'چلو کره',
                'description' => '۴۵۰ گرم برنج ایرانی، کره حیوانی',
                'price' => 42000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => '',
            ],
            [
                'name' => 'چلو بال کبابی',
                'description' => 'یک سیخ بال کبابی ۷ عددی، ۴۵۰ گرم برنج ایرانی، دورچین: یموترش، کره حیوانی',
                'price' => 92000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => '',
            ],
            [
                'name' => 'چلو کباب برگ ممتاز گوسفندی',
                'description' => 'کباب برگ گوسفندی ۲۲۰ گرم، گوجه کبابی، لیموترش،فلفل کبابی ، کره حیوانی،۴۵۰ گرم برنج ایرانی',
                'price' => 250000,
                'category_id' => $created_categories['چلوکباب'],
                'image' => '63a0b826331c8.jpg',
            ],
            // خوراک
            [
                'name' => 'خوراک کباب برگ ممتاز گوسفندی',
                'description' => 'یک سیخ کباب برگ گوسفندی ۲۰۰ گرم ، خیارشور ، لیموترش ، گوجه کبابی ۲ عدد نان لواش نصفه یک عدد',
                'price' => 219500,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب برگ ممتاز گوسفندی.jpg',
            ],
            [
                'name' => 'خوراک کباب برگ سلطانی',
                'description' => 'یک سیخ کباب برگ ۲۰۰ گرم ،کوبیده ۱۵۰ گرم ، گوجه کبابی ، لیموترش ،خیارشور ، نان لواش نصفه یک عدد',
                'price' => 274500,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب برگ سلطانی.jpg',
            ],
            [
                'name' => 'خوراک کباب بختیاری',
                'description' => 'یک سیخ جوجه ۲۰۰ گرم ، برگ گوسفندی ۸۰ گرم ،گوجه کبابی، لیمو ترش، فلفل کبابی ،خیارشور ، نان لواش نصفه یک عدد',
                'price' => 173000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب بختیاری.jpg',
            ],
            [
                'name' => 'خوراک کباب لقمه مخصوص قریشی',
                'description' => 'یک سیخ کباب لقمه ۲۵۰ گرمی مخلوط گوشت تازه گوساله وگوسفندی ، گوجه کبابی، خیارشور ، فلفل کبابی . نان لواش نصفه یک عدد',
                'price' => 102500,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب لقمه مخصوص قریشی.jpg',
            ],
            [
                'name' => 'خوراک کباب کوبیده یک سیخ',
                'description' => 'یک عدد کباب ۱۵۰ گرم، خیارشور، فلفل کبابی، نصف یک عدد نان لواش',
                'price' => 62000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب کوبیده یک سیخ.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب سینه',
                'description' => 'یک سیخ جوجه کباب زعفرانی ۳۵۰ گرمی، خیارشور، گوجه کبابی یک عدد، لیمو ترش، نان لواش نصفه یک عدد',
                'price' => 91000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب سینه.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب زعفرانی ران',
                'description' => 'یک سیخ جوجه زعفرانی ران ۳۵۰ گرم ،خیارشور ، لیموترش ، گوجه کبابی، نان لواش نصفه ، فلفل کبابی',
                'price' => 92000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب زعفرانی ران.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب با استخوان',
                'description' => 'یک عددجوجه ۲۸ روزه ۷ تکه ۸۰۰ گرمی، خیارشور، فلفل کبابی، گوجه، نان لواش نصفه، لیمو ترش',
                'price' => 135000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب با استخوان.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب ترش ران',
                'description' => 'یک سیخ جوجه طمع دارشده ران ۳۰۰ گرم ، خیارشور ، فلفل کبابی ، گوجه ، لیمو ترش ،نان لواش نصفه یک عدد',
                'price' => 97000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب ترش ران.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب مکزیکی',
                'description' => 'یک سیخ جوجه طمع دارشده ۳۰۰گرم، خیارشور ، گوجه کبابی ، لیموترش ، فلفل کبابی',
                'price' => 97000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب مکزیکی.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب سبزیجات',
                'description' => 'یک سیخ جوجه سبزیجات طمع دارشده ۳۰۰ گرمی، خیارشور، گوجه، فلفل کبابی، لیموترش، نان لواش نصفه',
                'price' => 97000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب سبزیجات.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب باربیکیو',
                'description' => 'یک سیخ جوجه کباب باربیکیو طمع دارشده ۳۰۰ گرمی، گوجه کبابی، فلفل کبابی، لیموترش، خیارشور، نان لواش نصفه یک عدد',
                'price' => 97000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب باربیکیو.jpg',
            ],
            [
                'name' => 'خوراک جوجه کباب سرآشپز ران',
                'description' => 'یک سیخ جوجه کباب طمع دارشده با سس مخصوص سر آشپز ۳۵۰ گرمی، فلفل کبابی، گوجه کبابی، خیارشور، لیموترش، نان لواش نصفه یک عدد',
                'price' => 97000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک جوجه کباب سرآشپز ران.jpg',
            ],
            [
                'name' => 'خوراک بال کبابی',
                'description' => '۷ عدد بال کبابی زعفرانی، لیموترش',
                'price' => 50000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک بال کبابی.jpg',
            ],
            [
                'name' => 'خوراک گوشت گوسفندی',
                'description' => 'یک پرس گوشت ران گوسفندی ۲۰۰ گرمی، لیموترش',
                'price' => 170000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک گوشت گوسفندی.jpg',
            ],
            [
                'name' => 'خوراک مرغ سرخ شده ران',
                'description' => 'یک عدد ران مرغ ۴۵۰ گرمی طبخ اکبر جوجه، خیارشور، گوجه، فلفل کبابی، نان لواش یک نصفه',
                'price' => 78000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک مرغ سرخ شده ران.jpg',
            ],
            [
                'name' => 'خوراک ماهی قزل آلا سرخ شده',
                'description' => 'یک عدد ماهی ۵۰۰ گرم، خیارشور، لیموترش، فلفل کبابی',
                'price' => 121000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک ماهی قزل آلا سرخ شده.jpg',
            ],

            [
                'name' => 'خوراک کباب کوبیده دو سیخ',
                'description' => 'دو عدد کباب ۱۵۰ گرم، خیارشور، فلفل کبابی، نصف یک عدد نان لواش دو عدد گوجه',
                'price' => 124000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک کباب کوبیده دو سیخ.jpg',
            ],
            [
                'name' => 'گوجه کبابی',
                'description' => 'چهار عدد گوجه کباب نصفه',
                'price' => 7000,
                'category_id' => $created_categories['خوراک'],
                'image' => '',
            ],
            [
                'name' => 'خوراک کباب میکس سینه',
                'description' => 'یک سیخ جوجه کباب ۳۵۰ گرمی، یک سیخ کباب کوبیده ۱۵۰ گرمی گوشت تازه گوساله و گوسفندی، خیارشور، فلفل کبابی، لیموترش، نان لواش نصفه',
                'price' => 146000,
                'category_id' => $created_categories['خوراک'],
                'image' => '',
            ],
            [
                'name' => 'خوراک کباب میکس ران',
                'description' => 'یک سیخ جوجه ران ۳۵۰ گرم ، کوبیده ۱۵۰ گرم مخلوط گوشت تازه گوسفندی و گوساله ، خیارشور ، فلفل کبابی ، لیموترش ، گوجه ،نان لواش نصفه',
                'price' => 147000,
                'category_id' => $created_categories['خوراک'],
                'image' => '',
            ],
            [
                'name' => 'خوراک گردن گوسفندی',
                'description' => 'گردن گوسفندی ۴۵۰ گرمی، روغن حیوانی',
                'price' => 205000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک گردن گوسفندی.jpg',
            ],
            [
                'name' => 'خوراک ماهیچه گوسفندی',
                'description' => 'یک عدد ماهیچه گوسفندی ۴۰۰ گرمی ،لیموترش',
                'price' => 240000,
                'category_id' => $created_categories['خوراک'],
                'image' => 'خوراک ماهیچه گوسفندی.jpg',
            ],

            // غذای ایرانی
            [
                'name' => 'چلو گوشت گوسفندی',
                'description' => 'یک پرس گوشت گوسفندی ۲۰۰ گرم، روغن حیوانی، ۴۵۰ گرم برنج ایرانی',
                'price' => 200000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو گوشت گوسفندی.jpg',
            ],
            [
                'name' => 'زرشک پلو بامرغ سرخ شده',
                'description' => 'یک عدد ران مرغ ۴۵۰ گرمی، روغن حیوانی، رب انار ۲ عدد، ۴۵۰ گرم برنج ایرانی',
                'price' => 108000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'زرشک پلو بامرغ سرخ شده.jpg',
            ],
            [
                'name' => 'چلو ماهی قزل آلا',
                'description' => 'یک عدد ماهی قزل آلا ۵۰۰ گرمی، لیموترش، فلفل کبابی، روغن حیوانی، ۴۵۰ گرم برنج ایرانی',
                'price' => 150500,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو ماهی قزل آلا.jpg',
            ],
            [
                'name' => 'چلو گردن گوسفندی',
                'description' => 'یک پرس گردن گوسفندی ۴۵۰ گرمی، روغن حیوانی، ۴۵۰ گرم برنج ایرانی',
                'price' => 235000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو گردن گوسفندی.jpg',
            ],
            [
                'name' => 'چلو ماهیچه گوسفندی',
                'description' => 'یک عدد ماهیچه گوسفندی ۴۰۰ گرم ، روغن حیوانی ، ۴۵۰ گرم برنج ایرانی',
                'price' => 270000,
                'category_id' => $created_categories['غذای ایرانی'],
                'image' => 'چلو ماهیچه گوسفندی.jpg',
            ],

            // غذای روزانه
            [
                'name' => 'خورشت قیمه سیب زمینی سرخ شده (اضافه)',
                'description' => 'یک پرس خورشت قیمه بدون برنج به میزان ۴۰۰ گرم',
                'price' => 60000,
                'category_id' => $created_categories['غذای روزانه'],
                'image' => 'خورشت قیمه سیب زمینی سرخ شده (اضافه).jpg',
            ],
            [
                'name' => 'خورشت قیمه بادمجان سرخ شده (اضافه)',
                'description' => 'یک پرس خورشت قیمه بادمجان به میزان ۴۰۰ گرم',
                'price' => 60000,
                'category_id' => $created_categories['غذای روزانه'],
                'image' => 'خورشت قیمه بادمجان سرخ شده (اضافه).jpg',
            ],
            [
                'name' => 'چلو خورشت قیمه بادمجان سرخ شده',
                'description' => 'یک پرس خورشت قیمه بادمجان به میزان ۴۰۰ گرم، ۴۰۰ گرم برنج ایرانی',
                'price' => 93500,
                'category_id' => $created_categories['غذای روزانه'],
                'image' => 'چلو خورشت قیمه بادمجان سرخ شده.jpg',
            ],
            [
                'name' => 'چلو خورشت قیمه سیب زمینی سرخ شده',
                'description' => '۴۰۰ گرم خورشت قیمه، ۴۰۰ گرم برنج ایرانی',
                'price' => 93500,
                'category_id' => $created_categories['غذای روزانه'],
                'image' => 'چلو خورشت قیمه سیب زمینی سرخ شده.jpg',
            ],
            // ساندویچ
            [
                'name' => 'ساندویچ جوجه کباب سینه',
                'description' => 'یک سیخ جوجه کباب سینه زعفرانی ۳۰۰ گرم نان فانتزی، خیارشور، گوجه پخته، سبزی جعفری',
                'price' => 100000,
                'category_id' => $created_categories['ساندویچ'],
                'image' => 'ساندویچ جوجه کباب سینه.jpg',
            ],
            [
                'name' => 'ساندویج کباب لقمه',
                'description' => 'یک سیخ کباب لقمه ۲۵۰ گرم گوشت تازه گوساله و گوسفندی، نان فانتزی یا سنگک، گوجه پخته، خیارشور، سبزی جعفری',
                'price' => 111000,
                'category_id' => $created_categories['ساندویچ'],
                'image' => 'ساندویج کباب لقمه.jpg',
            ],
            [
                'name' => 'ساندویچ جوجه کباب ران',
                'description' => 'یک سیخ جوجه کباب ران مرغ ۳۰۰ گرم، نان فانتزییا نان سنگک، گوجه پخته، خیارشور، سبزی جعفری',
                'price' => 101000,
                'category_id' => $created_categories['ساندویچ'],
                'image' => 'ساندویچ جوجه کباب ران.jpg',
            ],
            [
                'name' => 'ساندویج کباب کوبیده ۱سیخ',
                'description' => 'یک سیخ کباب کوبیده ۱۵۰ گرم گوشت تازه گوساله و گوسفندی، نان فانتزی یا نان سنگک، خیارشور، گوجه پخته، سبزی جعفری',
                'price' => 60000,
                'category_id' => $created_categories['ساندویچ'],
                'image' => 'ساندویج کباب کوبیده ۱سیخ.jpg',
            ],
            [
                'name' => 'ساندویچ جوجه سرآشپز',
                'description' => 'یک سیخ جوجه کباب ران طمه دارشده ۳۰۰ گرم',
                'price' => 106000,
                'category_id' => $created_categories['ساندویچ'],
                'image' => 'ساندویچ جوجه سرآشپز.jpg',
            ],
            [
                'name' => 'ساندویچ جوجه سبزیجات',
                'description' => 'یک سیخ جوجه طمع دار شده ۳۰۰ گرم، نان فانتزی یا نان سنگک، مخلفات گوجه و خیارشور، سس',
                'price' => 106000,
                'category_id' => $created_categories['ساندویچ'],
                'image' => '',
            ],
            // سالاد و پیش غذا

            [
                'name' => 'ماست موسیر',
                'description' => '۱۰۰گرم ماست موسیر شرکتی گوارا',
                'price' => 7000,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => '63a0ba83021df.jpg',
            ],
            [
                'name' => 'زیتون پرورده',
                'description' => '۸۰ گرم زیتون پروده شرکتی',
                'price' => 15000,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => '63a0ba5926b3b.jpg',
            ],
            [
                'name' => 'سالاد فصل',
                'description' => '۱۲۰ گرم سالاد کاهو شرکتی بامیکا، دو عدد سس فرانسوی',
                'price' => 17000,
                'category_id' => $created_categories['سالاد و پیش غذا'],
                'image' => '63a0ba5e9210f.jpg',
            ],
            // نوشیدنی

            [
                'name' => 'نوشابه بطری کوکاکولا',
                'description' => '۳۰۰ میلی لیتر',
                'price' => 7900,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'Coca-Cola.jpg',
            ],
            [
                'name' => 'نوشابه بطری فانتا',
                'description' => '۳۰۰ میلی لیتر',
                'price' => 7900,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'fanta.jpg',
            ],
            [
                'name' => 'نوشابه بطری اسپرایت',
                'description' => '۳۰۰ میلی لیتر',
                'price' => 7900,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'sprite.jpg',
            ],
            [
                'name' => 'نوشابه خانواده کوکاکولا',
                'description' => '۱.۵ لیتر',
                'price' => 21500,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'Coca-Cola-big.jpg',
            ],
            [
                'name' => 'نوشابه خانواده فانتا',
                'description' => '۱.۵ لیتر',
                'price' => 21500,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'fanta-big.jpg',
            ],
            [
                'name' => 'نوشابه خانواده اسپرایت',
                'description' => '۱.۵ لیتر',
                'price' => 21500,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'sprite-big.jpg',
            ],
            [
                'name' => 'نوشابه شیشه ای کوکاکولا',
                'description' => '۲۵۰ میلی لیتر',
                'price' => 11500,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'Coca-cola-glass.jpg',
            ],
            [
                'name' => 'نوشابه شیشه ای فانتا پرتقالی',
                'description' => '۲۵۰ میلی لیتر',
                'price' => 11500,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'fanta-glass.jpg',
            ],
            [
                'name' => 'نوشابه شیشه ای اسپرایت',
                'description' => '۲۵۰ میلی لیتر',
                'price' => 10000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'sprite-glass.jpg',
            ],
            [
                'name' => 'ماءالشعیر خانواده هی دی لیمو',
                'description' => '۱ لیتر',
                'price' => 18000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'ماءالشعیر خانواده هی دی.jpg',
            ],
            [
                'name' => 'ماءالشعیر خانواده هی دی',
                'description' => '۱ لیتر',
                'price' => 18000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'ماءالشعیر خانواده هی دی-1.jpg',
            ],
            [
                'name' => 'نوشابه قوطی کوکاکولا',
                'description' => '۳۳۰ میلی لیتر',
                'price' => 13800,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'coca-cola-bottle.jpg',
            ],
            [
                'name' => 'نوشابه قوطی فانتا',
                'description' => '۳۳۰ میلی لیتر',
                'price' => 13800,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'fanta-bottle.jpg',
            ],
            [
                'name' => 'نوشابه قوطی اسپرایت',
                'description' => '۳۳۰ میلی لیتر',
                'price' => 13800,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'sprite-bottle.jpg',
            ],
            [
                'name' => 'دوغ خانواده عالیس ۸ گیاه',
                'description' => '۱.۵لیتر',
                'price' => 27000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'دوغ خانواده عالیس ۸ گیاه.jpg',
            ],
            [
                'name' => 'دوغ شیشه ای آبعلی',
                'description' => '۲۵۰ میلی لیتر',
                'price' => 10500,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'دوغ شیشه ای آبعلی.jpg',
            ],
            [
                'name' => 'دوغ خانواده آبعلی',
                'description' => '۱.۵ لیتر',
                'price' => 20000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'دوغ خانواده آبعلی.jpg',
            ],
            [
                'name' => 'ماءالشعیر قوطی هی دی لیمو',
                'description' => '۳۳۰ میلی لیتر',
                'price' => 14000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'ماءالشعیر قوطی هی دی لیمو.jpg',
            ],
            [
                'name' => 'ماءالشعیر قوطی هی دی استوایی',
                'description' => '۳۳۰ میلی لیتر',
                'price' => 14000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'ماءالشعیر قوطی هی دی استوایی.jpg',
            ],
            [
                'name' => 'آب معدنی کوچک',
                'description' => '۵۰۰ میلی لیتر',
                'price' => 5000,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => 'آب معدنی کوچک.jpg',
            ],
            [
                'name' => 'نوشایه لیموناد خانواده',
                'description' => 'برند زم زم',
                'price' => 16500,
                'category_id' => $created_categories['نوشیدنی'],
                'image' => '',
            ],
            // سرویس اضافه

            [
                'name' => 'پک قاشق و چنگال وی آی پی',
                'description' => 'پک کاور دار وی آی پی، بسیار محکم',
                'price' => 2000,
                'category_id' => $created_categories['سرویس اضافه'],
                'image' => '',
            ],
            [
                'name' => 'نان سنگک نصفه',
                'description' => 'نصف سنگک',
                'price' => 2000,
                'category_id' => $created_categories['سرویس اضافه'],
                'image' => '',
            ],
            [
                'name' => 'نان سنگک کامل',
                'description' => 'سنگک کامل',
                'price' => 4000,
                'category_id' => $created_categories['سرویس اضافه'],
                'image' => '',
            ],
            [
                'name' => 'ظرف ماکروویو بزرگ',
                'description' => 'کد ۲,۰۰۰ ظرف ماکروویو بزرگ',
                'price' => 10000,
                'category_id' => $created_categories['سرویس اضافه'],
                'image' => '',
            ],
            [
                'name' => 'قاشق پک ساده',
                'description' => '',
                'price' => 1000,
                'category_id' => $created_categories['سرویس اضافه'],
                'image' => '',
            ],
            [
                'name' => 'دیس طلقی کوچک',
                'description' => '',
                'price' => 5000,
                'category_id' => $created_categories['سرویس اضافه'],
                'image' => '',
            ],
            [
                'name' => 'دیس طلقی بزرگ',
                'description' => '',
                'price' => 8000,
                'category_id' => $created_categories['سرویس اضافه'],
                'image' => '',
            ],
            [
                'name' => 'لیوان یکبارمصرف',
                'description' => '',
                'price' => 150,
                'category_id' => $created_categories['سرویس اضافه'],
                'image' => '',
            ],
        ];

        foreach ($foods as $food)
            Product::create($food);
    }
}
