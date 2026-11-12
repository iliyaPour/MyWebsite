<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'فروشگاه آنلاین مینیمال (Mini E-Commerce)',
                'category' => 'webapps',
                'category_label' => 'اپلیکیشن وب',
                'icon' => '🛍️',
                'mock_url' => 'https://iliya.dev/projects/mini-ecommerce',
                'gradient' => 'bg-gradient-to-br from-amber-600 via-orange-700 to-slate-900',
                'short_desc' => 'فروشگاه محصولات مدرن با سبد خرید تعاملی، فیلتر دسته‌بندی و محاسبه لحظه‌ای فاکتور.',
                'full_desc' => 'یک وب‌اپلیکیشن فروشگاهی کامل فرانت‌اند با طراحی واکنش‌گرا که به کاربر اجازه می‌دهد محصولات را جستجو کند، بر اساس دسته‌بندی فیلتر نماید، اقلام را به سبد خرید اضافه کرده و فاکتور نهایی را مشاهده کند.',
                'features' => [
                    'سیستم مدیریت سبد خرید آنی و بدون نیاز به رفرش',
                    'ذخیره خودکار وضعیت سبد در LocalStorage مرورگر',
                    'فیلتر و جستجوی لحظه‌ای محصولات بر اساس نام و قیمت',
                    'طراحی کاملاً واکنش‌گرا برای گوشی و دسکتاپ',
                ],
                'tags' => ['HTML5', 'CSS3', 'JavaScript', 'LocalStorage', 'Responsive'],
                'hosted_url' => 'https://example.com/iliya/mini-ecommerce',
                'github_url' => 'https://github.com/example/mini-ecommerce',
                'order' => 1,
            ],
            [
                'title' => 'سامانه وضعیت آب و هوا با API زنده',
                'category' => 'js',
                'category_label' => 'جاوااسکریپت & API',
                'icon' => '🌤️',
                'mock_url' => 'https://iliya.dev/projects/weather-app',
                'gradient' => 'bg-gradient-to-br from-orange-600 via-amber-700 to-slate-900',
                'short_desc' => 'دریافت آنلاین آب‌وهوای شهرهای جهان با ارتباط زنده OpenWeatherMap API.',
                'full_desc' => 'اپلیکیشن هواشناسی تعاملی با مصرف مستقیم APIهای RESTful. وضعیت آب و هوا، رطوبت، سرعت باد، پیش‌بینی روزهای آینده و تغییر داینامیک پس‌زمینه با توجه به شرایط جوی شهر انتخابی پیاده‌سازی شده است.',
                'features' => [
                    'ارسال درخواست‌های غیرهمزمان با Fetch / Async-Await',
                    'تغییر خودکار پس‌زمینه و آیکون‌ها بر اساس وضعیت ابری، بارانی یا آفتابی',
                    'نمایش سرعت باد، فشار هوا، دمای احساسی و رطوبت',
                    'مدیریت خطاهای شبکه و نام شهرهای نامعتبر',
                ],
                'tags' => ['JavaScript', 'REST API', 'Fetch', 'Tailwind', 'GeoLocation'],
                'hosted_url' => 'https://example.com/iliya/weather-app',
                'github_url' => 'https://github.com/example/weather-app',
                'order' => 2,
            ],
            [
                'title' => 'داشبورد مدیریت تسک‌ها (Task & Kanban)',
                'category' => 'webapps',
                'category_label' => 'اپلیکیشن وب',
                'icon' => '📋',
                'mock_url' => 'https://iliya.dev/projects/kanban-tasks',
                'gradient' => 'bg-gradient-to-br from-amber-700 via-yellow-800 to-slate-950',
                'short_desc' => 'تخته کانبان تعاملی برای سازماندهی وظایف روزانه با قابلیت Drag & Drop.',
                'full_desc' => 'سیستم برنامه‌ریزی و مدیریت وظایف با تخته‌های انجام شده، در حال انجام و در صف انتظار. کاربران می‌توانند کارت‌های کاری را با ماوس جابجا کنند، اولویت‌بندی کرده و زمان تحویل مشخص کنند.',
                'features' => [
                    'قابلیت Drag and Drop حرفه‌ای برای جابجایی وظایف بین ستون‌ها',
                    'ذخیره‌سازی پایدار در حافظه کلاینت',
                    'برچسب‌گذاری رنگی با برچسب فوریت و اهمیت',
                    'امکان ویرایش و حذف سریع کارت‌ها',
                ],
                'tags' => ['Vue.js', 'Drag & Drop API', 'CSS Grid', 'LocalStorage'],
                'hosted_url' => 'https://example.com/iliya/kanban-tasks',
                'github_url' => 'https://github.com/example/kanban-tasks',
                'order' => 3,
            ],
            [
                'title' => 'موزیک پلیر مدرن و گلس‌مورفیک',
                'category' => 'mini',
                'category_label' => 'مینی پروژه',
                'icon' => '🎵',
                'mock_url' => 'https://iliya.dev/projects/music-player',
                'gradient' => 'bg-gradient-to-br from-orange-500 via-amber-600 to-slate-900',
                'short_desc' => 'پخش‌کننده صوتی چشم‌نواز با اکولایزر انیمیشنی، پلی‌لیست و کنترل‌های پیشرفته صدا.',
                'full_desc' => 'یک پلیر موسیقی سفارشی که با استفاده از HTML5 Audio API و طراحی مدرن Glassmorphism ساخته شده است. پشتیبانی از لود کاور موزیک، نوار پیشرفت کشیدنی (Seekbar) و حالت تکرار/شانسی.',
                'features' => [
                    'مدیریت اختصاصی صوتی با HTML5 Audio',
                    'طراحی مدرن شیشه‌ای (Glassmorphism) و واکنش‌گرا',
                    'پلی‌لیست پویا و تغییر خودکار آهنگ پس از پایان',
                    'نوار اسکراب زمانی و کنترل ولوم روان',
                ],
                'tags' => ['HTML5 Audio', 'JavaScript', 'CSS Animation', 'Glassmorphism'],
                'hosted_url' => 'https://example.com/iliya/music-player',
                'github_url' => 'https://github.com/example/music-player',
                'order' => 4,
            ],
            [
                'title' => 'ماشین حساب مهندسی و هوشمند',
                'category' => 'mini',
                'category_label' => 'مینی پروژه',
                'icon' => '🔢',
                'mock_url' => 'https://iliya.dev/projects/smart-calculator',
                'gradient' => 'bg-gradient-to-br from-amber-600 via-orange-800 to-slate-950',
                'short_desc' => 'ماشین حساب تعاملی با پشتیبانی از کلیدهای کیبورد و تاریخچه محاسبات.',
                'full_desc' => 'ماشین حساب سریع و دقیق با توانایی پردازش عبارات پیچیده ریاضی، پاک‌کردن گام به گام، تاریخچه محاسبات قبلی و قابلیت تایپ مستقیم از کیبورد کاربر.',
                'features' => [
                    'پردازش عبارات جبری با رعایت اولویت عملگرها',
                    'پشتیبانی کامل از کلیدهای صفحه کلید (Keyboard Events)',
                    'تب پنجره سوابق محاسبات اخیر',
                    'انیمیشن‌های لمسی و کلیک نرم',
                ],
                'tags' => ['JavaScript', 'DOM Events', 'Tailwind', 'CSS Grid'],
                'hosted_url' => 'https://example.com/iliya/smart-calculator',
                'github_url' => 'https://github.com/example/smart-calculator',
                'order' => 5,
            ],
            [
                'title' => 'بازی تقویت حافظه تعاملی (Memory Game)',
                'category' => 'js',
                'category_label' => 'بازی وب',
                'icon' => '🧠',
                'mock_url' => 'https://iliya.dev/projects/memory-game',
                'gradient' => 'bg-gradient-to-br from-orange-600 via-amber-800 to-slate-950',
                'short_desc' => 'بازی چرخش کارت‌های ۳بعدی، ثبت رکورد زمانی و تعداد حرکات.',
                'full_desc' => 'بازی پیدا کردن جفت کارت‌های یکسان با انیمیشن‌های سه‌بعدی CSS 3D Flip Cards. این بازی شامل تایمر زمان، شمارنده حرکات، سیستم ثبت بهترین امتیاز و جلوه‌های صوتی است.',
                'features' => [
                    'انیمیشن‌های ۳ بعدی چرخش کارت‌ها در CSS',
                    'الگوریتم بر زدن تصادفی کارت‌ها (Fisher-Yates Shuffle)',
                    'شمارش هوشمند زمان و تعداد حرکات',
                    'پاپ‌آپ پایان بازی و پیام پیروزی',
                ],
                'tags' => ['Vanilla JS', 'CSS 3D Transforms', 'Algorithms', 'Interactive'],
                'hosted_url' => 'https://example.com/iliya/memory-game',
                'github_url' => 'https://github.com/example/memory-game',
                'order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project
            );
        }
    }
}
