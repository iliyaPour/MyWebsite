<template>
  <div v-if="project" :class="[isDark ? 'dark bg-slate-950 text-slate-100' : 'bg-slate-50 text-slate-800', 'min-h-screen transition-colors duration-300 font-sans']" :dir="locale === 'fa' ? 'rtl' : 'ltr'">
    
    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/80 dark:bg-slate-900/80 border-b border-slate-200 dark:border-slate-800 transition-colors">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
        
        <!-- Back to Resume Button -->
        <router-link 
          to="/" 
          class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-xs sm:text-sm font-semibold transition"
        >
          <span>{{ locale === 'fa' ? '← بازگشت به رزومه' : '← Back to Resume' }}</span>
        </router-link>

        <!-- Right Tools -->
        <div class="flex items-center gap-2 sm:gap-3">
          <!-- Language Toggle -->
          <button 
            @click="toggleLocale" 
            class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 transition flex items-center gap-1.5"
          >
            <span>🌐</span>
            <span>{{ locale === 'fa' ? 'English' : 'فارسی' }}</span>
          </button>

          <!-- Theme Toggle -->
          <button 
            @click="toggleTheme" 
            class="p-2 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 transition text-slate-600 dark:text-slate-300"
          >
            <span v-if="isDark">☀️</span>
            <span v-else>🌙</span>
          </button>

          <!-- Live Demo Link -->
          <a 
            :href="project.githubUrl" 
            target="_blank" 
            class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-xs shadow-sm transition"
          >
            <span>🐙</span>
            <span>GitHub</span>
          </a>
        </div>
      </div>
    </header>

    <!-- Project Landing Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-12 space-y-12">
      
      <!-- HERO SECTION -->
      <section class="rounded-3xl bg-gradient-to-br from-indigo-900 via-slate-900 to-slate-950 text-white p-6 sm:p-12 shadow-2xl relative overflow-hidden border border-slate-800">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-violet-500/20 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-3xl">
          <!-- Badge -->
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-semibold text-indigo-300 mb-6 backdrop-blur-sm">
            <span class="text-sm">{{ project.icon }}</span>
            <span>{{ project.badge[locale] }}</span>
          </div>

          <!-- Title -->
          <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
            {{ project.title[locale] }}
          </h1>

          <!-- Subtitle -->
          <p class="text-slate-300 text-sm sm:text-lg leading-relaxed mb-8">
            {{ project.subtitle[locale] }}
          </p>

          <!-- CTA Buttons -->
          <div class="flex flex-wrap items-center gap-3 sm:gap-4">
            <a 
              :href="project.githubUrl" 
              target="_blank" 
              class="px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs sm:text-sm shadow-lg shadow-indigo-600/30 transition flex items-center gap-2"
            >
              <span>🐙</span>
              <span>{{ locale === 'fa' ? 'مشاهده سورس کد در گیت‌هاب' : 'View Code on GitHub' }}</span>
            </a>

            <router-link 
              to="/" 
              class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-medium text-xs sm:text-sm border border-white/20 backdrop-blur-sm transition flex items-center gap-2"
            >
              <span>📄</span>
              <span>{{ locale === 'fa' ? 'سایر تجربیات در رزومه' : 'Other Portfolio Works' }}</span>
            </router-link>
          </div>
        </div>

        <!-- Metric Counters Bar -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-12 pt-8 border-t border-white/10 relative z-10">
          <div v-for="(stat, sIdx) in project.stats" :key="sIdx" class="p-3 rounded-2xl bg-white/5 border border-white/10 text-center">
            <span class="block text-2xl sm:text-3xl font-extrabold text-indigo-300">{{ stat.value }}</span>
            <span class="text-xs text-slate-300 mt-1 block">{{ stat.label[locale] }}</span>
          </div>
        </div>
      </section>

      <!-- OVERVIEW & ARCHITECTURE SHOWCASE -->
      <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Overview & Challenge (2 cols) -->
        <div class="lg:col-span-2 space-y-8">
          
          <!-- About the Project -->
          <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 sm:p-8 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
              <span>🎯</span>
              <span>{{ locale === 'fa' ? 'اهداف و معماری پروژه' : 'Project Architecture & Goals' }}</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm sm:text-base">
              {{ project.overview[locale] }}
            </p>
          </div>

          <!-- Key Features Grid -->
          <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 sm:p-8 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
              <span>✨</span>
              <span>{{ locale === 'fa' ? 'قابلیت‌های کلیدی سیستم' : 'Key Engineering Features' }}</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div 
                v-for="(feat, fIdx) in project.features" 
                :key="fIdx"
                class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800"
              >
                <span class="text-2xl mb-2 block">{{ feat.icon }}</span>
                <h3 class="font-bold text-slate-900 dark:text-white text-sm mb-1">
                  {{ feat.title[locale] }}
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                  {{ feat.description[locale] }}
                </p>
              </div>
            </div>
          </div>

          <!-- Problem Solving / Engineering Challenges -->
          <div class="rounded-3xl bg-amber-500/10 border border-amber-500/20 p-6 sm:p-8 text-amber-950 dark:text-amber-200">
            <div class="flex items-center gap-2 mb-3">
              <span class="text-2xl">💡</span>
              <h3 class="font-bold text-base sm:text-lg">
                {{ locale === 'fa' ? 'چالش مهندسی و راهکار پیاده‌سازی شده' : 'Technical Challenge & Solution' }}
              </h3>
            </div>
            <p class="text-xs sm:text-sm leading-relaxed text-amber-900 dark:text-amber-300">
              {{ project.challenges[locale] }}
            </p>
          </div>

        </div>

        <!-- Right: Tech Stack & Details (1 col) -->
        <div class="space-y-8">
          
          <!-- Tech Stack Breakdown -->
          <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
              <span>🛠️</span>
              <span>{{ locale === 'fa' ? 'تکنولوژی‌های استفاده شده' : 'Tech Stack Breakdown' }}</span>
            </h2>

            <div class="space-y-3">
              <div 
                v-for="(tech, tIdx) in project.techStack" 
                :key="tIdx"
                class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800"
              >
                <span class="text-xs font-bold text-slate-900 dark:text-white">{{ tech.name }}</span>
                <span class="text-[11px] text-slate-500 dark:text-slate-400">{{ tech.role }}</span>
              </div>
            </div>
          </div>

          <!-- Other Projects Quick Switcher -->
          <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
              <span>📂</span>
              <span>{{ locale === 'fa' ? 'سایر پروژه‌ها' : 'Other Projects' }}</span>
            </h2>

            <div class="space-y-2.5">
              <router-link 
                v-for="other in otherProjects" 
                :key="other.slug"
                :to="'/projects/' + other.slug"
                class="flex items-center gap-3 p-3 rounded-2xl hover:bg-slate-100 dark:hover:bg-slate-800 transition border border-transparent hover:border-slate-200 dark:hover:border-slate-700"
              >
                <span class="text-xl">{{ other.icon }}</span>
                <div class="flex-1 min-w-0">
                  <span class="font-bold text-xs text-slate-900 dark:text-white block truncate">{{ other.title[locale] }}</span>
                  <span class="text-[10px] text-slate-500 dark:text-slate-400 block">{{ other.badge[locale] }}</span>
                </div>
                <span class="text-xs text-indigo-500">→</span>
              </router-link>
            </div>
          </div>

        </div>

      </section>

      <!-- BOTTOM CALL TO ACTION -->
      <section class="rounded-3xl bg-gradient-to-r from-indigo-600 to-violet-600 text-white p-6 sm:p-10 text-center shadow-xl">
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-3">
          {{ locale === 'fa' ? 'علاقه‌مند به همکاری در پروژه‌ای مشابه هستید؟' : 'Interested in building something similar?' }}
        </h2>
        <p class="text-indigo-100 text-xs sm:text-sm max-w-2xl mx-auto mb-6">
          {{ locale === 'fa' ? 'می‌توانید اطلاعات تماس و راه‌های ارتباطی را در صفحه اصلی رزومه مشاهده نمایید.' : 'Check out full contact details and experience on my primary resume page.' }}
        </p>

        <router-link 
          to="/" 
          class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-indigo-600 font-bold text-xs sm:text-sm shadow-md hover:bg-indigo-50 transition"
        >
          <span>👤</span>
          <span>{{ locale === 'fa' ? 'مشاهده کامل رزومه من' : 'View Full Resume' }}</span>
        </router-link>
      </section>

    </main>

    <!-- Footer -->
    <footer class="mt-12 py-8 border-t border-slate-200 dark:border-slate-800 text-center text-xs text-slate-500 dark:text-slate-400">
      <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
        <router-link to="/" class="hover:underline">
          {{ locale === 'fa' ? '← بازگشت به صفحه اصلی' : '← Return to Main Page' }}
        </router-link>
        <span>Laravel 13 • Vue 3 • Portfolio Showcase</span>
      </div>
    </footer>

  </div>

  <!-- 404 Project Not Found -->
  <div v-else class="min-h-screen flex items-center justify-center p-6 text-center" :dir="locale === 'fa' ? 'rtl' : 'ltr'">
    <div>
      <span class="text-5xl block mb-4">🔍</span>
      <h1 class="text-2xl font-bold mb-2">{{ locale === 'fa' ? 'پروژه مورد نظر یافت نشد' : 'Project Not Found' }}</h1>
      <router-link to="/" class="mt-4 inline-block px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm font-semibold">
        {{ locale === 'fa' ? 'بازگشت به رزومه' : 'Back to Resume' }}
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';
import { projectsData } from './projectsData';

const route = useRoute();
const locale = ref('fa');
const isDark = ref(false);

const project = computed(() => {
  const slug = route.params.slug;
  return projectsData.find(p => p.slug === slug);
});

const otherProjects = computed(() => {
  return projectsData.filter(p => p.slug !== route.params.slug);
});

const toggleLocale = () => {
  locale.value = locale.value === 'fa' ? 'en' : 'fa';
};

const toggleTheme = () => {
  isDark.value = !isDark.value;
  if (isDark.value) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
};
</script>
