<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Primary SEO Meta Tags -->
        <title>ایلیا پورزنجانی | برنامه‌نویس فرانت‌اند & توسعه‌دهنده وب</title>
        <meta name="title" content="ایلیا پورزنجانی | برنامه‌نویس فرانت‌اند & توسعه‌دهنده وب">
        <meta name="description" content="پورتفولیو و رزومه حرفه‌ای ایلیا پورزنجانی، توسعه‌دهنده فرانت‌اند با تخصص در Vue.js، Tailwind CSS و جاوااسکریپت نوین. خلق رابط‌های کاربری مدرن، تعاملی و پرسرعت.">
        <meta name="keywords" content="ایلیا پورزنجانی, Iliya Pourzanjani, توسعه دهنده فرانت اند, Frontend Developer, Vue.js, Tailwind CSS, پورتفولیو, رزومه برنامه نویس">
        <meta name="author" content="Iliya Pourzanjani">
        <meta name="robots" content="index, follow">
        <meta name="theme-color" content="#080B11">

        <!-- Open Graph / Facebook / Telegram / WhatsApp -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://iliyapourzanjani.ir">
        <meta property="og:site_name" content="ایلیا پورزنجانی | رزومه و نمونه‌کارها">
        <meta property="og:title" content="ایلیا پورزنجانی | برنامه‌نویس فرانت‌اند">
        <meta property="og:description" content="خلق رابط‌های کاربری مدرن و واکنش‌گرا با تمرکز بر پرفورمنس، کد تمیز و طراحی ظریف.">
        <meta property="og:image" content="https://iliyapourzanjani.ir/images/iliya.jpg">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="https://iliyapourzanjani.ir">
        <meta name="twitter:title" content="ایلیا پورزنجانی | Frontend Developer">
        <meta name="twitter:description" content="پورتفولیو و پروژه‌های فرانت‌اند ایلیا پورزنجانی">
        <meta name="twitter:image" content="https://iliyapourzanjani.ir/images/iliya.jpg">

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='25' fill='%23080B11'/><text x='50%' y='68%' font-size='60' text-anchor='middle' fill='%23f97316' font-family='sans-serif' font-weight='900'>i</text></svg>">

        <!-- Scripts and Stylesheets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased min-h-screen bg-[#080B11] text-slate-100">
        <div id="app"></div>
    </body>
</html>
