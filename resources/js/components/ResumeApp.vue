<template>
  <div 
    class="dark bg-[#080B11] text-slate-100 min-h-screen font-sans selection:bg-orange-500 selection:text-white relative overflow-hidden" 
    :dir="locale === 'fa' ? 'rtl' : 'ltr'"
  >
    
    <!-- Top Scroll Progress Bar (Orange / Amber Gradient) -->
    <div 
      class="fixed top-0 left-0 right-0 h-1 z-50 transition-all duration-150 bg-gradient-to-r from-amber-400 via-orange-500 to-amber-500 shadow-sm shadow-orange-500/50"
      :style="{ width: scrollProgress + '%' }"
    ></div>

    <!-- NAVBAR (Fixed at Top, always visible even on scroll) -->
    <header 
      :class="[
        isScrolled 
          ? 'py-3.5 bg-[#080B11]/90 shadow-xl shadow-black/40 border-slate-800' 
          : 'py-5 bg-[#080B11]/80 border-slate-800/60',
        'fixed top-0 left-0 right-0 z-40 backdrop-blur-xl border-b transition-all duration-300 no-print'
      ]"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        
        <!-- Social Icons (Left) -->
        <div class="flex items-center gap-2 sm:gap-3">
          <a 
            href="https://github.com" 
            target="_blank" 
            class="w-10 h-10 rounded-2xl bg-slate-900/80 backdrop-blur-md border border-slate-800 hover:border-orange-500 hover:text-orange-400 hover:scale-110 text-slate-300 flex items-center justify-center transition-all duration-300 shadow-sm text-sm"
            title="GitHub"
          >
            <span>🐙</span>
          </a>
          <a 
            href="https://linkedin.com" 
            target="_blank" 
            class="w-10 h-10 rounded-2xl bg-slate-900/80 backdrop-blur-md border border-slate-800 hover:border-orange-500 hover:text-orange-400 hover:scale-110 text-slate-300 flex items-center justify-center transition-all duration-300 shadow-sm text-sm"
            title="LinkedIn"
          >
            <span>💼</span>
          </a>
          <a 
            href="https://t.me/iliya_front" 
            target="_blank" 
            class="w-10 h-10 rounded-2xl bg-slate-900/80 backdrop-blur-md border border-slate-800 hover:border-orange-500 hover:text-orange-400 hover:scale-110 text-slate-300 flex items-center justify-center transition-all duration-300 shadow-sm text-sm"
            title="Telegram"
          >
            <span>✈️</span>
          </a>
        </div>

        <!-- Desktop Navigation Menu (Center) -->
        <nav class="hidden md:flex items-center gap-1.5 p-1.5 rounded-full bg-slate-900/80 backdrop-blur-xl border border-slate-800 shadow-sm text-xs font-bold text-slate-300">
          <a 
            v-for="item in navLinks" 
            :key="item.href"
            :href="item.href" 
            :class="[
              activeSection === item.href.replace('#', '') 
                ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md shadow-orange-500/25' 
                : 'hover:text-white hover:bg-slate-800/80',
              'px-4 py-2 rounded-full transition-all duration-300'
            ]"
          >
            {{ item.name[locale] }}
          </a>
        </nav>

        <!-- Brand / Logo (iliya) (Right) -->
        <div class="flex items-center gap-3">
          <a href="#home" class="group flex items-center gap-2">
            <span class="text-3xl font-black tracking-tighter bg-gradient-to-r from-amber-400 via-orange-500 to-amber-500 bg-clip-text text-transparent group-hover:scale-105 transition-transform duration-300">
              iliya
            </span>
            <span class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
            </span>
          </a>

          <!-- Mobile Hamburger Toggle -->
          <button 
            @click="isMobileMenuOpen = !isMobileMenuOpen" 
            class="md:hidden p-2.5 rounded-2xl bg-slate-800/80 border border-slate-700 text-slate-200 shadow-sm"
          >
            <span v-if="isMobileMenuOpen">✕</span>
            <span v-else>☰</span>
          </button>
        </div>

      </div>

      <!-- Mobile Menu Dropdown -->
      <transition 
        enter-active-class="transition duration-200 ease-out" 
        enter-from-class="transform -translate-y-4 opacity-0" 
        enter-to-class="transform translate-y-0 opacity-100" 
        leave-active-class="transition duration-150 ease-in" 
        leave-from-class="transform translate-y-0 opacity-100" 
        leave-to-class="transform -translate-y-4 opacity-0"
      >
        <div v-if="isMobileMenuOpen" class="md:hidden border-t border-slate-800 bg-[#080B11]/95 backdrop-blur-2xl px-6 py-5 space-y-3 shadow-2xl">
          <a 
            v-for="item in navLinks" 
            :key="item.href"
            :href="item.href" 
            @click="isMobileMenuOpen = false"
            class="block py-2.5 px-4 rounded-xl text-sm font-bold text-slate-200 hover:bg-slate-800 hover:text-orange-400 transition"
          >
            {{ item.name[locale] }}
          </a>
        </div>
      </transition>
    </header>

    <!-- PADDING FOR FIXED NAVBAR -->
    <div class="h-20 sm:h-24"></div>

    <!-- SECTION 1: HERO (خانه) -->
    <section id="home" class="relative min-h-[85vh] flex items-center justify-center overflow-hidden py-14 sm:py-20">
      
      <!-- Amber / Orange Ambient Background Glows matching Screenshot -->
      <div 
        class="absolute top-1/4 -right-20 w-[480px] h-[480px] rounded-full blur-[130px] pointer-events-none animate-pulse-glow"
        style="background: rgba(245, 158, 11, 0.16);"
      ></div>
      <div 
        class="absolute bottom-1/4 -left-20 w-[480px] h-[480px] rounded-full blur-[130px] pointer-events-none animate-pulse-glow"
        style="background: rgba(234, 88, 12, 0.14); animation-delay: 2.5s;"
      ></div>
      
      <!-- Architectural Grid from User's Screenshot -->
      <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] pointer-events-none"></div>

      <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 text-center">
        
        <!-- Status Pill matching Screenshot -->
        <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full border border-orange-500/35 bg-orange-950/40 backdrop-blur-xl text-xs sm:text-sm font-extrabold mb-7 shadow-sm text-orange-400 hover:scale-105 transition-transform duration-300 cursor-default">
          <span class="relative flex h-2.5 w-2.5">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-orange-500"></span>
          </span>
          <span>آماده برای همکاری در پروژه‌های جدید و استخدام</span>
        </div>

        <!-- Greeting -->
        <p class="text-xl sm:text-2xl font-medium text-slate-300 mb-3 tracking-wide">
          سلام، من <span class="font-extrabold text-white border-b-2 border-orange-500 pb-0.5">ایلیا</span> هستم
        </p>

        <!-- Big Bold Title with Vibrant Orange Gradient -->
        <h1 class="text-6xl sm:text-8xl lg:text-9xl font-black tracking-tight mb-5 leading-none select-none">
          <span class="bg-gradient-to-r from-amber-400 via-orange-500 to-amber-500 bg-clip-text text-transparent filter drop-shadow-sm inline-block transform hover:scale-[1.02] transition-transform duration-500">
            فرانت اند
          </span>
        </h1>

        <!-- FEATURE 1: Interactive Dynamic Typewriter Console -->
        <div class="h-9 sm:h-11 flex items-center justify-center mb-6">
          <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-xl bg-slate-900/70 border border-slate-800/80 backdrop-blur-md shadow-inner text-xs sm:text-sm md:text-base font-bold text-orange-400">
            <span>&gt;</span>
            <span>{{ currentTypedText }}</span>
            <span class="w-1.5 h-4 bg-orange-400 inline-block animate-cursor"></span>
          </div>
        </div>

        <!-- Subtitle -->
        <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto mb-10 leading-relaxed font-normal">
          خلق رابط‌های کاربری چشم‌نواز، واکنش‌گرا و مدرن با تمرکز بر تمیزی کد، عملکرد پرسرعت و جزئیات ظریف طراحی.
        </p>

        <!-- CTA Buttons matching Screenshot -->
        <div class="flex flex-wrap items-center justify-center gap-4">
          <a 
            href="#projects" 
            class="group px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-amber-500 hover:from-amber-400 hover:to-orange-400 text-white font-extrabold text-sm sm:text-base shadow-xl shadow-orange-500/25 hover:shadow-orange-500/40 hover:-translate-y-1 active:translate-y-0 transition-all duration-300 flex items-center gap-3"
          >
            <span>مشاهده کارهای من</span>
            <span class="group-hover:translate-y-1 transition-transform duration-300">↓</span>
          </a>

          <a 
            href="#about" 
            class="px-8 py-4 rounded-2xl bg-slate-900/80 backdrop-blur-xl border border-slate-800 hover:border-slate-600 text-slate-100 font-extrabold text-sm sm:text-base shadow-sm hover:-translate-y-1 active:translate-y-0 transition-all duration-300"
          >
            درباره من بیشتر بدانید
          </a>
        </div>

        <!-- Quick Stats Cards matching Screenshot -->
        <div class="grid grid-cols-3 max-w-xl mx-auto mt-16 pt-8 border-t border-slate-800/80 gap-3 sm:gap-6">
          <div class="p-4 rounded-2xl bg-slate-900/60 backdrop-blur-md border border-slate-800/70 hover:border-slate-600 transition-all duration-300 hover:scale-105 shadow-sm">
            <span class="block text-2xl sm:text-4xl font-black text-orange-400">+۱۲</span>
            <span class="text-[11px] sm:text-xs text-slate-400 mt-1 font-bold block">پروژه انجام شده</span>
          </div>
          <div class="p-4 rounded-2xl bg-slate-900/60 backdrop-blur-md border border-slate-800/70 hover:border-slate-600 transition-all duration-300 hover:scale-105 shadow-sm">
            <span class="block text-2xl sm:text-4xl font-black text-slate-100">۱۰۰٪</span>
            <span class="text-[11px] sm:text-xs text-slate-400 mt-1 font-bold block">واکنش‌گرا (Responsive)</span>
          </div>
          <div class="p-4 rounded-2xl bg-slate-900/60 backdrop-blur-md border border-slate-800/70 hover:border-slate-600 transition-all duration-300 hover:scale-105 shadow-sm">
            <span class="block text-2xl sm:text-4xl font-black text-orange-400">⚡ سریع</span>
            <span class="text-[11px] sm:text-xs text-slate-400 mt-1 font-bold block">یادگیری و اجرای چابک</span>
          </div>
        </div>

      </div>
    </section>

    <!-- SECTION 2: ABOUT ME (درباره من - مرا بیشتر بشناس) -->
    <section id="about" class="py-24 bg-slate-900/30 border-y border-slate-800/60 relative transition-colors">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <!-- Section Header -->
        <div class="text-center mb-16">
          <span class="inline-block px-3.5 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider mb-3 shadow-sm border border-orange-500/30 bg-orange-950/40 text-orange-400">
            درباره من
          </span>
          <h2 class="text-3xl sm:text-5xl font-black text-white">
            مرا بیشتر بشناس
          </h2>
        </div>

        <!-- Main Card -->
        <div class="rounded-3xl bg-slate-900/80 backdrop-blur-2xl border border-slate-800 p-6 sm:p-12 shadow-xl hover:shadow-2xl transition-all duration-500">
          <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
            
            <!-- User Portrait with Amber/Orange Gradient Ring -->
            <div class="relative shrink-0 group">
              <div class="w-64 h-64 sm:w-72 sm:h-72 rounded-3xl overflow-hidden p-1.5 shadow-2xl transition-transform duration-500 group-hover:scale-105 group-hover:rotate-1 bg-gradient-to-tr from-amber-400 via-orange-500 to-amber-500">
                <img 
                  :src="profileImage" 
                  alt="ایلیا پورزنجانی" 
                  class="w-full h-full object-cover rounded-[22px]"
                />
              </div>

              <!-- Animated Floating Badge -->
              <div class="absolute -bottom-4 -right-4 px-4 py-2.5 rounded-2xl text-white text-xs font-black shadow-lg flex items-center gap-2 animate-float bg-gradient-to-r from-amber-500 to-orange-500 shadow-orange-500/30">
                <span class="text-sm">💻</span>
                <span>توسعه‌دهنده فرانت‌اند</span>
              </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 space-y-6 text-center lg:text-start">
              <div>
                <h3 class="text-2xl sm:text-4xl font-black text-white mb-2">
                  سلام من <span class="text-orange-400">ایلیا پورزنجانی</span> هستم
                </h3>
                <p class="text-xs sm:text-sm font-bold text-slate-400">
                  Front-End Web Developer • ساکن گرگان
                </p>
              </div>

              <!-- Bio matching User's exact text -->
              <p class="text-slate-300 leading-relaxed text-sm sm:text-base font-normal">
                توسعه‌دهنده فرانت‌اند با تجربه در اجرای پروژه‌های تمرینی و شخصی در زمینه طراحی رابط کاربری واکنش‌گرا (Responsive). علاقه‌مند به توسعه نرم‌افزارهای کاربردی تحت وب، دارای روحیه یادگیری سریع، توانایی حل مسئله و همکاری تیمی، آماده برای ورود به دنیای حرفه‌ای و رشد مستمر در حوزه برنامه‌نویسی وب.
              </p>

              <!-- Meta Fields Grid matching Image 2 -->
              <div class="grid grid-cols-2 sm:grid-cols-3 gap-3.5 pt-6 border-t border-slate-800/80 text-xs sm:text-sm">
                <div class="p-4 rounded-2xl bg-slate-800/40 border border-slate-700/60 hover:border-slate-500 transition">
                  <span class="text-slate-500 text-xs block mb-1">اسم:</span>
                  <strong class="text-white font-extrabold text-sm sm:text-base">ایلیا</strong>
                </div>

                <div class="p-4 rounded-2xl bg-slate-800/40 border border-slate-700/60 hover:border-slate-500 transition">
                  <span class="text-slate-500 text-xs block mb-1">فامیلی:</span>
                  <strong class="text-white font-extrabold text-sm sm:text-base">پورزنجانی</strong>
                </div>

                <div class="p-4 rounded-2xl bg-slate-800/40 border border-slate-700/60 hover:border-slate-500 transition col-span-2 sm:col-span-1">
                  <span class="text-slate-500 text-xs block mb-1">ساکن:</span>
                  <strong class="text-white font-extrabold text-sm sm:text-base">گرگان، ایران</strong>
                </div>
              </div>

              <!-- Buttons -->
              <div class="pt-3 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                <a 
                  href="#contact" 
                  class="px-8 py-3.5 rounded-2xl text-white font-bold text-xs sm:text-sm shadow-md bg-gradient-to-r from-amber-500 to-orange-500 shadow-orange-500/25 hover:scale-105 active:scale-95 transition-all duration-300"
                >
                  ارتباط با من
                </a>
              </div>

            </div>

          </div>
        </div>

        <!-- FEATURE 7: Core Engineering Principles (اصول کاری من) -->
        <div class="mt-16 pt-12 border-t border-slate-800/80">
          <div class="text-center mb-10">
            <span class="text-xs font-black uppercase tracking-wider text-orange-400 mb-1 block">استانداردهای مهندسی</span>
            <h3 class="text-2xl sm:text-3xl font-black text-white">اصول کاری من در توسعه وب</h3>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div 
              v-for="(principle, prIdx) in principlesList" 
              :key="prIdx"
              @mousemove="handleCardSpotlight"
              class="card-spotlight p-6 rounded-3xl bg-slate-900/90 border border-slate-800 hover:border-orange-500/50 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 relative"
            >
              <div class="w-12 h-12 rounded-2xl bg-orange-950/50 border border-orange-500/30 flex items-center justify-center text-2xl mb-4 text-orange-400 shadow-sm">
                {{ principle.icon }}
              </div>
              <h4 class="text-base font-black text-white mb-2">{{ principle.title }}</h4>
              <p class="text-xs sm:text-sm text-slate-400 leading-relaxed font-normal">
                {{ principle.description }}
              </p>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- SECTION 3: RESUME & SKILLS (رزومه - خلاصه ای از رزومه من) -->
    <section id="resume" class="py-24 transition-colors">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <!-- Section Header matching Image 3 -->
        <div class="text-center mb-16">
          <span class="inline-block px-3.5 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider mb-3 shadow-sm border border-orange-500/30 bg-orange-950/40 text-orange-400">
            رزومه
          </span>
          <h2 class="text-3xl sm:text-5xl font-black text-white mb-3">
            خلاصه ای از رزومه من
          </h2>
          <p class="text-slate-400 text-sm">
            سطح تسلط بر مهارت‌های فنی، کتابخانه‌ها و ابزارهای توسعه وب
          </p>
        </div>

        <div class="rounded-3xl bg-slate-900/80 backdrop-blur-2xl border border-slate-800 p-6 sm:p-12 shadow-xl space-y-14">
          
          <!-- Category Title -->
          <div class="flex items-center justify-between pb-5 border-b border-slate-800/80">
            <h3 class="text-xl sm:text-2xl font-black text-white flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-slate-800 flex items-center justify-center text-lg">⚡</span>
              <span>مهارت من (My Skills)</span>
            </h3>
            <span class="text-xs font-bold border border-orange-500/30 bg-orange-950/40 text-orange-400 px-3.5 py-1.5 rounded-full">
              توسعه فرانت‌اند
            </span>
          </div>

          <!-- Animated Skill Bars matching exact skills from image 3 -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
            <div 
              v-for="(skill, sIdx) in skillsList" 
              :key="sIdx"
              class="group space-y-2.5 p-3 rounded-2xl hover:bg-slate-800/40 transition-all duration-300"
            >
              <div class="flex justify-between items-center text-sm font-bold">
                <span class="text-slate-200 flex items-center gap-2 transition">
                  <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span>
                  {{ skill.name }}
                </span>
                <span class="font-black font-mono text-base text-orange-400">{{ skill.level }}%</span>
              </div>
              <div class="w-full h-3.5 rounded-full bg-slate-800 overflow-hidden p-0.5 border border-slate-700/60">
                <div 
                  class="h-full rounded-full transition-all duration-1000 ease-out group-hover:brightness-110 shadow-sm bg-gradient-to-r from-amber-400 via-orange-500 to-amber-500"
                  :style="{ width: skill.level + '%' }"
                ></div>
              </div>
            </div>
          </div>

          <!-- Extra Skills Tags -->
          <div class="pt-8 border-t border-slate-800/80">
            <h4 class="text-xs uppercase font-black tracking-wider text-slate-500 mb-4">
              ابزارها و قابلیت‌های تکمیلی
            </h4>
            <div class="flex flex-wrap gap-2.5">
              <span 
                v-for="tool in extraSkills" 
                :key="tool" 
                class="px-4 py-2 rounded-2xl bg-slate-800/60 border border-slate-700/80 text-xs font-bold text-slate-200 hover:border-slate-500 transition-all duration-300 hover:scale-105 cursor-default shadow-sm"
              >
                {{ tool }}
              </span>
            </div>
          </div>

          <!-- FEATURE 6: My Journey Timeline (تایم‌لاین مسیر رشد و یادگیری) -->
          <div class="pt-10 border-t border-slate-800/80">
            <div class="mb-8">
              <span class="text-xs font-black uppercase tracking-wider text-orange-400 mb-1 block">روند پیشرفت</span>
              <h3 class="text-2xl font-black text-white flex items-center gap-2">
                <span>🚀</span>
                <span>تایم‌لاین یادگیری و تجربه</span>
              </h3>
            </div>

            <!-- Responsive Vertical Timeline -->
            <div class="relative pr-4 sm:pr-8 border-r-2 border-slate-800 space-y-10">
              <div 
                v-for="(stage, stIdx) in careerTimeline" 
                :key="stIdx"
                class="relative group"
              >
                <!-- Glowing Node -->
                <div class="absolute -right-[23px] sm:-right-[39px] top-1.5 w-5 h-5 rounded-full bg-slate-900 border-2 border-orange-500 shadow-md shadow-orange-500/40 group-hover:scale-125 transition-transform flex items-center justify-center">
                  <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                </div>

                <!-- Timeline Card -->
                <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-800 hover:border-orange-500/40 transition-all duration-300">
                  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-2">
                    <h4 class="text-base sm:text-lg font-black text-white group-hover:text-orange-400 transition-colors">
                      {{ stage.title }}
                    </h4>
                    <span class="text-xs font-extrabold px-3 py-1 rounded-full bg-orange-950/60 border border-orange-500/30 text-orange-400 w-fit">
                      {{ stage.period }}
                    </span>
                  </div>
                  <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal mb-3">
                    {{ stage.description }}
                  </p>
                  <div class="flex flex-wrap gap-1.5">
                    <span 
                      v-for="(tech, tcIdx) in stage.badges" 
                      :key="tcIdx"
                      class="text-[10px] font-bold px-2.5 py-0.5 rounded-md bg-slate-800 border border-slate-700/70 text-slate-300"
                    >
                      {{ tech }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- SECTION 4: PORTFOLIO & PROJECTS (نمونه کار ها - پروژه های من) -->
    <section id="projects" class="py-24 bg-slate-900/30 border-t border-slate-800/60 relative transition-colors">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <!-- Section Header matching Image 4 -->
        <div class="text-center mb-14">
          <span class="inline-block px-3.5 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider mb-3 shadow-sm border border-orange-500/30 bg-orange-950/40 text-orange-400">
            نمونه کارها
          </span>
          <h2 class="text-3xl sm:text-5xl font-black text-white mb-3">
            پروژه‌های من
          </h2>
          <p class="text-slate-400 text-sm max-w-lg mx-auto">
            مجموعه‌ای از مینی‌پروژه‌های کاربردی و فرانت‌اند. برای مشاهده توضیحات و ورود مستقیم به آدرس آنلاین در هاست، روی هر کارت کلیک کنید.
          </p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex items-center justify-center gap-2 mb-12 flex-wrap">
          <button 
            v-for="cat in projectCategories" 
            :key="cat.id"
            @click="selectedCategory = cat.id"
            :class="[
              selectedCategory === cat.id 
                ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white font-extrabold shadow-lg shadow-orange-500/25 scale-105' 
                : 'bg-slate-900 text-slate-300 border border-slate-800 hover:bg-slate-800',
              'px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold transition-all duration-300'
            ]"
          >
            {{ cat.name }}
          </button>
        </div>

        <!-- 6 Mini Projects Grid (matches layout of Image 4 + FEATURE 3 & 5: Browser Frame & Spotlight) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
          <div 
            v-for="(proj, pIdx) in filteredMiniProjects" 
            :key="pIdx"
            @click="openProjectModal(proj)"
            @mousemove="handleCardSpotlight"
            class="card-spotlight group cursor-pointer rounded-3xl bg-slate-900 border border-slate-800/80 hover:border-orange-500/60 shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-400 flex flex-col overflow-hidden relative"
          >
            <!-- FEATURE 3: Browser Mockup Frame Header -->
            <div class="px-4 py-2.5 bg-slate-950/80 border-b border-slate-800/80 flex items-center justify-between z-10">
              <div class="flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
              </div>
              <span class="text-[10px] font-mono text-slate-500 truncate max-w-[170px] dir-ltr text-center">
                {{ proj.mockUrl }}
              </span>
              <span class="text-[11px] text-slate-600">⚡</span>
            </div>

            <!-- Card Visual Banner -->
            <div :class="['h-44 p-6 relative flex flex-col justify-between overflow-hidden', proj.gradient]">
              <div class="absolute inset-0 bg-black/30 backdrop-blur-[2px]"></div>
              
              <!-- Floating Icon and Category -->
              <div class="relative z-10 flex items-center justify-between">
                <span class="w-13 h-13 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-3xl shadow-sm text-white group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                  {{ proj.icon }}
                </span>
                <span class="px-3 py-1 rounded-full bg-black/45 backdrop-blur-md text-white text-[11px] font-bold">
                  {{ proj.categoryLabel }}
                </span>
              </div>

              <!-- Live Indicator / Click hint -->
              <div class="relative z-10 flex items-center justify-between text-white text-xs font-bold">
                <span class="flex items-center gap-1.5 opacity-90">
                  <span class="w-2.5 h-2.5 rounded-full bg-orange-400 animate-ping"></span>
                  <span>آنلاین در هاست</span>
                </span>
                <span class="opacity-80 group-hover:opacity-100 group-hover:translate-x-1 transition-transform">
                  مشاهده مشخصات ←
                </span>
              </div>
            </div>

            <!-- Card Body Content -->
            <div class="p-6 flex-1 flex flex-col justify-between space-y-4 z-10">
              <div>
                <h3 class="text-lg font-black text-white group-hover:text-orange-400 transition-colors mb-2">
                  {{ proj.title }}
                </h3>
                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed line-clamp-2">
                  {{ proj.shortDesc }}
                </p>
              </div>

              <!-- Tags and Host Link Callout -->
              <div class="space-y-4 pt-2">
                <div class="flex flex-wrap gap-1.5">
                  <span 
                    v-for="(tag, tIdx) in proj.tags" 
                    :key="tIdx" 
                    class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-slate-800 text-slate-300"
                  >
                    {{ tag }}
                  </span>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-slate-800/80 text-xs font-bold text-orange-400">
                  <span>مشاهده جزئیات و لینک هاست</span>
                  <span 
                    class="w-7 h-7 rounded-xl flex items-center justify-center transition-all duration-300 bg-slate-800 text-slate-200 group-hover:scale-110 group-hover:bg-orange-500 group-hover:text-white"
                  >
                    ↗
                  </span>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- SECTION 5: CONTACT (راه‌های ارتباط با من - بزرگ و در وسط صفحه) -->
    <section id="contact" class="py-24 transition-colors">
      <div class="max-w-5xl mx-auto px-4 sm:px-6">
        
        <div class="text-center mb-16">
          <span class="inline-block px-4 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider mb-3 shadow-sm border border-orange-500/30 bg-orange-950/40 text-orange-400">
            ارتباط
          </span>
          <h2 class="text-3xl sm:text-5xl font-black text-white mb-4">
            راه‌های ارتباط با من
          </h2>
          <p class="text-slate-400 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
            خوشحال می‌شوم برای پروژه‌های جدید، موقعیت‌های همکاری و مشاوره‌های فنی با من در ارتباط باشید.
          </p>
        </div>

        <!-- Large Centered Contact Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
          
          <!-- Location Card (Large) -->
          <div 
            @mousemove="handleCardSpotlight"
            class="card-spotlight p-8 rounded-3xl bg-slate-900/90 backdrop-blur-2xl border border-slate-800 hover:border-slate-700 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] flex items-center gap-6"
          >
            <div class="w-18 h-18 sm:w-20 sm:h-20 rounded-3xl bg-orange-950/50 border border-orange-500/30 flex items-center justify-center text-4xl sm:text-5xl shrink-0 shadow-lg shadow-orange-500/10">
              📍
            </div>
            <div>
              <span class="text-xs uppercase font-extrabold tracking-wider text-slate-500 block mb-1">
                موقعیت مکانی
              </span>
              <strong class="text-xl sm:text-2xl text-white font-black block mb-1">
                گرگان، ایران
              </strong>
              <p class="text-xs sm:text-sm text-slate-400">
                آماده همکاری حضوری و ریموت (Remote)
              </p>
            </div>
          </div>

          <!-- Telegram Card (Large & Clickable) -->
          <a 
            href="https://t.me/iliya_front" 
            target="_blank" 
            @mousemove="handleCardSpotlight"
            class="card-spotlight group p-8 rounded-3xl bg-slate-900/90 backdrop-blur-2xl border border-slate-800 hover:border-orange-500/60 shadow-xl hover:shadow-2xl hover:shadow-orange-500/10 transition-all duration-300 hover:scale-[1.02] flex items-center gap-6"
          >
            <div class="w-18 h-18 sm:w-20 sm:h-20 rounded-3xl bg-orange-950/50 border border-orange-500/30 group-hover:scale-110 group-hover:bg-gradient-to-tr group-hover:from-amber-500 group-hover:to-orange-500 group-hover:border-transparent flex items-center justify-center text-4xl sm:text-5xl shrink-0 shadow-lg shadow-orange-500/10 transition-all duration-300">
              ✈️
            </div>
            <div class="flex-1 min-w-0">
              <span class="text-xs uppercase font-extrabold tracking-wider text-slate-500 block mb-1">
                پیام‌رسان تلگرام
              </span>
              <strong class="text-xl sm:text-2xl text-white group-hover:text-orange-400 font-black block mb-1 truncate transition-colors">
                @iliya_front
              </strong>
              <span class="text-xs sm:text-sm text-orange-400/90 flex items-center gap-1 font-bold">
                <span>ارسال مستقیم پیام در تلگرام</span>
                <span class="group-hover:translate-x-1 transition-transform">↗</span>
              </span>
            </div>
          </a>

          <!-- Email Card (Large & Clickable) -->
          <a 
            href="mailto:iliya.pourzanjani@example.com" 
            @mousemove="handleCardSpotlight"
            class="card-spotlight group p-8 rounded-3xl bg-slate-900/90 backdrop-blur-2xl border border-slate-800 hover:border-orange-500/60 shadow-xl hover:shadow-2xl hover:shadow-orange-500/10 transition-all duration-300 hover:scale-[1.02] flex items-center gap-6"
          >
            <div class="w-18 h-18 sm:w-20 sm:h-20 rounded-3xl bg-orange-950/50 border border-orange-500/30 group-hover:scale-110 group-hover:bg-gradient-to-tr group-hover:from-amber-500 group-hover:to-orange-500 group-hover:border-transparent flex items-center justify-center text-4xl sm:text-5xl shrink-0 shadow-lg shadow-orange-500/10 transition-all duration-300">
              ✉️
            </div>
            <div class="flex-1 min-w-0">
              <span class="text-xs uppercase font-extrabold tracking-wider text-slate-500 block mb-1">
                آدرس ایمیل مستقیم
              </span>
              <strong class="text-base sm:text-lg text-white group-hover:text-orange-400 font-black font-mono block mb-1 truncate transition-colors">
                iliya.pourzanjani@example.com
              </strong>
              <span class="text-xs sm:text-sm text-orange-400/90 flex items-center gap-1 font-bold">
                <span>ارسال ایمیل مستقیم</span>
                <span class="group-hover:translate-x-1 transition-transform">↗</span>
              </span>
            </div>
          </a>

          <!-- Professional Profiles (GitHub & LinkedIn) -->
          <div 
            @mousemove="handleCardSpotlight"
            class="card-spotlight p-8 rounded-3xl bg-slate-900/90 backdrop-blur-2xl border border-slate-800 hover:border-slate-700 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] flex items-center gap-6"
          >
            <div class="w-18 h-18 sm:w-20 sm:h-20 rounded-3xl bg-orange-950/50 border border-orange-500/30 flex items-center justify-center text-4xl sm:text-5xl shrink-0 shadow-lg shadow-orange-500/10">
              💼
            </div>
            <div class="flex-1 min-w-0">
              <span class="text-xs uppercase font-extrabold tracking-wider text-slate-500 block mb-1">
                پروفایل‌های تخصصی
              </span>
              <strong class="text-xl sm:text-2xl text-white font-black block mb-2">
                شبکه‌های حرفه‌ای
              </strong>
              <div class="flex items-center gap-3">
                <a 
                  href="https://github.com" 
                  target="_blank" 
                  class="px-3.5 py-1.5 rounded-xl bg-slate-800 hover:bg-orange-500 hover:text-white text-slate-300 text-xs font-bold transition flex items-center gap-1.5"
                >
                  <span>🐙</span>
                  <span>گیت‌هاب</span>
                </a>
                <a 
                  href="https://linkedin.com" 
                  target="_blank" 
                  class="px-3.5 py-1.5 rounded-xl bg-slate-800 hover:bg-orange-500 hover:text-white text-slate-300 text-xs font-bold transition flex items-center gap-1.5"
                >
                  <span>💼</span>
                  <span>لینکدین</span>
                </a>
              </div>
            </div>
          </div>

        </div>

        <!-- Big Center CTA Button -->
        <div class="mt-12 text-center">
          <a 
            href="https://t.me/iliya_front" 
            target="_blank" 
            class="inline-flex items-center gap-3 px-10 py-5 rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-amber-500 hover:from-amber-400 hover:to-orange-400 text-white font-black text-base sm:text-lg shadow-xl shadow-orange-500/30 hover:scale-105 active:scale-95 transition-all duration-300"
          >
            <span>شروع گفتگو در تلگرام</span>
            <span class="text-xl">🚀</span>
          </a>
        </div>

      </div>
    </section>

    <!-- FOOTER -->
    <footer class="no-print py-12 border-t border-slate-800 text-center text-xs text-slate-400">
      <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2 font-black">
          <span class="text-xl text-orange-400">iliya</span>
          <span>• رزومه و پورتفولیو ایلیا پورزنجانی</span>
        </div>
        <div class="flex items-center gap-4 font-semibold">
          <router-link to="/admin" class="hover:text-orange-400 text-slate-500 hover:text-slate-300 transition flex items-center gap-1.5 text-[11px]" title="ورود به پیشخوان مدیریت پروژه‌ها">
            <span>🔐</span>
            <span>ورود مدیر</span>
          </router-link>
          <a href="#home" class="hover:text-white transition hover:scale-105">بازگشت به بالا ↑</a>
          <span>طراحی شده با Vue 3 + Tailwind CSS + Laravel</span>
        </div>
      </div>
    </footer>

    <!-- INTERACTIVE PROJECT MODAL WITH BROWSER FRAME -->
    <transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition duration-200 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div 
        v-if="activeModalProject" 
        class="fixed inset-0 z-50 bg-black/85 backdrop-blur-xl flex items-center justify-center p-4 overflow-y-auto"
        @click.self="activeModalProject = null"
      >
        <div class="bg-[#0B0F17] w-full max-w-2xl rounded-3xl shadow-2xl border border-slate-800 overflow-hidden my-8 transform transition-all duration-300 scale-100">
          
          <!-- FEATURE 3: Browser Chrome Bar on Modal -->
          <div class="px-5 py-3 bg-slate-950 border-b border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-2">
              <span class="w-3 h-3 rounded-full bg-rose-500"></span>
              <span class="w-3 h-3 rounded-full bg-amber-500"></span>
              <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
            </div>
            
            <div class="px-4 py-1 rounded-lg bg-slate-900 border border-slate-800 text-[11px] font-mono text-slate-400 flex items-center gap-2">
              <span class="text-emerald-400">🔒</span>
              <span class="dir-ltr">{{ activeModalProject.mockUrl }}</span>
            </div>

            <button 
              @click="activeModalProject = null" 
              class="w-7 h-7 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center text-sm transition"
            >
              ✕
            </button>
          </div>

          <!-- Modal Banner -->
          <div :class="['p-8 text-white relative overflow-hidden', activeModalProject.gradient]">
            <div class="relative z-10 flex items-start justify-between">
              <div class="flex items-center gap-4">
                <span class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-4xl shadow-lg">
                  {{ activeModalProject.icon }}
                </span>
                <div>
                  <span class="text-xs uppercase font-extrabold tracking-wider px-3 py-1 rounded-full bg-black/40 backdrop-blur-md text-white">
                    {{ activeModalProject.categoryLabel }}
                  </span>
                  <h3 class="text-2xl sm:text-3xl font-black mt-2">{{ activeModalProject.title }}</h3>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Body Content -->
          <div class="p-6 sm:p-8 space-y-6">
            
            <!-- Description -->
            <div>
              <h4 class="text-xs font-black uppercase tracking-wider text-slate-500 mb-2">
                توضیحات و اهداف پروژه
              </h4>
              <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                {{ activeModalProject.fullDesc }}
              </p>
            </div>

            <!-- Key Features -->
            <div v-if="activeModalProject.features && activeModalProject.features.length">
              <h4 class="text-xs font-black uppercase tracking-wider text-slate-500 mb-2.5">
                امکانات کلیدی پیاده‌سازی شده
              </h4>
              <ul class="space-y-2 text-xs sm:text-sm text-slate-300">
                <li v-for="(feat, fIdx) in activeModalProject.features" :key="fIdx" class="flex items-start gap-2.5">
                  <span class="font-bold text-base text-orange-400">✓</span>
                  <span>{{ feat }}</span>
                </li>
              </ul>
            </div>

            <!-- Tags -->
            <div>
              <h4 class="text-xs font-black uppercase tracking-wider text-slate-500 mb-2.5">
                تکنولوژی‌ها و ابزارها
              </h4>
              <div class="flex flex-wrap gap-2">
                <span 
                  v-for="(tech, tIdx) in activeModalProject.tags" 
                  :key="tIdx" 
                  class="px-3.5 py-1.5 rounded-xl bg-slate-800 text-slate-200 text-xs font-black"
                >
                  {{ tech }}
                </span>
              </div>
            </div>

            <!-- Action Buttons with Host Link Direct Callout -->
            <div class="pt-6 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3">
              <a 
                :href="activeModalProject.hostedUrl" 
                target="_blank" 
                class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-amber-500 hover:from-amber-400 hover:to-orange-400 text-white font-black text-xs sm:text-sm shadow-xl shadow-orange-500/25 hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2"
              >
                <span>مشاهده آنلاین در هاست</span>
                <span>🚀</span>
              </a>

              <div class="flex items-center gap-2.5 w-full sm:w-auto">
                <a 
                  v-if="activeModalProject.githubUrl" 
                  :href="activeModalProject.githubUrl" 
                  target="_blank" 
                  class="flex-1 sm:flex-initial px-5 py-4 rounded-2xl border border-slate-700 hover:bg-slate-800 text-slate-200 font-bold text-xs transition flex items-center justify-center gap-1.5 hover:scale-105 active:scale-95"
                >
                  <span>🐙</span>
                  <span>گیت‌هاب</span>
                </a>

                <button 
                  @click="activeModalProject = null" 
                  class="px-5 py-4 rounded-2xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold text-xs transition hover:scale-105 active:scale-95"
                >
                  بستن
                </button>
              </div>
            </div>

          </div>

        </div>
      </div>
    </transition>

  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const profileImage = '/images/iliya.jpg';
const locale = ref('fa');
const isScrolled = ref(false);
const scrollProgress = ref(0);
const isMobileMenuOpen = ref(false);
const activeSection = ref('home');
const selectedCategory = ref('all');
const activeModalProject = ref(null);

// FEATURE 1: Typewriter Effect
const currentTypedText = ref('');
const typewriterPhrases = [
  'متخصص Vue.js و ساخت کامپوننت‌های مدرن',
  'طراح رابط‌های کاربری واکنش‌گرا و تجربه کاربری تمیز',
  'توسعه‌دهنده فرانت‌اند با تمرکز بر پرفورمنس و سرعت',
  'مسلط به جاوااسکریپت مدرن، Tailwind CSS و API',
];
let phraseIndex = 0;
let charIndex = 0;
let isDeleting = false;
let typewriterTimeout = null;

const tickTypewriter = () => {
  const currentPhrase = typewriterPhrases[phraseIndex];

  if (!isDeleting) {
    currentTypedText.value = currentPhrase.substring(0, charIndex + 1);
    charIndex++;

    if (charIndex === currentPhrase.length) {
      isDeleting = true;
      typewriterTimeout = setTimeout(tickTypewriter, 2200);
      return;
    }
    typewriterTimeout = setTimeout(tickTypewriter, 80);
  } else {
    currentTypedText.value = currentPhrase.substring(0, charIndex - 1);
    charIndex--;

    if (charIndex === 0) {
      isDeleting = false;
      phraseIndex = (phraseIndex + 1) % typewriterPhrases.length;
      typewriterTimeout = setTimeout(tickTypewriter, 400);
      return;
    }
    typewriterTimeout = setTimeout(tickTypewriter, 40);
  }
};

// FEATURE 5: Card Spotlight Hover Effect
const handleCardSpotlight = (e) => {
  const rect = e.currentTarget.getBoundingClientRect();
  const x = e.clientX - rect.left;
  const y = e.clientY - rect.top;
  e.currentTarget.style.setProperty('--mouse-x', `${x}px`);
  e.currentTarget.style.setProperty('--mouse-y', `${y}px`);
};

// FEATURE 7: Core Principles List
const principlesList = [
  {
    icon: '⚡',
    title: 'سرعت و پرفورمنس',
    description: 'بهینه‌سازی حجم فایل‌ها و زمان رندر بدون هیچ‌گونه افت فریم یا تاخیر در لود.',
  },
  {
    icon: '📱',
    title: 'طراحی اول-موبایل',
    description: 'واکنش‌گرایی ۱۰۰٪ و تست پیکسلی در تمام ابعاد گوشی‌های هوشمند، تبلت و دسکتاپ.',
  },
  {
    icon: '🧼',
    title: 'کدنویسی تمیز',
    description: 'رعایت اصول Clean Code، ساختار استاندارد کامپوننت‌ها و قابلیت نگهداری بالا.',
  },
  {
    icon: '🤝',
    title: 'چابکی و کار تیمی',
    description: 'انعطاف‌پذیری بالا، روحیه یادگیری مداوم و مسئولیت‌پذیری در تحویل به موقع پروژه‌ها.',
  },
];

// FEATURE 6: Career & Learning Journey Timeline
const careerTimeline = [
  {
    period: 'شروع مسیر • پایه‌ریزی',
    title: 'مبانی و استانداردهای طراحی وب مدرن',
    description: 'تسلط عمیق بر HTML5 معنایی، مفاهیم پیشرفته CSS3، فلکس‌باکس، سی‌اس‌اس گرید و اصول پیاده‌سازی صفحات کاملاً واکنش‌گرا.',
    badges: ['HTML5', 'CSS3', 'Responsive Design', 'Flexbox & Grid'],
  },
  {
    period: 'گسترش تخصص • برنامه‌نویسی عمیق',
    title: 'جاوااسکریپت نوین و ارتباط با سرور',
    description: 'تسلط بر استاندارد ES6+، برنامه‌نویسی ناهمگام (Async/Await)، ارسال و دریافت داده از RESTful APIها و کار حرفه‌ای با Git & GitHub.',
    badges: ['JavaScript (ES6+)', 'REST APIs & Fetch', 'Git / GitHub', 'DOM Manipulation'],
  },
  {
    period: 'معماری اپلیکیشن • فریم‌ورک‌های روز',
    title: 'اکوسیستم Vue.js 3 و فریم‌ورک‌های طراحی',
    description: 'طراحی و پیاده‌سازی وب‌اپلیکیشن‌های تک‌صفحه‌ای (SPA) با Composition API، استایل‌نویسی پرسرعت با Tailwind CSS و بیلد با Vite.',
    badges: ['Vue 3 (Composition API)', 'Tailwind CSS', 'Vite', 'State Management'],
  },
  {
    period: 'وضعیت کنونی • آماده همکاری',
    title: 'آماده ورود به موقعیت‌های شغلی و چالش‌های تیمی',
    description: 'توسعه مینی‌پروژه‌های تعاملی، تمرکز بر بهینه‌سازی تجربه کاربری (UX) و مشتاق به پیوستن به تیم‌های فنی جهت رشد مستمر.',
    badges: ['Clean Code', 'Problem Solving', 'Available for Hire'],
  },
];

// Navigation Links
const navLinks = [
  { name: { fa: 'خانه', en: 'Home' }, href: '#home' },
  { name: { fa: 'درباره من', en: 'About Me' }, href: '#about' },
  { name: { fa: 'رزومه', en: 'Resume' }, href: '#resume' },
  { name: { fa: 'نمونه کار ها', en: 'Portfolio' }, href: '#projects' },
  { name: { fa: 'تماس با من', en: 'Contact' }, href: '#contact' },
];

// Skills matching exact user's resume
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

// 6 Mini Projects with mockUrls for Browser Frame (seeded fallback)
const miniProjects = ref([
  {
    id: 1,
    icon: '🛍️',
    title: 'فروشگاه آنلاین مینیمال (Mini E-Commerce)',
    category: 'webapps',
    categoryLabel: 'اپلیکیشن وب',
    mockUrl: 'https://iliya.dev/projects/mini-ecommerce',
    gradient: 'bg-gradient-to-br from-amber-600 via-orange-700 to-slate-900',
    shortDesc: 'فروشگاه محصولات مدرن با سبد خرید تعاملی، فیلتر دسته‌بندی و محاسبه لحظه‌ای فاکتور.',
    fullDesc: 'یک وب‌اپلیکیشن فروشگاهی کامل فرانت‌اند با طراحی واکنش‌گرا که به کاربر اجازه می‌دهد محصولات را جستجو کند، بر اساس دسته‌بندی فیلتر نماید، اقلام را به سبد خرید اضافه کرده و فاکتور نهایی را مشاهده کند.',
    features: [
      'سیستم مدیریت سبد خرید آنی و بدون نیاز به رفرش',
      'ذخیره خودکار وضعیت سبد در LocalStorage مرورگر',
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
    mockUrl: 'https://iliya.dev/projects/weather-app',
    gradient: 'bg-gradient-to-br from-orange-600 via-amber-700 to-slate-900',
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
    mockUrl: 'https://iliya.dev/projects/kanban-tasks',
    gradient: 'bg-gradient-to-br from-amber-700 via-yellow-800 to-slate-950',
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
    mockUrl: 'https://iliya.dev/projects/music-player',
    gradient: 'bg-gradient-to-br from-orange-500 via-amber-600 to-slate-900',
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
    mockUrl: 'https://iliya.dev/projects/smart-calculator',
    gradient: 'bg-gradient-to-br from-amber-600 via-orange-800 to-slate-950',
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
    mockUrl: 'https://iliya.dev/projects/memory-game',
    gradient: 'bg-gradient-to-br from-orange-600 via-amber-800 to-slate-950',
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
]);

const filteredMiniProjects = computed(() => {
  if (selectedCategory.value === 'all') {
    return miniProjects.value;
  }
  return miniProjects.value.filter(p => p.category === selectedCategory.value);
});

const fetchProjects = async () => {
  try {
    const res = await fetch('/api/projects', {
      headers: { 'Accept': 'application/json' },
    });
    if (res.ok) {
      const json = await res.json();
      const list = json.data || json;
      if (Array.isArray(list) && list.length > 0) {
        miniProjects.value = list;
      }
    }
  } catch (err) {
    console.error('Failed to fetch dynamic projects, using defaults:', err);
  }
};

const openProjectModal = (proj) => {
  activeModalProject.value = proj;
};

const handleScroll = () => {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  isScrolled.value = scrollTop > 20;

  // Scroll Progress Calculation
  const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  if (docHeight > 0) {
    scrollProgress.value = (scrollTop / docHeight) * 100;
  }

  // Active section tracker
  const sections = document.querySelectorAll('section[id]');
  sections.forEach(current => {
    const sectionHeight = current.offsetHeight;
    const sectionTop = current.offsetTop - 140;
    const sectionId = current.getAttribute('id');
    if (scrollTop > sectionTop && scrollTop <= sectionTop + sectionHeight) {
      activeSection.value = sectionId;
    }
  });
};

onMounted(() => {
  document.documentElement.classList.add('dark');
  window.addEventListener('scroll', handleScroll, { passive: true });
  tickTypewriter();
  fetchProjects();
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
  if (typewriterTimeout) {
    clearTimeout(typewriterTimeout);
  }
});
</script>
