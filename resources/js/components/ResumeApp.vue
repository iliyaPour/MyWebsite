<template>
  <div :class="[isDark ? 'dark bg-slate-950 text-slate-100' : 'bg-slate-50 text-slate-800', 'min-h-screen transition-colors duration-300 font-sans selection:bg-indigo-500 selection:text-white']" :dir="locale === 'fa' ? 'rtl' : 'ltr'">
    
    <!-- HEADER / NAVBAR -->
    <header class="no-print sticky top-0 z-50 backdrop-blur-xl bg-white/80 dark:bg-slate-900/80 border-b border-slate-200/80 dark:border-slate-800/80 transition-all">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        
        <!-- Social Icons (Left in RTL, Right in LTR) -->
        <div class="flex items-center gap-3">
          <a href="https://github.com" target="_blank" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-600 text-slate-600 dark:text-slate-300 flex items-center justify-center transition shadow-sm text-sm" title="GitHub">
            <span>🐙</span>
          </a>
          <a href="https://linkedin.com" target="_blank" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-600 text-slate-600 dark:text-slate-300 flex items-center justify-center transition shadow-sm text-sm" title="LinkedIn">
            <span>💼</span>
          </a>
          <a href="https://t.me" target="_blank" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-600 text-slate-600 dark:text-slate-300 flex items-center justify-center transition shadow-sm text-sm" title="Telegram">
            <span>✈️</span>
          </a>

          <!-- Dark/Light Mode Switcher -->
          <button 
            @click="toggleTheme" 
            class="w-9 h-9 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center transition"
            :title="isDark ? 'حالت روشن' : 'حالت تاریک'"
          >
            <span v-if="isDark">☀️</span>
            <span v-else>🌙</span>
          </button>
        </div>

        <!-- Desktop Navigation Menu -->
        <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600 dark:text-slate-300">
          <a 
            v-for="item in navLinks" 
            :key="item.href"
            :href="item.href" 
            :class="[
              activeSection === item.href.replace('#', '') 
                ? 'text-indigo-600 dark:text-indigo-400 font-bold' 
                : 'hover:text-indigo-600 dark:hover:text-indigo-400',
              'transition relative py-1'
            ]"
          >
            {{ item.name[locale] }}
            <span 
              v-if="activeSection === item.href.replace('#', '')" 
              class="absolute bottom-0 left-0 right-0 h-0.5 bg-indigo-600 dark:bg-indigo-400 rounded-full"
            ></span>
          </a>
        </nav>

        <!-- Brand / Logo (iliya) -->
        <div class="flex items-center gap-3">
          <a href="#home" class="group flex items-center gap-2">
            <span class="text-3xl font-black tracking-tighter bg-gradient-to-r from-indigo-600 via-violet-600 to-indigo-500 bg-clip-text text-transparent group-hover:opacity-90 transition">
              iliya
            </span>
            <span class="w-2 h-2 rounded-full bg-indigo-600 animate-ping"></span>
          </a>

          <!-- Mobile Menu Button -->
          <button 
            @click="isMobileMenuOpen = !isMobileMenuOpen" 
            class="md:hidden p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-lg"
          >
            <span v-if="isMobileMenuOpen">✕</span>
            <span v-else>☰</span>
          </button>
        </div>

      </div>

      <!-- Mobile Dropdown Menu -->
      <div v-if="isMobileMenuOpen" class="md:hidden border-t border-slate-200 dark:border-slate-800 bg-white/95 dark:bg-slate-900/95 backdrop-blur-lg px-6 py-4 space-y-3">
        <a 
          v-for="item in navLinks" 
          :key="item.href"
          :href="item.href" 
          @click="isMobileMenuOpen = false"
          class="block py-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-indigo-600 transition"
        >
          {{ item.name[locale] }}
        </a>
      </div>
    </header>

    <!-- SECTION 1: HERO (خانه) -->
    <section id="home" class="relative min-h-[85vh] flex items-center justify-center overflow-hidden py-16">
      
      <!-- Modern Ambient Background Glows -->
      <div class="absolute top-1/4 -right-20 w-96 h-96 bg-indigo-600/15 dark:bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
      <div class="absolute bottom-1/4 -left-20 w-96 h-96 bg-violet-600/15 dark:bg-violet-600/20 rounded-full blur-3xl pointer-events-none"></div>
      
      <!-- Subtle Grid Texture -->
      <div class="absolute inset-0 bg-[linear-gradient(to_right,#8882_1px,transparent_1px),linear-gradient(to_bottom,#8882_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-30 dark:opacity-20 pointer-events-none"></div>

      <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 text-center">
        
        <!-- Status Pill -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200 dark:border-indigo-800 text-indigo-700 dark:text-indigo-300 text-xs sm:text-sm font-semibold mb-8 shadow-sm">
          <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
          <span>آماده همکاری در پروژه‌های جدید و استخدام</span>
        </div>

        <!-- Greeting -->
        <p class="text-lg sm:text-2xl font-medium text-slate-600 dark:text-slate-300 mb-3 tracking-wide">
          سلام، من <span class="font-bold text-slate-900 dark:text-white">ایلیا</span> هستم
        </p>

        <!-- Big Bold Title matching user's original site -->
        <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black tracking-tight mb-6 leading-tight">
          <span class="bg-gradient-to-r from-indigo-600 via-violet-600 to-indigo-400 bg-clip-text text-transparent">
            فرانت اند
          </span>
        </h1>

        <p class="text-base sm:text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed font-normal">
          خلق رابط‌های کاربری جذاب، واکنش‌گرا و سریع با تمرکز بر تجربه کاربری بی‌نقص، استانداردهای روز وب و معماری تمیز کامپوننت‌ها.
        </p>

        <!-- CTA Buttons matching user's site -->
        <div class="flex flex-wrap items-center justify-center gap-4">
          <a 
            href="#projects" 
            class="px-8 py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm sm:text-base shadow-xl shadow-indigo-600/25 hover:shadow-indigo-600/40 hover:-translate-y-0.5 transition flex items-center gap-2"
          >
            <span>مشاهده کارهای من</span>
            <span>↓</span>
          </a>

          <a 
            href="#about" 
            class="px-8 py-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-800 dark:text-slate-200 font-bold text-sm sm:text-base shadow-sm transition"
          >
            درباره من بیشتر بدانید
          </a>
        </div>

        <!-- Floating Quick Stats -->
        <div class="grid grid-cols-3 max-w-lg mx-auto mt-16 pt-8 border-t border-slate-200 dark:border-slate-800/80 gap-4">
          <div>
            <span class="block text-2xl sm:text-3xl font-extrabold text-indigo-600 dark:text-indigo-400">+۱۲</span>
            <span class="text-xs text-slate-500 dark:text-slate-400 mt-1 block">پروژه و تمرین</span>
          </div>
          <div>
            <span class="block text-2xl sm:text-3xl font-extrabold text-violet-600 dark:text-violet-400">۱۰۰٪</span>
            <span class="text-xs text-slate-500 dark:text-slate-400 mt-1 block">ریسپانسیو</span>
          </div>
          <div>
            <span class="block text-2xl sm:text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">سریع</span>
            <span class="text-xs text-slate-500 dark:text-slate-400 mt-1 block">یادگیری چابک</span>
          </div>
        </div>

      </div>
    </section>

    <!-- SECTION 2: ABOUT ME (درباره من - مرا بیشتر بشناس) -->
    <section id="about" class="py-20 bg-slate-100/70 dark:bg-slate-900/50 border-y border-slate-200/60 dark:border-slate-800/60 transition-colors">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <!-- Section Header matching Image 2 -->
        <div class="text-center mb-16">
          <span class="inline-block px-3 py-1 rounded-lg bg-indigo-100 dark:bg-indigo-950/80 text-indigo-700 dark:text-indigo-400 text-xs font-bold uppercase tracking-wider mb-3">
            درباره من
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">
            مرا بیشتر بشناس
          </h2>
        </div>

        <!-- Main Card -->
        <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 sm:p-12 shadow-sm">
          <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-14">
            
            <!-- User Portrait with User's real photo from image 2 -->
            <div class="relative shrink-0 group">
              <div class="w-64 h-64 sm:w-72 sm:h-72 rounded-3xl overflow-hidden ring-4 ring-indigo-500/20 shadow-2xl bg-gradient-to-tr from-indigo-500 to-violet-500 p-1">
                <img 
                  src="/images/iliya.jpg" 
                  alt="ایلیا پورزنجانی" 
                  class="w-full h-full object-cover rounded-[22px] group-hover:scale-105 transition duration-500"
                />
              </div>

              <!-- Decorative Badge -->
              <div class="absolute -bottom-4 -right-4 px-4 py-2 rounded-2xl bg-indigo-600 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                <span>💻</span>
                <span>توسعه‌دهنده فرانت‌اند</span>
              </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 space-y-6 text-center lg:text-start">
              <div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mb-2">
                  سلام من <span class="text-indigo-600 dark:text-indigo-400">ایلیا پورزنجانی</span> هستم
                </h3>
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                  Front-End Web Developer • ساکن گرگان
                </p>
              </div>

              <!-- Bio matching User's exact text from image 2 -->
              <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm sm:text-base">
                توسعه‌دهنده فرانت‌اند با تجربه در اجرای پروژه‌های تمرینی و شخصی در زمینه طراحی رابط کاربری واکنش‌گرا (Responsive). علاقه‌مند به توسعه نرم‌افزارهای کاربردی تحت وب، دارای روحیه یادگیری سریع، توانایی حل مسئله و همکاری تیمی، آماده برای ورود به دنیای حرفه‌ای و رشد مستمر در حوزه برنامه‌نویسی وب.
              </p>

              <!-- Personal Meta Fields matching image 2 -->
              <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-6 border-t border-slate-100 dark:border-slate-800 text-xs sm:text-sm">
                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                  <span class="text-slate-400 dark:text-slate-500 block mb-1">اسم:</span>
                  <strong class="text-slate-800 dark:text-slate-100 font-bold">ایلیا</strong>
                </div>

                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                  <span class="text-slate-400 dark:text-slate-500 block mb-1">فامیلی:</span>
                  <strong class="text-slate-800 dark:text-slate-100 font-bold">پورزنجانی</strong>
                </div>

                <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 col-span-2 sm:col-span-1">
                  <span class="text-slate-400 dark:text-slate-500 block mb-1">ساکن:</span>
                  <strong class="text-slate-800 dark:text-slate-100 font-bold">گرگان، ایران</strong>
                </div>
              </div>

              <!-- Quick action -->
              <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                <a 
                  href="#contact" 
                  class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs sm:text-sm shadow-sm transition"
                >
                  ارسال پیام به من
                </a>
                <button 
                  @click="printResume" 
                  class="px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 font-semibold text-xs sm:text-sm transition flex items-center gap-2"
                >
                  <span>🖨️</span>
                  <span>چاپ / خروجی PDF رزومه</span>
                </button>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section>

    <!-- SECTION 3: RESUME & SKILLS (رزومه - خلاصه‌ای از رزومه من) -->
    <section id="resume" class="py-20 transition-colors">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <!-- Section Header matching Image 3 -->
        <div class="text-center mb-16">
          <span class="inline-block px-3 py-1 rounded-lg bg-indigo-100 dark:bg-indigo-950/80 text-indigo-700 dark:text-indigo-400 text-xs font-bold uppercase tracking-wider mb-3">
            رزومه
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mb-2">
            خلاصه ای از رزومه من
          </h2>
          <p class="text-slate-500 dark:text-slate-400 text-sm">
            تخصص‌ها، مهارت‌های فنی و استک تکنولوژی مورد استفاده
          </p>
        </div>

        <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 sm:p-12 shadow-sm space-y-12">
          
          <!-- Skill Category Title -->
          <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
              <span class="text-2xl">⚡</span>
              <span>مهارت‌های من (My Skills)</span>
            </h3>
            <span class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold bg-indigo-50 dark:bg-indigo-950/60 px-3 py-1 rounded-full">
              توسعه فرانت‌اند
            </span>
          </div>

          <!-- Skills Grid matching Image 3 (2 columns) -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-7">
            <div 
              v-for="(skill, sIdx) in skillsList" 
              :key="sIdx"
              class="group space-y-2"
            >
              <div class="flex justify-between items-center text-sm font-semibold">
                <span class="text-slate-800 dark:text-slate-200 flex items-center gap-2">
                  <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                  {{ skill.name }}
                </span>
                <span class="text-indigo-600 dark:text-indigo-400 font-bold font-mono">{{ skill.level }}%</span>
              </div>
              <div class="w-full h-3 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden p-0.5 border border-slate-200/50 dark:border-slate-700/50">
                <div 
                  class="h-full bg-gradient-to-r from-indigo-500 via-violet-500 to-indigo-600 rounded-full transition-all duration-1000 group-hover:brightness-110 shadow-sm"
                  :style="{ width: skill.level + '%' }"
                ></div>
              </div>
            </div>
          </div>

          <!-- Additional Competencies / Badges -->
          <div class="pt-8 border-t border-slate-100 dark:border-slate-800">
            <h4 class="text-xs uppercase font-bold tracking-wider text-slate-400 dark:text-slate-500 mb-4">
              ابزارها و قابلیت‌های تکمیلی
            </h4>
            <div class="flex flex-wrap gap-2 sm:gap-2.5">
              <span v-for="tool in extraSkills" :key="tool" class="px-3.5 py-1.5 rounded-xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-200 hover:border-indigo-400 transition">
                {{ tool }}
              </span>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- SECTION 4: PORTFOLIO & PROJECTS (نمونه کارها - پروژه‌های من) -->
    <section id="projects" class="py-20 bg-slate-100/70 dark:bg-slate-900/50 border-t border-slate-200/60 dark:border-slate-800/60 transition-colors">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <!-- Section Header matching Image 4 -->
        <div class="text-center mb-12">
          <span class="inline-block px-3 py-1 rounded-lg bg-indigo-100 dark:bg-indigo-950/80 text-indigo-700 dark:text-indigo-400 text-xs font-bold uppercase tracking-wider mb-3">
            نمونه کارها
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mb-2">
            پروژه‌های من
          </h2>
          <p class="text-slate-500 dark:text-slate-400 text-sm max-w-lg mx-auto">
            مجموعه‌ای از پروژه‌های فرانت‌اند و مینی‌پروژه‌های کاربردی. با کلیک روی هر پروژه، جزئیات و دکمه ورود به هاست باز می‌شود.
          </p>
        </div>

        <!-- Filter Buttons -->
        <div class="flex items-center justify-center gap-2 mb-10 flex-wrap">
          <button 
            v-for="cat in projectCategories" 
            :key="cat.id"
            @click="selectedCategory = cat.id"
            :class="[
              selectedCategory === cat.id 
                ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/20' 
                : 'bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800',
              'px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition'
            ]"
          >
            {{ cat.name }}
          </button>
        </div>

        <!-- 6-Project Grid matching Image 4 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div 
            v-for="(proj, pIdx) in filteredMiniProjects" 
            :key="pIdx"
            @click="openProjectModal(proj)"
            class="group cursor-pointer rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-indigo-500/50 dark:hover:border-indigo-500/50 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col overflow-hidden"
          >
            <!-- Visual Card Header (Simulated App Banner / Mockup) -->
            <div :class="['h-44 p-6 relative flex flex-col justify-between overflow-hidden', proj.gradient]">
              <!-- Ambient Pattern Overlay -->
              <div class="absolute inset-0 bg-black/10 backdrop-blur-[2px]"></div>
              
              <!-- Floating Icon & Category Badge -->
              <div class="relative z-10 flex items-center justify-between">
                <span class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl shadow-sm text-white">
                  {{ proj.icon }}
                </span>
                <span class="px-2.5 py-1 rounded-full bg-black/30 backdrop-blur-md text-white text-[11px] font-bold">
                  {{ proj.categoryLabel }}
                </span>
              </div>

              <!-- Live Indicator / Click hint -->
              <div class="relative z-10 flex items-center justify-between text-white text-xs font-semibold">
                <span class="flex items-center gap-1.5 opacity-90">
                  <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                  <span>آماده در هاست</span>
                </span>
                <span class="opacity-80 group-hover:opacity-100 group-hover:translate-x-1 transition">
                  مشاهده مشخصات ←
                </span>
              </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
              <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition mb-2">
                  {{ proj.title }}
                </h3>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-2">
                  {{ proj.shortDesc }}
                </p>
              </div>

              <!-- Tags & Action button -->
              <div class="space-y-4 pt-2">
                <div class="flex flex-wrap gap-1.5">
                  <span 
                    v-for="(tag, tIdx) in proj.tags" 
                    :key="tIdx" 
                    class="text-[10px] font-semibold px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300"
                  >
                    {{ tag }}
                  </span>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-slate-100 dark:border-slate-800/80 text-xs font-bold text-indigo-600 dark:text-indigo-400">
                  <span>مشاهده جزئیات و لینک هاست</span>
                  <span class="w-6 h-6 rounded-full bg-indigo-50 dark:bg-indigo-950 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition">
                    ↗
                  </span>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- SECTION 5: CONTACT (تماس با من) -->
    <section id="contact" class="py-20 transition-colors">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <div class="text-center mb-16">
          <span class="inline-block px-3 py-1 rounded-lg bg-indigo-100 dark:bg-indigo-950/80 text-indigo-700 dark:text-indigo-400 text-xs font-bold uppercase tracking-wider mb-3">
            ارتباط
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mb-2">
            تماس با من
          </h2>
          <p class="text-slate-500 dark:text-slate-400 text-sm">
            خوشحال می‌شوم پیام شما را درباره پروژه‌های جدید، پیشنهادات شغلی یا سوالات فنی دریافت کنم.
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          
          <!-- Contact Info Cards (1 col) -->
          <div class="space-y-4">
            <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
              <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl shrink-0">
                📍
              </div>
              <div>
                <span class="text-xs text-slate-400 dark:text-slate-500 block">موقعیت مکانی</span>
                <strong class="text-sm text-slate-800 dark:text-slate-100">گرگان، ایران</strong>
              </div>
            </div>

            <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
              <div class="w-12 h-12 rounded-2xl bg-violet-50 dark:bg-violet-950/60 text-violet-600 dark:text-violet-400 flex items-center justify-center text-xl shrink-0">
                ✉️
              </div>
              <div>
                <span class="text-xs text-slate-400 dark:text-slate-500 block">آدرس ایمیل</span>
                <strong class="text-sm text-slate-800 dark:text-slate-100 font-mono">iliya.pourzanjani@example.com</strong>
              </div>
            </div>

            <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
              <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl shrink-0">
                💬
              </div>
              <div>
                <span class="text-xs text-slate-400 dark:text-slate-500 block">ارتباط سریع در تلگرام</span>
                <strong class="text-sm text-slate-800 dark:text-slate-100">@iliya_front</strong>
              </div>
            </div>
          </div>

          <!-- Contact Form (2 cols) -->
          <div class="lg:col-span-2 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 sm:p-10 shadow-sm">
            <form @submit.prevent="handleSendMessage" class="space-y-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">نام شما</label>
                  <input 
                    v-model="messageForm.name" 
                    type="text" 
                    required 
                    placeholder="مثال: علی احمدی"
                    class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">ایمیل شما</label>
                  <input 
                    v-model="messageForm.email" 
                    type="email" 
                    required 
                    placeholder="example@mail.com"
                    class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  />
                </div>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">موضوع پیام</label>
                <input 
                  v-model="messageForm.subject" 
                  type="text" 
                  placeholder="پیشنهاد پروژه / همکاری"
                  class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">متن پیام</label>
                <textarea 
                  v-model="messageForm.body" 
                  rows="4" 
                  required 
                  placeholder="پیام یا توضیحات پروژه خود را اینجا بنویسید..."
                  class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                ></textarea>
              </div>

              <div class="flex items-center justify-between pt-2">
                <button 
                  type="submit" 
                  class="px-8 py-3.5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-md shadow-indigo-600/25 transition flex items-center gap-2"
                >
                  <span>ارسال پیام</span>
                  <span>🚀</span>
                </button>

                <span v-if="messageSent" class="text-emerald-600 dark:text-emerald-400 text-xs sm:text-sm font-semibold flex items-center gap-1">
                  ✓ پیام شما با موفقیت ارسال شد!
                </span>
              </div>
            </form>
          </div>

        </div>

      </div>
    </section>

    <!-- FOOTER -->
    <footer class="no-print py-10 border-t border-slate-200 dark:border-slate-800 text-center text-xs text-slate-500 dark:text-slate-400">
      <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2 font-bold">
          <span class="text-indigo-600 dark:text-indigo-400 font-black text-lg">iliya</span>
          <span>• رزومه و پورتفولیو ایلیا پورزنجانی</span>
        </div>
        <div class="flex items-center gap-4">
          <a href="#home" class="hover:text-indigo-600 transition">بازگشت به بالا ↑</a>
          <span>طراحی شده با Vue 3 + Tailwind CSS + Laravel</span>
        </div>
      </div>
    </footer>

    <!-- INTERACTIVE PROJECT MODAL (As specifically requested by user) -->
    <div 
      v-if="activeModalProject" 
      class="fixed inset-0 z-50 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 overflow-y-auto animate-fade-in"
      @click.self="activeModalProject = null"
    >
      <div class="bg-white dark:bg-slate-900 w-full max-w-2xl rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden my-8">
        
        <!-- Modal Header Banner -->
        <div :class="['p-8 text-white relative overflow-hidden', activeModalProject.gradient]">
          <div class="relative z-10 flex items-start justify-between">
            <div class="flex items-center gap-3">
              <span class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-3xl shadow-sm">
                {{ activeModalProject.icon }}
              </span>
              <div>
                <span class="text-xs uppercase font-bold tracking-wider px-2.5 py-0.5 rounded-full bg-black/30 backdrop-blur-md text-white/90">
                  {{ activeModalProject.categoryLabel }}
                </span>
                <h3 class="text-2xl font-black mt-1">{{ activeModalProject.title }}</h3>
              </div>
            </div>

            <!-- Close button -->
            <button 
              @click="activeModalProject = null" 
              class="w-10 h-10 rounded-full bg-black/30 hover:bg-black/50 text-white flex items-center justify-center text-lg transition"
            >
              ✕
            </button>
          </div>
        </div>

        <!-- Modal Body Content -->
        <div class="p-6 sm:p-8 space-y-6">
          
          <!-- Detailed Description -->
          <div>
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">
              توضیحات و اهداف پروژه
            </h4>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
              {{ activeModalProject.fullDesc }}
            </p>
          </div>

          <!-- Key Features -->
          <div v-if="activeModalProject.features && activeModalProject.features.length">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2.5">
              امکانات کلیدی پیاده‌سازی شده
            </h4>
            <ul class="space-y-2 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
              <li v-for="(feat, fIdx) in activeModalProject.features" :key="fIdx" class="flex items-start gap-2">
                <span class="text-emerald-500 font-bold">✓</span>
                <span>{{ feat }}</span>
              </li>
            </ul>
          </div>

          <!-- Technologies Used -->
          <div>
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2.5">
              تکنولوژی‌ها و ابزارها
            </h4>
            <div class="flex flex-wrap gap-2">
              <span 
                v-for="(tech, tIdx) in activeModalProject.tags" 
                :key="tIdx" 
                class="px-3 py-1 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-bold"
              >
                {{ tech }}
              </span>
            </div>
          </div>

          <!-- Actions / Go to Hosted URL (Core requirement!) -->
          <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3">
            <a 
              :href="activeModalProject.hostedUrl" 
              target="_blank" 
              class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs sm:text-sm shadow-lg shadow-indigo-600/25 transition flex items-center justify-center gap-2"
            >
              <span>مشاهده آنلاین در هاست</span>
              <span>🚀</span>
            </a>

            <div class="flex items-center gap-2 w-full sm:w-auto">
              <a 
                v-if="activeModalProject.githubUrl" 
                :href="activeModalProject.githubUrl" 
                target="_blank" 
                class="flex-1 sm:flex-initial px-4 py-3.5 rounded-2xl border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 font-semibold text-xs transition flex items-center justify-center gap-1.5"
              >
                <span>🐙</span>
                <span>گیت‌هاب</span>
              </a>

              <button 
                @click="activeModalProject = null" 
                class="px-5 py-3.5 rounded-2xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 font-semibold text-xs transition"
              >
                بستن
              </button>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';

const locale = ref('fa');
const isDark = ref(false);
const isMobileMenuOpen = ref(false);
const activeSection = ref('home');
const selectedCategory = ref('all');
const activeModalProject = ref(null);
const messageSent = ref(false);

const messageForm = reactive({
  name: '',
  email: '',
  subject: '',
  body: '',
});

// Navigation Links matching user's original site
const navLinks = [
  { name: { fa: 'خانه', en: 'Home' }, href: '#home' },
  { name: { fa: 'درباره من', en: 'About Me' }, href: '#about' },
  { name: { fa: 'رزومه', en: 'Resume' }, href: '#resume' },
  { name: { fa: 'نمونه کار ها', en: 'Portfolio' }, href: '#projects' },
  { name: { fa: 'تماس با من', en: 'Contact' }, href: '#contact' },
];

// Skills matching image 3 from the user's actual resume
const skillsList = [
  { name: 'HTML / CSS', level: 95 },
  { name: 'JavaScript (ES6+)', level: 90 },
  { name: 'Bootstrap / Tailwind', level: 90 },
  { name: 'Ajax / API', level: 80 },
  { name: 'Jquery', level: 80 },
  { name: 'Angular Js / Vue.js', level: 80 },
  { name: 'SQL', level: 85 },
  { name: 'Photoshop', level: 90 },
];

const extraSkills = [
  'Git & GitHub',
  'Responsive Web Design',
  'RESTful APIs & Fetch',
  'Vite & Webpack',
  'Figma UI/UX',
  'Clean Code',
  'JSON & Data Handling',
  'Cross-Browser Testing',
];

// Categories for Projects
const projectCategories = [
  { id: 'all', name: 'همه پروژه‌ها' },
  { id: 'webapps', name: 'اپلیکیشن‌های وب' },
  { id: 'mini', name: 'مینی پروژه‌ها' },
  { id: 'js', name: 'پروژه‌های جاوااسکریپت' },
];

// Mini Projects list matching requirements
const miniProjects = [
  {
    id: 1,
    icon: '🛍️',
    title: 'فروشگاه آنلاین مینیمال (Mini E-Commerce)',
    category: 'webapps',
    categoryLabel: 'اپلیکیشن وب',
    gradient: 'bg-gradient-to-br from-indigo-600 to-purple-600',
    shortDesc: 'فروشگاه محصولات مدرن با سبد خرید تعاملی، فیلتر دسته‌بندی و محاسبه لحظه‌ای فاکتور.',
    fullDesc: 'یک وب‌اپلیکیشن فروشگاهی کامل فرانت‌اند با طراحی واکنش‌گرا که به کاربر اجازه می‌دهد محصولات را جستجو کند، بر اساس دسته‌بندی فیلتر نماید، اقلام را به سبد خرید اضافه کرده و فاکتور نهایی را مشاهده کند.',
    features: [
      'سیستم مدیریت سبد خرید آنی و بدون نیاز به رفرش',
      'ذخیره خودکار سبد در LocalStorage مرورگر',
      'فیلتر و جستجوی لحظه‌ای محصولات بر اساس نام و قیمت',
      'طراحی کاملاً واکنش‌گرا برای گوشی و دسکتاپ',
    ],
    tags: ['HTML5', 'CSS3', 'JavaScript', 'LocalStorage', 'Responsive'],
    hostedUrl: 'https://example.com/iliya/mini-ecommerce',
    githubUrl: 'https://github.com/example/mini-ecommerce',
  },
  {
    id: 2,
    icon: '🌤️',
    title: 'سامانه وضعیت آب و هوا با API زنده',
    category: 'js',
    categoryLabel: 'جاوااسکریپت & API',
    gradient: 'bg-gradient-to-br from-sky-600 to-cyan-600',
    shortDesc: 'دریافت آنلاین آب‌وهوای شهرهای جهان با ارتباط زنده OpenWeatherMap API.',
    fullDesc: 'اپلیکیشن هواشناسی تعاملی با مصرف مستقیم APIهای RESTful. وضعیت آب و هوا، رطوبت، سرعت باد، پیش‌بینی روزهای آینده و تغییر داینامیک پس‌زمینه با توجه به شرایط جوی شهر انتخابی پیاده‌سازی شده است.',
    features: [
      'ارسال درخواست‌های غیرهمزمان با Fetch / Async-Await',
      'تغییر خودکار پس‌زمینه و آیکون‌ها بر اساس وضعیت ابری، بارانی یا آفتابی',
      'نمایش سرعت باد، فشار هوا، دمای احساسی و رطوبت',
      'مدیریت خطاهای شبکه و نام شهرهای نامعتبر',
    ],
    tags: ['JavaScript', 'REST API', 'Fetch', 'Tailwind', 'GeoLocation'],
    hostedUrl: 'https://example.com/iliya/weather-app',
    githubUrl: 'https://github.com/example/weather-app',
  },
  {
    id: 3,
    icon: '📋',
    title: 'داشبورد مدیریت تسک‌ها (Task & Kanban)',
    category: 'webapps',
    categoryLabel: 'اپلیکیشن وب',
    gradient: 'bg-gradient-to-br from-emerald-600 to-teal-700',
    shortDesc: 'تخته کانبان تعاملی برای سازماندهی وظایف روزانه با قابلیت Drag & Drop.',
    fullDesc: 'سیستم برنامه‌ریزی و مدیریت وظایف با تخته‌های انجام شده، در حال انجام و در صف انتظار. کاربران می‌توانند کارت‌های کاری را با ماوس جابجا کنند، اولویت‌بندی کرده و زمان تحویل مشخص کنند.',
    features: [
      'قابلیت Drag and Drop حرفه‌ای برای جابجایی وظایف بین ستون‌ها',
      'ذخیره‌سازی پایدار در حافظه کلاینت',
      'برچسب‌گذاری رنگی با برچسب فوریت و اهمیت',
      'امکان ویرایش و حذف سریع کارت‌ها',
    ],
    tags: ['Vue.js', 'Drag & Drop API', 'CSS Grid', 'LocalStorage'],
    hostedUrl: 'https://example.com/iliya/kanban-tasks',
    githubUrl: 'https://github.com/example/kanban-tasks',
  },
  {
    id: 4,
    icon: '🎵',
    title: 'موزیک پلیر مدرن و گلس‌مورفیک',
    category: 'mini',
    categoryLabel: 'مینی پروژه',
    gradient: 'bg-gradient-to-br from-fuchsia-600 to-rose-600',
    shortDesc: 'پخش‌کننده صوتی چشم‌نواز با اکولایزر انیمیشنی، پلی‌لیست و کنترل‌های پیشرفته صدا.',
    fullDesc: 'یک پلیر موسیقی سفارشی که با استفاده از HTML5 Audio API و طراحی مدرن Glassmorphism ساخته شده است. پشتیبانی از لود کاور موزیک، نوار پیشرفت کشیدنی (Seekbar) و حالت تکرار/شانسی.',
    features: [
      'مدیریت اختصاصی صوتی با HTML5 Audio',
      'طراحی مدرن شیشه‌ای (Glassmorphism) و واکنش‌گرا',
      'پلی‌لیست پویا و تغییر خودکار آهنگ پس از پایان',
      'نوار اسکراب زمانی و کنترل ولوم روان',
    ],
    tags: ['HTML5 Audio', 'JavaScript', 'CSS Animation', 'Glassmorphism'],
    hostedUrl: 'https://example.com/iliya/music-player',
    githubUrl: 'https://github.com/example/music-player',
  },
  {
    id: 5,
    icon: '🔢',
    title: 'ماشین حساب مهندسی و هوشمند',
    category: 'mini',
    categoryLabel: 'مینی پروژه',
    gradient: 'bg-gradient-to-br from-amber-600 to-orange-600',
    shortDesc: 'ماشین حساب تعاملی با پشتیبانی از کلیدهای کیبورد و تاریخچه محاسبات.',
    fullDesc: 'ماشین حساب سریع و دقیق با توانایی پردازش عبارات پیچیده ریاضی، پاک‌کردن گام به گام، تاریخچه محاسبات قبلی و قابلیت تایپ مستقیم از کیبورد کاربر.',
    features: [
      'پردازش عبارات جبری با رعایت اولویت عملگرها',
      'پشتیبانی کامل از کلیدهای صفحه کلید (Keyboard Events)',
      'تب پنجره سوابق محاسبات اخیر',
      'انیمیشن‌های لمسی و کلیک نرم',
    ],
    tags: ['JavaScript', 'DOM Events', 'Tailwind', 'CSS Grid'],
    hostedUrl: 'https://example.com/iliya/smart-calculator',
    githubUrl: 'https://github.com/example/smart-calculator',
  },
  {
    id: 6,
    icon: '🧠',
    title: 'بازی تقویت حافظه تعاملی (Memory Game)',
    category: 'js',
    categoryLabel: 'بازی وب',
    gradient: 'bg-gradient-to-br from-blue-600 to-indigo-700',
    shortDesc: 'بازی چرخش کارت‌های ۳بعدی، ثبت رکورد زمانی و تعداد حرکات.',
    fullDesc: 'بازی پیدا کردن جفت کارت‌های یکسان با انیمیشن‌های سه‌بعدی CSS 3D Flip Cards. این بازی شامل تایمر زمان، شمارنده حرکات، سیستم ثبت بهترین امتیاز و جلوه‌های صوتی است.',
    features: [
      'انیمیشن‌های ۳ بعدی چرخش کارت‌ها در CSS',
      'الگوریتم بر زدن تصادفی کارت‌ها (Fisher-Yates Shuffle)',
      'شمارش هوشمند زمان و تعداد حرکات',
      'پاپ‌آپ پایان بازی و پیام پیروزی',
    ],
    tags: ['Vanilla JS', 'CSS 3D Transforms', 'Algorithms', 'Interactive'],
    hostedUrl: 'https://example.com/iliya/memory-game',
    githubUrl: 'https://github.com/example/memory-game',
  },
];

const filteredMiniProjects = computed(() => {
  if (selectedCategory.value === 'all') {
    return miniProjects;
  }
  return miniProjects.filter(p => p.category === selectedCategory.value);
});

const openProjectModal = (proj) => {
  activeModalProject.value = proj;
};

const toggleTheme = () => {
  isDark.value = !isDark.value;
  if (isDark.value) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
};

const printResume = () => {
  window.print();
};

const handleSendMessage = () => {
  messageSent.value = true;
  messageForm.name = '';
  messageForm.email = '';
  messageForm.subject = '';
  messageForm.body = '';
  setTimeout(() => {
    messageSent.value = false;
  }, 4500);
};

// Track active section on scroll
onMounted(() => {
  const sections = document.querySelectorAll('section[id]');
  window.addEventListener('scroll', () => {
    const scrollY = window.pageYOffset;
    sections.forEach(current => {
      const sectionHeight = current.offsetHeight;
      const sectionTop = current.offsetTop - 120;
      const sectionId = current.getAttribute('id');
      if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
        activeSection.value = sectionId;
      }
    });
  });
});
</script>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.97); }
  to { opacity: 1; transform: scale(1); }
}

.animate-fade-in {
  animation: fadeIn 0.25s ease-out forwards;
}

@media print {
  header, footer, .no-print {
    display: none !important;
  }
}
</style>
