export const projectsData = [
  {
    slug: 'ecommerce-platform',
    icon: '🛍️',
    category: 'fullstack',
    title: {
      fa: 'پلتفرم فروشگاهی مقیاس‌پذیر سازمانی',
      en: 'Enterprise E-Commerce Platform',
    },
    subtitle: {
      fa: 'سیستم جامع خرید و فروش آنلاین با قابلیت مدیریت موجودی لحظه‌ای و درگاه پرداخت امن',
      en: 'High-throughput online storefront with real-time stock sync and automated settlement',
    },
    badge: {
      fa: 'فول‌استک • Laravel 13 + Vue 3',
      en: 'Fullstack • Laravel 13 + Vue 3',
    },
    demoUrl: '#demo',
    githubUrl: 'https://github.com/example/ecommerce-platform',
    stats: [
      { label: { fa: 'کاربران فعال ماهانه', en: 'Monthly Active Users' }, value: '+500K' },
      { label: { fa: 'تراکنش‌های روزانه', en: 'Daily Transactions' }, value: '+25K' },
      { label: { fa: 'میانگین سرعت لود', en: 'Avg. Response Time' }, value: '95ms' },
      { label: { fa: 'آپ‌تایم سیستم', en: 'System Uptime' }, value: '99.98%' },
    ],
    overview: {
      fa: 'این پروژه یک سامانه فروشگاهی پیشرفته و مدرن است که با تکیه بر معماری میکروسرویس و الگوی مخزن (Repository Pattern) طراحی شده است. هدف اصلی این سیستم، پاسخگویی به تقاضای بالای کاربران در جشنواره‌های فروش بدون هیچ‌گونه افت عملکرد بود.',
      en: 'A high-performance ecommerce platform built with microservices and repository pattern principles. Designed from the ground up to sustain extreme traffic spikes during seasonal flash sales without performance degradation.',
    },
    features: [
      {
        icon: '⚡',
        title: { fa: 'سبد خرید آنی و واکنشی', en: 'Instant Reactive Cart' },
        description: { fa: 'مدیریت وضعیت سبد خرید با Pinia و ذخیره‌سازی ابری بدون نیاز به رفرش صفحه.', en: 'Stateful client-side cart powered by Pinia and background sync without page refreshes.' },
      },
      {
        icon: '🛡️',
        title: { fa: 'درگاه‌های پرداخت بانکی امن', en: 'Secure Multi-Gateway Checkout' },
        description: { fa: 'اتصال هوشمند به چند درگاه بانکی با قابلیت سوییچ خودکار در زمان اختلال شبکه.', en: 'Failover multi-gateway routing with webhook verification and zero duplicate billing.' },
      },
      {
        icon: '📦',
        title: { fa: 'انبارداری و مدیریت موجودی زنده', en: 'Real-Time Inventory Engine' },
        description: { fa: 'رزرو لحظه‌ای کالا با قفل‌های بدبینانه (Pessimistic Locking) در دیتابیس برای جلوگیری از اورسلینگ.', en: 'Atomic pessimistic database locks to completely eliminate overselling during high-concurrency bursts.' },
      },
      {
        icon: '📊',
        title: { fa: 'پنل تحلیل فروش ادمین', en: 'Executive Analytics Panel' },
        description: { fa: 'نمودارهای تعاملی فروش، گزارش مالی تفکیکی و خروجی اکسل با فرمت دلخواه.', en: 'Deep financial breakdown charts, customer cohort tracking, and automated PDF/Excel invoicing.' },
      },
    ],
    techStack: [
      { name: 'Laravel 13', role: 'Core Backend Framework' },
      { name: 'Vue 3', role: 'Reactive Frontend UI' },
      { name: 'Tailwind CSS', role: 'Styling & Design System' },
      { name: 'MySQL 8', role: 'Primary Relational Database' },
      { name: 'Redis', role: 'High-speed Caching & Queue' },
      { name: 'Docker', role: 'Containerized Deployment' },
    ],
    challenges: {
      fa: 'چالش اصلی این پروژه مواجهه با افت سرعت هنگام تخفیف‌های ویژه با ۲۰ هزار کاربر همزمان روی پایگاه داده بود. با پیاده‌سازی لایه کش Redis برای کاتالوگ محصولات و تبدیل کوئری‌های سنگین به صف‌های پس‌زمینه در لاراول، فشار روی دیتابیس ۷۵٪ کاهش یافت.',
      en: 'The primary challenge was managing sudden database bottlenecks during promotional flash sales with 20k concurrent users. We solved this by implementing multi-tiered Redis catalog caching and offloading heavy queries to Laravel queue workers, decreasing DB load by 75%.',
    },
  },
  {
    slug: 'analytics-dashboard',
    icon: '📊',
    category: 'frontend',
    title: {
      fa: 'داشبورد هوشمند آنالیتیکس و مانیتورینگ',
      en: 'Interactive Telemetry & Analytics Dashboard',
    },
    subtitle: {
      fa: 'پلتفرم تجسم داده‌های سازمانی با نمودارهای لحظه‌ای، فیلترهای پیشرفته و حالت شب و روز',
      en: 'Enterprise telemetry visualization suite featuring live WebSocket charts, dynamic metrics, and dark mode',
    },
    badge: {
      fa: 'فرانت‌اند تخصصی • Vue 3 + Vite',
      en: 'Frontend Specialization • Vue 3 + Vite',
    },
    demoUrl: '#demo',
    githubUrl: 'https://github.com/example/analytics-dashboard',
    stats: [
      { label: { fa: 'نقاط داده در ثانیه', en: 'Data Points/sec' }, value: '50,000' },
      { label: { fa: 'نرخ فریم رندر', en: 'Rendering FPS' }, value: '60 FPS' },
      { label: { fa: 'کاهش حجم باندل', en: 'Bundle Optimization' }, value: '-65%' },
      { label: { fa: 'ابزارهای ویجت', en: 'Customizable Widgets' }, value: '+30' },
    ],
    overview: {
      fa: 'داشبورد مانیتورینگ داده‌ها برای نمایش بلادرنگ وضعیت سرورها، تحلیل رفتار کاربران و جریان‌های مالی طراحی شده است. این رابط کاربری با کامپوننت‌های بهینه‌سازی شده در Vue 3 توانایی رندر هزاران نقطه داده در کسری از ثانیه را بدون لگ فراهم می‌سازد.',
      en: 'A high-cadence analytics portal designed to visualize server metrics, user acquisition funnels, and streaming financial flows. Built with optimized Vue 3 components to guarantee 60fps rendering even with continuous high-volume data streams.',
    },
    features: [
      {
        icon: '📈',
        title: { fa: 'نمودارهای تعاملی زنده', en: 'Live Interactive Charts' },
        description: { fa: 'ترسیم برداری نمودارهای خطی، شمعی و میله‌ای با انیمیشن‌های روان.', en: 'Canvas & SVG rendered charts supporting zoom, pan, hover tooltips, and time-series sliding.' },
      },
      {
        icon: '🌗',
        title: { fa: 'تم دوگانه با کنتراست استاندارد', en: 'Adaptive Contrast Theme' },
        description: { fa: 'پشتیبانی از تم دارک و لایت همراه با تشخیص خودکار تنظیمات سیستم عامل کاربر.', en: 'Seamless Dark/Light mode toggle with persistence and system preference synchronization.' },
      },
      {
        icon: '🎛️',
        title: { fa: 'ویجت‌های قابل شخصی‌سازی (Drag & Drop)', en: 'Configurable Drag-and-Drop' },
        description: { fa: 'امکان جابجایی کارت‌های گزارش، تغییر اندازه و ذخیره چیدمان اختصاصی هر کاربر.', en: 'Grid re-ordering and widget persistence tailored to each user profile.' },
      },
      {
        icon: '📑',
        title: { fa: 'خروجی گزارشات چند فرمتی', en: 'Multi-Format Export' },
        description: { fa: 'خروجی لحظه‌ای داده‌ها با فرمت‌های CSV، JSON و گزارش زیبای PDF با استایل چاپ اختصاصی.', en: 'One-click client-side data export to CSV, JSON, and pre-formatted print-ready PDFs.' },
      },
    ],
    techStack: [
      { name: 'Vue 3', role: 'Composition API & Reactivity' },
      { name: 'Vite', role: 'Next-Gen Frontend Tooling' },
      { name: 'Chart.js / Canvas', role: 'High-performance Data Visualization' },
      { name: 'Tailwind CSS', role: 'Modern UI & Responsive Utility' },
      { name: 'WebSockets', role: 'Bidirectional Live Telemetry Stream' },
    ],
    challenges: {
      fa: 'رندر حجم زیادی از نقاط آماری با نمودارهای استاندارد باعث افت شدید فریم در مرورگر می‌شد. با پیاده‌سازی تکنیک Virtual Scrolling و استفاده از Web Workers جهت پردازش داده‌ها در پس‌زمینه، عملکرد به ۶۰ فریم بر ثانیه پایدار رسید.',
      en: 'Rendering massive time-series arrays caused browser frame drops. We resolved this through data downsampling in Web Workers and canvas-accelerated render passes, maintaining buttery smooth 60fps.',
    },
  },
  {
    slug: 'task-orchestrator',
    icon: '⚡',
    category: 'laravel',
    title: {
      fa: 'سرویس مدیریت هوشمند وظایف تیم‌های ریموت',
      en: 'Cloud Team Task Orchestrator',
    },
    subtitle: {
      fa: 'سیستم برنامه‌ریزی پروژه‌ها، اسپرینت‌های کاری، اطلاع‌رسانی لحظه‌ای و وب‌هوک‌های امن',
      en: 'Distributed project planning system with real-time sprint boards, notifications, and webhooks',
    },
    badge: {
      fa: 'بک‌اند پیشرفته • Laravel API & WebSockets',
      en: 'Advanced Backend • Laravel API & WebSockets',
    },
    demoUrl: '#demo',
    githubUrl: 'https://github.com/example/task-orchestrator',
    stats: [
      { label: { fa: 'پروژه‌های مدیریت شده', en: 'Active Workspaces' }, value: '+1,200' },
      { label: { fa: 'پیام‌های وب‌سوکت / روز', en: 'Socket Events/day' }, value: '2.4M' },
      { label: { fa: 'تست‌های خودکار موفق', en: 'Automated Tests' }, value: '184 Unit/Feature' },
      { label: { fa: 'امتیاز تست و کیفیت', en: 'Test Coverage' }, value: '94%' },
    ],
    overview: {
      fa: 'این پلتفرم برای تیم‌های توسعه نرم‌افزار طراحی شده تا برنامه‌ریزی اسپرینت‌ها، تخصیص تسک‌ها و پیگیری باگ‌ها را در بستری چابک و بلادرنگ انجام دهند. معماری سرویس‌گرا و وب‌سوکت‌های اختصاصی تجربه کاری بی‌درنگی را برای اعضای تیم به ارمغان می‌آورد.',
      en: 'A collaborative workspace application empowering distributed engineering teams to coordinate sprints, trace issue lifecycles, and automate notifications with low-latency WebSockets.',
    },
    features: [
      {
        icon: '📋',
        title: { fa: 'تخته کانبان بلادرنگ (Kanban Board)', en: 'Real-time Kanban Board' },
        description: { fa: 'جابجایی کارت‌ها و ستون‌ها با به‌روزرسانی آنی برای همه همکاران متصل به پروژه.', en: 'Collaborative task cards moving dynamically across columns with live peer indicators.' },
      },
      {
        icon: '🔔',
        title: { fa: 'سامانه اعلان‌های چندکاناله', en: 'Multi-Channel Alert System' },
        description: { fa: 'ارسال خودکار نوتیفیکیشن در تلگرام، ایمیل و پیام‌های درون‌برنامه‌ای هنگام تغییر وضعیت تسک.', en: 'Intelligent notification dispatcher routing events to email, webhooks, and telegram bots.' },
      },
      {
        icon: '🔐',
        title: { fa: 'سطوح دسترسی دقیق (RBAC)', en: 'Granular RBAC Permissions' },
        description: { fa: 'تعریف نقش‌های کاربری (مدیر، توسعه‌دهنده، تست‌کننده) با Laravel Policies & Gates.', en: 'Fine-grained policy-driven authorization controlling actions across projects and teams.' },
      },
      {
        icon: '🤖',
        title: { fa: 'اتصال به گیت‌هاب و وب‌هوک‌ها', en: 'GitHub & CI/CD Integrations' },
        description: { fa: 'بستن یا انتقال خودکار تسک‌ها به محض مرج شدن Pull Request یا کامیت کد.', en: 'Automated status transitions triggered via secure HMAC-verified GitHub webhooks.' },
      },
    ],
    techStack: [
      { name: 'Laravel 13 API', role: 'Restful Backend Architecture' },
      { name: 'Laravel Reverb / WebSockets', role: 'Live Realtime Broadcasting' },
      { name: 'PostgreSQL', role: 'Structured Data Storage' },
      { name: 'Redis', role: 'Queue Worker & Cache' },
      { name: 'PHPUnit', role: 'Test Driven Development (TDD)' },
    ],
    challenges: {
      fa: 'چالش بزرگ، جلوگیری از تداخل ویرایش همزمان یک تسک توسط دو کاربر و بهینه‌سازی رخدادهای وب‌سوکت بود. این موضوع با قفل‌های آپتیمیستیک (Optimistic Locking) و تفکیک کانال‌های خصوصی در Laravel Reverb حل شد.',
      en: 'Preventing concurrent overwrite conflicts when teammates edit tasks at the same time. Resolved with optimistic version concurrency checks and scoped private channels in Laravel WebSockets.',
    },
  },
];
