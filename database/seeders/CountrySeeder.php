<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $sa = Country::create([
            'name' => ['en' => 'Saudi Arabia', 'ar' => 'المملكة العربية السعودية'],
            'code' => 'SA',
        ]);

        $regions = [
            [
                'name' => ['en' => 'Riyadh', 'ar' => 'الرياض'],
                'cities' => [
                    ['en' => 'Riyadh', 'ar' => 'الرياض'],
                    ['en' => 'Al Kharj', 'ar' => 'الخرج'],
                    ['en' => 'Al Diriyah', 'ar' => 'الدرعية'],
                    ['en' => 'Al Majmaah', 'ar' => 'المجمعة'],
                    ['en' => 'Al Dawadmi', 'ar' => 'الدوادمي'],
                    ['en' => 'Al Zulfi', 'ar' => 'الزلفي'],
                    ['en' => 'Wadi Al Dawasir', 'ar' => 'وادي الدواسر'],
                    ['en' => 'Al Aflaj', 'ar' => 'الأفلاج'],
                    ['en' => 'Hotat Bani Tamim', 'ar' => 'حوطة بني تميم'],
                    ['en' => 'Shaqra', 'ar' => 'شقراء'],
                    ['en' => 'Al Quway\'iyah', 'ar' => 'القويعية'],
                    ['en' => 'Afif', 'ar' => 'عفيف'],
                    ['en' => 'Al Muzahmiyya', 'ar' => 'المزاحمية'],
                    ['en' => 'Rumah', 'ar' => 'رماح'],
                    ['en' => 'Thadiq', 'ar' => 'ثادق'],
                    ['en' => 'Huraymila', 'ar' => 'حريملاء'],
                    ['en' => 'Al Ghat', 'ar' => 'الغاط'],
                ],
            ],
            [
                'name' => ['en' => 'Makkah', 'ar' => 'مكة المكرمة'],
                'cities' => [
                    ['en' => 'Makkah', 'ar' => 'مكة المكرمة'],
                    ['en' => 'Jeddah', 'ar' => 'جدة'],
                    ['en' => 'Taif', 'ar' => 'الطائف'],
                    ['en' => 'Rabigh', 'ar' => 'رابغ'],
                    ['en' => 'Al Qunfudhah', 'ar' => 'القنفذة'],
                    ['en' => 'Al Lith', 'ar' => 'الليث'],
                    ['en' => 'Khulais', 'ar' => 'خليص'],
                    ['en' => 'Al Jumum', 'ar' => 'الجموم'],
                    ['en' => 'Al Kamil', 'ar' => 'الكامل'],
                    ['en' => 'Turubah', 'ar' => 'تربة'],
                    ['en' => 'Misan', 'ar' => 'ميسان'],
                ],
            ],
            [
                'name' => ['en' => 'Madinah', 'ar' => 'المدينة المنورة'],
                'cities' => [
                    ['en' => 'Madinah', 'ar' => 'المدينة المنورة'],
                    ['en' => 'Yanbu', 'ar' => 'ينبع'],
                    ['en' => 'Al Ula', 'ar' => 'العلا'],
                    ['en' => 'Badr', 'ar' => 'بدر'],
                    ['en' => 'Khaybar', 'ar' => 'خيبر'],
                    ['en' => 'Al Mahd', 'ar' => 'المهد'],
                    ['en' => 'Al Hanakiyah', 'ar' => 'الحناكية'],
                ],
            ],
            [
                'name' => ['en' => 'Eastern Province', 'ar' => 'المنطقة الشرقية'],
                'cities' => [
                    ['en' => 'Dammam', 'ar' => 'الدمام'],
                    ['en' => 'Al Khobar', 'ar' => 'الخبر'],
                    ['en' => 'Dhahran', 'ar' => 'الظهران'],
                    ['en' => 'Al Ahsa', 'ar' => 'الأحساء'],
                    ['en' => 'Hafar Al Batin', 'ar' => 'حفر الباطن'],
                    ['en' => 'Al Jubail', 'ar' => 'الجبيل'],
                    ['en' => 'Al Qatif', 'ar' => 'القطيف'],
                    ['en' => 'Ras Tanura', 'ar' => 'رأس تنورة'],
                    ['en' => 'Abqaiq', 'ar' => 'بقيق'],
                    ['en' => 'Al Nairyah', 'ar' => 'النعيرية'],
                    ['en' => 'Al Khafji', 'ar' => 'الخفجي'],
                    ['en' => 'Qaryat Al Ulya', 'ar' => 'قرية العليا'],
                ],
            ],
            [
                'name' => ['en' => 'Asir', 'ar' => 'عسير'],
                'cities' => [
                    ['en' => 'Abha', 'ar' => 'أبها'],
                    ['en' => 'Khamis Mushait', 'ar' => 'خميس مشيط'],
                    ['en' => 'Bisha', 'ar' => 'بيشة'],
                    ['en' => 'Al Namas', 'ar' => 'النماص'],
                    ['en' => 'Muhayil', 'ar' => 'محايل'],
                    ['en' => 'Sarat Abidah', 'ar' => 'سراة عبيدة'],
                    ['en' => 'Rijal Almaa', 'ar' => 'رجال ألمع'],
                    ['en' => 'Tathlith', 'ar' => 'تثليث'],
                    ['en' => 'Ahad Rafidah', 'ar' => 'أحد رفيدة'],
                    ['en' => 'Balqarn', 'ar' => 'بلقرن'],
                ],
            ],
            [
                'name' => ['en' => 'Tabuk', 'ar' => 'تبوك'],
                'cities' => [
                    ['en' => 'Tabuk', 'ar' => 'تبوك'],
                    ['en' => 'Al Wajh', 'ar' => 'الوجه'],
                    ['en' => 'Duba', 'ar' => 'ضباء'],
                    ['en' => 'Tayma', 'ar' => 'تيماء'],
                    ['en' => 'Umluj', 'ar' => 'أملج'],
                    ['en' => 'Haql', 'ar' => 'حقل'],
                ],
            ],
            [
                'name' => ['en' => 'Hail', 'ar' => 'حائل'],
                'cities' => [
                    ['en' => 'Hail', 'ar' => 'حائل'],
                    ['en' => 'Baqaa', 'ar' => 'بقعاء'],
                    ['en' => 'Al Ghazalah', 'ar' => 'الغزالة'],
                    ['en' => 'Al Shinan', 'ar' => 'الشنان'],
                ],
            ],
            [
                'name' => ['en' => 'Northern Borders', 'ar' => 'الحدود الشمالية'],
                'cities' => [
                    ['en' => 'Arar', 'ar' => 'عرعر'],
                    ['en' => 'Rafha', 'ar' => 'رفحاء'],
                    ['en' => 'Turaif', 'ar' => 'طريف'],
                ],
            ],
            [
                'name' => ['en' => 'Jazan', 'ar' => 'جازان'],
                'cities' => [
                    ['en' => 'Jazan', 'ar' => 'جازان'],
                    ['en' => 'Sabya', 'ar' => 'صبيا'],
                    ['en' => 'Abu Arish', 'ar' => 'أبو عريش'],
                    ['en' => 'Samtah', 'ar' => 'صامطة'],
                    ['en' => 'Al Darb', 'ar' => 'الدرب'],
                    ['en' => 'Farasan', 'ar' => 'فرسان'],
                    ['en' => 'Al Aydabi', 'ar' => 'العيدابي'],
                    ['en' => 'Baysh', 'ar' => 'بيش'],
                ],
            ],
            [
                'name' => ['en' => 'Najran', 'ar' => 'نجران'],
                'cities' => [
                    ['en' => 'Najran', 'ar' => 'نجران'],
                    ['en' => 'Sharurah', 'ar' => 'شرورة'],
                    ['en' => 'Habuna', 'ar' => 'حبونا'],
                    ['en' => 'Badr Al Janub', 'ar' => 'بدر الجنوب'],
                ],
            ],
            [
                'name' => ['en' => 'Al Baha', 'ar' => 'الباحة'],
                'cities' => [
                    ['en' => 'Al Baha', 'ar' => 'الباحة'],
                    ['en' => 'Baljurashi', 'ar' => 'بلجرشي'],
                    ['en' => 'Al Mandaq', 'ar' => 'المندق'],
                    ['en' => 'Al Makhwah', 'ar' => 'المخواة'],
                    ['en' => 'Al Aqiq', 'ar' => 'العقيق'],
                    ['en' => 'Qilwah', 'ar' => 'قلوة'],
                ],
            ],
            [
                'name' => ['en' => 'Al Jouf', 'ar' => 'الجوف'],
                'cities' => [
                    ['en' => 'Sakakah', 'ar' => 'سكاكا'],
                    ['en' => 'Dumat Al Jandal', 'ar' => 'دومة الجندل'],
                    ['en' => 'Al Qurayyat', 'ar' => 'القريات'],
                ],
            ],
            [
                'name' => ['en' => 'Qassim', 'ar' => 'القصيم'],
                'cities' => [
                    ['en' => 'Buraydah', 'ar' => 'بريدة'],
                    ['en' => 'Unaizah', 'ar' => 'عنيزة'],
                    ['en' => 'Al Rass', 'ar' => 'الرس'],
                    ['en' => 'Al Mithnab', 'ar' => 'المذنب'],
                    ['en' => 'Al Bukayriyah', 'ar' => 'البكيرية'],
                    ['en' => 'Al Badai', 'ar' => 'البدائع'],
                    ['en' => 'Riyadh Al Khabra', 'ar' => 'رياض الخبراء'],
                    ['en' => 'Uyun Al Jiwa', 'ar' => 'عيون الجواء'],
                ],
            ],
        ];

        foreach ($regions as $regionData) {
            $region = Region::create([
                'name' => $regionData['name'],
                'country_id' => $sa->id,
            ]);

            foreach ($regionData['cities'] as $cityName) {
                City::create([
                    'name' => $cityName,
                    'region_id' => $region->id,
                ]);
            }
        }
    }
}
