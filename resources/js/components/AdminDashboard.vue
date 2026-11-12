<template>
  <div class="min-h-screen bg-slate-950 text-slate-100 font-sans selection:bg-orange-500/30 selection:text-orange-200 relative overflow-x-hidden antialiased dir-rtl" dir="rtl">
    <!-- Ambient Background Glows -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
      <div class="absolute -top-40 right-1/4 w-[600px] h-[600px] bg-orange-600/10 rounded-full blur-3xl"></div>
      <div class="absolute bottom-10 left-10 w-[500px] h-[500px] bg-amber-600/10 rounded-full blur-3xl"></div>
      <div class="absolute inset-0 bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:28px_28px] opacity-25"></div>
    </div>

    <!-- Notification Toast -->
    <transition
      enter-active-class="transform ease-out duration-300 transition"
      enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
      enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
      leave-active-class="transition ease-in duration-200"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="toast.show"
        :class="toast.type === 'error' ? 'border-red-500/60 bg-red-950/90 text-red-200' : 'border-orange-500/60 bg-slate-900/95 text-orange-200'"
        class="fixed top-6 left-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-2xl border shadow-2xl backdrop-blur-xl max-w-md"
      >
        <span class="text-xl">{{ toast.type === 'error' ? '⚠️' : '✨' }}</span>
        <span class="text-sm font-medium">{{ toast.message }}</span>
        <button @click="toast.show = false" class="mr-auto text-slate-400 hover:text-white p-1">
          ✕
        </button>
      </div>
    </transition>

    <!-- Content Container -->
    <div class="relative z-10">

      <!-- ============================================== -->
      <!-- VIEW 1: LOGIN CARD (When not authenticated) -->
      <!-- ============================================== -->
      <div v-if="!isAuthenticated && !isCheckingAuth" class="min-h-screen flex items-center justify-center p-4 sm:p-6">
        <div class="w-full max-w-md bg-slate-900/90 border border-slate-800 rounded-3xl p-8 sm:p-10 shadow-2xl backdrop-blur-xl relative overflow-hidden">
          <!-- Subtle Accent Light -->
          <div class="absolute top-0 right-0 left-0 h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent"></div>

          <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center text-3xl mx-auto mb-4 shadow-inner">
              🔐
            </div>
            <h1 class="text-2xl font-black text-white mb-2">پیشخوان مدیریت ایلیا</h1>
            <p class="text-slate-400 text-sm">لطفاً برای مدیریت پروژه‌ها رمز عبور مدیر را وارد کنید.</p>
          </div>

          <form @submit.prevent="handleLogin" class="space-y-5">
            <div>
              <label class="block text-xs font-semibold text-slate-300 mb-2">رمز عبور پیشخوان</label>
              <div class="relative">
                <input
                  v-model="loginPassword"
                  :type="showPassword ? 'text' : 'password'"
                  placeholder="رمز عبور مدیر را وارد کنید..."
                  required
                  autofocus
                  class="w-full bg-slate-950/80 border border-slate-800 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-white rounded-xl px-4 py-3.5 text-sm transition-all duration-200 outline-none pr-4 pl-10"
                />
                <button
                  type="button"
                  @click="showPassword = !showPassword"
                  class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-200 text-xs px-1"
                >
                  {{ showPassword ? 'مخفی' : 'نمایش' }}
                </button>
              </div>
            </div>

            <div v-if="loginError" class="p-3 bg-red-950/60 border border-red-800/60 rounded-xl text-red-300 text-xs flex items-center gap-2">
              <span>⚠️</span>
              <span>{{ loginError }}</span>
            </div>

            <button
              type="submit"
              :disabled="isSubmittingLogin"
              class="w-full py-3.5 px-6 rounded-xl font-bold text-slate-950 bg-gradient-to-r from-orange-400 via-amber-500 to-orange-500 hover:from-orange-300 hover:to-amber-400 transition-all duration-300 shadow-lg shadow-orange-500/20 hover:shadow-orange-500/40 active:scale-[0.98] disabled:opacity-50 flex items-center justify-center gap-2 cursor-pointer"
            >
              <svg v-if="isSubmittingLogin" class="animate-spin h-5 w-5 text-slate-950" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
              </svg>
              <span>{{ isSubmittingLogin ? 'در حال ورود...' : 'ورود به پنل' }}</span>
            </button>
          </form>

          <div class="mt-8 pt-6 border-t border-slate-800/80 text-center">
            <router-link
              to="/"
              class="inline-flex items-center gap-2 text-xs font-medium text-slate-400 hover:text-orange-400 transition-colors"
            >
              <span>←</span>
              <span>بازگشت به صفحه اصلی رزومه</span>
            </router-link>
          </div>
        </div>
      </div>

      <!-- ============================================== -->
      <!-- VIEW 2: LOADING INITIAL AUTH CHECK -->
      <!-- ============================================== -->
      <div v-else-if="isCheckingAuth" class="min-h-screen flex flex-col items-center justify-center p-6 text-center">
        <div class="w-12 h-12 border-3 border-orange-500 border-t-transparent rounded-full animate-spin mb-4"></div>
        <p class="text-slate-400 text-sm">در حال بررسی احراز هویت...</p>
      </div>

      <!-- ============================================== -->
      <!-- VIEW 3: AUTHENTICATED ADMIN DASHBOARD -->
      <!-- ============================================== -->
      <div v-else class="min-h-screen pb-20">
        <!-- Top Navigation Bar -->
        <header class="sticky top-0 z-30 bg-slate-950/85 backdrop-blur-xl border-b border-slate-800/80 px-4 sm:px-8 py-4">
          <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <!-- Brand / Title -->
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center text-xl">
                ⚡
              </div>
              <div>
                <h1 class="text-base sm:text-lg font-black text-white flex items-center gap-2">
                  <span>مدیریت پروژه‌ها</span>
                  <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-orange-500/20 text-orange-400 border border-orange-500/30">مدیر</span>
                </h1>
                <p class="text-xs text-slate-400 hidden sm:block">پیشخوان اختصاصی افزودن و حذف پروژه‌های وب‌سایت</p>
              </div>
            </div>

            <!-- Actions Header -->
            <div class="flex items-center gap-2 sm:gap-3">
              <router-link
                to="/"
                target="_blank"
                class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:border-slate-700 transition-all flex items-center gap-1.5"
                title="مشاهده سایت در تب جدید"
              >
                <span>مشاهده سایت</span>
                <span class="text-xs">↗</span>
              </router-link>

              <button
                @click="openCreateModal"
                class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-950 bg-gradient-to-r from-orange-400 to-amber-500 hover:from-orange-300 hover:to-amber-400 transition-all shadow-md shadow-orange-500/20 flex items-center gap-1.5 cursor-pointer"
              >
                <span class="text-base font-bold">+</span>
                <span>افزودن پروژه جدید</span>
              </button>

              <button
                @click="handleLogout"
                class="px-3 py-2 rounded-xl text-xs font-semibold bg-slate-900/60 border border-slate-800 text-red-400 hover:bg-red-950/30 hover:border-red-800/60 transition-all cursor-pointer"
                title="خروج از حساب مدیر"
              >
                خروج
              </button>
            </div>
          </div>
        </header>

        <!-- Main Body -->
        <main class="max-w-7xl mx-auto px-4 sm:px-8 pt-8">
          <!-- Overview Stats -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-slate-900/70 border border-slate-800 rounded-2xl p-5 backdrop-blur-md">
              <div class="text-slate-400 text-xs font-medium mb-1">تعداد کل پروژه‌ها</div>
              <div class="text-3xl font-black text-white flex items-baseline gap-2">
                <span>{{ projects.length }}</span>
                <span class="text-xs text-orange-400 font-normal">پروژه فعال</span>
              </div>
            </div>

            <div class="bg-slate-900/70 border border-slate-800 rounded-2xl p-5 backdrop-blur-md">
              <div class="text-slate-400 text-xs font-medium mb-1">دسته‌بندی‌ها</div>
              <div class="flex items-center gap-2 mt-2 flex-wrap">
                <span class="text-xs px-2.5 py-1 rounded-lg bg-orange-500/10 text-orange-300 border border-orange-500/20">
                  وب‌اپ ({{ countByCategory('webapps') }})
                </span>
                <span class="text-xs px-2.5 py-1 rounded-lg bg-amber-500/10 text-amber-300 border border-amber-500/20">
                  جاوااسکریپت ({{ countByCategory('js') }})
                </span>
                <span class="text-xs px-2.5 py-1 rounded-lg bg-slate-800 text-slate-300 border border-slate-700">
                  مینی پروژه‌ها ({{ countByCategory('mini') }})
                </span>
              </div>
            </div>

            <div class="bg-slate-900/70 border border-slate-800 rounded-2xl p-5 backdrop-blur-md flex flex-col justify-between">
              <div class="text-slate-400 text-xs font-medium mb-1">وضعیت دیتابیس</div>
              <div class="flex items-center justify-between text-xs text-emerald-400 font-semibold mt-2">
                <span class="flex items-center gap-2">
                  <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                  همگام با دیتابیس زنده
                </span>
                <button @click="fetchProjects" class="text-slate-400 hover:text-orange-400 text-xs underline cursor-pointer">
                  رفرش لیست
                </button>
              </div>
            </div>
          </div>

          <!-- Filter & Search Bar -->
          <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-2 w-full sm:w-auto overflow-x-auto pb-1">
              <button
                v-for="cat in categories"
                :key="cat.id"
                @click="selectedCategory = cat.id"
                :class="selectedCategory === cat.id ? 'bg-orange-500 text-slate-950 font-bold shadow-md shadow-orange-500/20' : 'bg-slate-900 text-slate-400 hover:text-white border border-slate-800'"
                class="px-4 py-2 rounded-xl text-xs transition-all whitespace-nowrap cursor-pointer"
              >
                {{ cat.name }}
              </button>
            </div>

            <div class="relative w-full sm:w-72">
              <input
                v-model="searchQuery"
                type="text"
                placeholder="جستجو در پروژه‌ها..."
                class="w-full bg-slate-900 border border-slate-800 focus:border-orange-500 text-white rounded-xl px-4 py-2 text-xs outline-none transition-all"
              />
              <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs">🔍</span>
            </div>
          </div>

          <!-- Projects Grid -->
          <div v-if="isLoadingProjects" class="py-20 text-center">
            <div class="w-10 h-10 border-2 border-orange-500 border-t-transparent rounded-full animate-spin mx-auto mb-3"></div>
            <p class="text-xs text-slate-400">در حال دریافت پروژه‌ها...</p>
          </div>

          <div v-else-if="filteredProjects.length === 0" class="py-20 text-center bg-slate-900/40 border border-slate-800/80 rounded-3xl p-8">
            <div class="text-4xl mb-3">📂</div>
            <h3 class="text-base font-bold text-white mb-1">پروژه‌ای یافت نشد</h3>
            <p class="text-xs text-slate-400 mb-6">هیچ پروژه‌ای با این مشخصات وجود ندارد یا هنوز پروژه‌ای ثبت نکرده‌اید.</p>
            <button
              @click="openCreateModal"
              class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-950 bg-orange-500 hover:bg-orange-400 transition-all cursor-pointer"
            >
              افزودن اولین پروژه
            </button>
          </div>

          <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
              v-for="project in filteredProjects"
              :key="project.id"
              class="group bg-slate-900 border border-slate-800 hover:border-orange-500/50 rounded-3xl p-6 transition-all duration-300 flex flex-col justify-between shadow-lg relative overflow-hidden"
            >
              <!-- Card Top Decoration -->
              <div class="absolute top-0 right-0 left-0 h-1 bg-gradient-to-r from-orange-500/40 via-amber-500/20 to-transparent"></div>

              <div>
                <!-- Header: Icon & Category & Action menu -->
                <div class="flex items-center justify-between gap-3 mb-4">
                  <div class="flex items-center gap-3">
                    <span class="text-3xl p-2.5 bg-slate-950 rounded-2xl border border-slate-800/80 shadow-inner">
                      {{ project.icon || '🚀' }}
                    </span>
                    <div>
                      <span class="text-[11px] font-semibold text-orange-400 px-2 py-0.5 rounded-md bg-orange-500/10 border border-orange-500/20">
                        {{ project.categoryLabel || project.category }}
                      </span>
                    </div>
                  </div>

                  <div class="flex items-center gap-1.5">
                    <button
                      @click="openEditModal(project)"
                      class="p-2 rounded-xl bg-slate-800/80 hover:bg-orange-500/20 hover:text-orange-300 text-slate-400 transition-colors text-xs cursor-pointer"
                      title="ویرایش پروژه"
                    >
                      ✏️
                    </button>
                    <button
                      @click="confirmDelete(project)"
                      class="p-2 rounded-xl bg-slate-800/80 hover:bg-red-500/20 hover:text-red-400 text-slate-400 transition-colors text-xs cursor-pointer"
                      title="حذف پروژه"
                    >
                      🗑️
                    </button>
                  </div>
                </div>

                <!-- Title & Description -->
                <h3 class="text-base font-bold text-white mb-2 group-hover:text-orange-400 transition-colors line-clamp-1">
                  {{ project.title }}
                </h3>
                <p class="text-xs text-slate-400 leading-relaxed mb-4 line-clamp-2">
                  {{ project.shortDesc || 'بدون توضیحات کوتاه' }}
                </p>

                <!-- Tags -->
                <div class="flex flex-wrap gap-1.5 mb-6">
                  <span
                    v-for="(tag, tIdx) in (project.tags || []).slice(0, 4)"
                    :key="tIdx"
                    class="text-[10px] px-2 py-0.5 rounded-md bg-slate-950 text-slate-400 border border-slate-800"
                  >
                    #{{ tag }}
                  </span>
                  <span v-if="(project.tags || []).length > 4" class="text-[10px] text-slate-500 self-center">
                    +{{ project.tags.length - 4 }}
                  </span>
                </div>
              </div>

              <!-- Footer Links -->
              <div class="pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs">
                <a
                  v-if="project.hostedUrl"
                  :href="project.hostedUrl"
                  target="_blank"
                  class="text-orange-400 hover:text-orange-300 font-medium flex items-center gap-1 transition-colors"
                >
                  <span>دموی آنلاین</span>
                  <span>↗</span>
                </a>
                <span v-else class="text-slate-600 text-[11px]">بدون لینک دمو</span>

                <a
                  v-if="project.githubUrl"
                  :href="project.githubUrl"
                  target="_blank"
                  class="text-slate-400 hover:text-white transition-colors flex items-center gap-1"
                >
                  <span>گیت‌هاب</span>
                  <span>↗</span>
                </a>
                <span v-else class="text-slate-600 text-[11px]">بدون ریپازیتوری</span>
              </div>
            </div>
          </div>
        </main>

        <!-- ============================================== -->
        <!-- MODAL: ADD / EDIT PROJECT -->
        <!-- ============================================== -->
        <transition
          enter-active-class="transition duration-300 ease-out"
          enter-from-class="opacity-0 scale-95"
          enter-to-class="opacity-100 scale-100"
          leave-active-class="transition duration-200 ease-in"
          leave-from-class="opacity-100 scale-100"
          leave-to-class="opacity-0 scale-95"
        >
          <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto bg-slate-950/80 backdrop-blur-md">
            <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-2xl overflow-hidden shadow-2xl my-8 relative flex flex-col max-h-[90vh]">
              <!-- Modal Header -->
              <div class="px-6 py-5 border-b border-slate-800/80 flex items-center justify-between bg-slate-950/50">
                <div class="flex items-center gap-2">
                  <span class="text-xl">{{ isEditing ? '✏️' : '✨' }}</span>
                  <h3 class="text-base font-bold text-white">
                    {{ isEditing ? 'ویرایش پروژه' : 'افزودن پروژه جدید' }}
                  </h3>
                </div>
                <button
                  @click="closeModal"
                  class="w-8 h-8 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white flex items-center justify-center transition-colors cursor-pointer"
                >
                  ✕
                </button>
              </div>

              <!-- Modal Form Body -->
              <form @submit.prevent="saveProject" class="p-6 overflow-y-auto space-y-5 text-xs">
                <!-- Title & Icon -->
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                  <div class="sm:col-span-3">
                    <label class="block font-semibold text-slate-300 mb-1.5">عنوان پروژه <span class="text-orange-500">*</span></label>
                    <input
                      v-model="form.title"
                      type="text"
                      placeholder="مثال: فروشگاه اینترنتی مدرن"
                      required
                      class="w-full bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl px-3.5 py-2.5 text-white outline-none"
                    />
                  </div>
                  <div>
                    <label class="block font-semibold text-slate-300 mb-1.5">آیکون اموجی</label>
                    <div class="flex items-center gap-2">
                      <input
                        v-model="form.icon"
                        type="text"
                        maxlength="4"
                        placeholder="🛍️"
                        class="w-full text-center text-lg bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl py-2 text-white outline-none"
                      />
                    </div>
                  </div>
                </div>

                <!-- Quick Emoji Suggestions -->
                <div class="flex items-center gap-2 flex-wrap text-sm">
                  <span class="text-[11px] text-slate-500">انتخاب سریع آیکون:</span>
                  <button
                    v-for="e in ['🚀', '💻', '🛍️', '🎨', '🌤️', '📋', '🎵', '🔢', '🧠', '⚙️', '📱', '📊']"
                    :key="e"
                    type="button"
                    @click="form.icon = e"
                    class="p-1.5 rounded-lg bg-slate-950 hover:bg-orange-500/20 border border-slate-800 transition-colors cursor-pointer"
                  >
                    {{ e }}
                  </button>
                </div>

                <!-- Category & Label -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block font-semibold text-slate-300 mb-1.5">دسته‌بندی <span class="text-orange-500">*</span></label>
                    <select
                      v-model="form.category"
                      @change="handleCategoryChange"
                      class="w-full bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl px-3.5 py-2.5 text-white outline-none"
                    >
                      <option value="webapps">اپلیکیشن وب (webapps)</option>
                      <option value="js">جاوااسکریپت & API (js)</option>
                      <option value="mini">مینی پروژه (mini)</option>
                    </select>
                  </div>
                  <div>
                    <label class="block font-semibold text-slate-300 mb-1.5">برچسب نمایشی دسته‌بندی</label>
                    <input
                      v-model="form.categoryLabel"
                      type="text"
                      placeholder="مثال: اپلیکیشن وب"
                      class="w-full bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl px-3.5 py-2.5 text-white outline-none"
                    />
                  </div>
                </div>

                <!-- Short Description -->
                <div>
                  <label class="block font-semibold text-slate-300 mb-1.5">توضیح کوتاه کارت (Short Description) <span class="text-orange-500">*</span></label>
                  <textarea
                    v-model="form.shortDesc"
                    rows="2"
                    placeholder="یک یا دو جمله برای معرفی مختصر در کارت پروژه..."
                    required
                    class="w-full bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl px-3.5 py-2.5 text-white outline-none resize-none"
                  ></textarea>
                </div>

                <!-- Full Description -->
                <div>
                  <label class="block font-semibold text-slate-300 mb-1.5">توضیحات کامل (نمایش داخل مودال جزئیات)</label>
                  <textarea
                    v-model="form.fullDesc"
                    rows="3"
                    placeholder="توضیحات جامع درباره نحوه کار، چالش‌ها و پیاده‌سازی پروژه..."
                    class="w-full bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl px-3.5 py-2.5 text-white outline-none"
                  ></textarea>
                </div>

                <!-- URLs: Hosted & Github -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block font-semibold text-slate-300 mb-1.5">آدرس دموی آنلاین (Hosted URL)</label>
                    <input
                      v-model="form.hostedUrl"
                      type="url"
                      placeholder="https://example.com/demo"
                      class="w-full bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl px-3.5 py-2.5 text-white outline-none ltr text-left"
                    />
                  </div>
                  <div>
                    <label class="block font-semibold text-slate-300 mb-1.5">آدرس گیت‌هاب (Github URL)</label>
                    <input
                      v-model="form.githubUrl"
                      type="url"
                      placeholder="https://github.com/iliya/repo"
                      class="w-full bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl px-3.5 py-2.5 text-white outline-none ltr text-left"
                    />
                  </div>
                </div>

                <!-- Tags (Comma Separated) -->
                <div>
                  <label class="block font-semibold text-slate-300 mb-1.5">تگ‌ها و مهارت‌های استفاده‌شده (با ویرگول یا کاما جدا کنید)</label>
                  <input
                    v-model="form.tagsInput"
                    type="text"
                    placeholder="Vue.js, Tailwind, JavaScript, REST API"
                    class="w-full bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl px-3.5 py-2.5 text-white outline-none"
                  />
                </div>

                <!-- Key Features (One per line) -->
                <div>
                  <label class="block font-semibold text-slate-300 mb-1.5">ویژگی‌ها و قابلیت‌های کلیدی (هر سطر یک ویژگی)</label>
                  <textarea
                    v-model="form.featuresInput"
                    rows="3"
                    placeholder="پشتیبانی از جستجوی سریع
پاسخ‌گویی کامل روی موبایل
ارتباط با API"
                    class="w-full bg-slate-950 border border-slate-800 focus:border-orange-500 rounded-xl px-3.5 py-2.5 text-white outline-none"
                  ></textarea>
                </div>

                <!-- Error notice if any -->
                <div v-if="modalError" class="p-3 bg-red-950/60 border border-red-800/60 rounded-xl text-red-300 text-xs">
                  {{ modalError }}
                </div>

                <!-- Form Action Buttons -->
                <div class="pt-4 border-t border-slate-800/80 flex items-center justify-end gap-3">
                  <button
                    type="button"
                    @click="closeModal"
                    class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 transition-colors cursor-pointer"
                  >
                    انصراف
                  </button>
                  <button
                    type="submit"
                    :disabled="isSavingProject"
                    class="px-6 py-2.5 rounded-xl font-bold text-slate-950 bg-gradient-to-r from-orange-400 to-amber-500 hover:from-orange-300 hover:to-amber-400 transition-all shadow-md shadow-orange-500/20 disabled:opacity-50 flex items-center gap-2 cursor-pointer"
                  >
                    <svg v-if="isSavingProject" class="animate-spin h-4 w-4 text-slate-950" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>{{ isSavingProject ? 'در حال ذخیره...' : (isEditing ? 'بروزرسانی پروژه' : 'افزودن به سایت') }}</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </transition>

        <!-- ============================================== -->
        <!-- MODAL: CONFIRM DELETE -->
        <!-- ============================================== -->
        <transition
          enter-active-class="transition duration-200 ease-out"
          enter-from-class="opacity-0 scale-95"
          enter-to-class="opacity-100 scale-100"
          leave-active-class="transition duration-150 ease-in"
          leave-from-class="opacity-100 scale-100"
          leave-to-class="opacity-0 scale-95"
        >
          <div v-if="deleteModal.show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md">
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 w-full max-w-md shadow-2xl relative">
              <div class="text-center mb-5">
                <div class="w-14 h-14 rounded-2xl bg-red-500/10 border border-red-500/30 flex items-center justify-center text-2xl mx-auto mb-3">
                  🗑️
                </div>
                <h3 class="text-base font-bold text-white mb-1">حذف دائمی پروژه</h3>
                <p class="text-xs text-slate-400">
                  آیا از حذف پروژه <strong class="text-orange-400">«{{ deleteModal.project?.title }}»</strong> اطمینان دارید؟ این عمل غیرقابل بازگشت است.
                </p>
              </div>

              <div class="flex items-center justify-center gap-3">
                <button
                  type="button"
                  @click="deleteModal.show = false"
                  class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold transition-colors cursor-pointer"
                >
                  انصراف
                </button>
                <button
                  type="button"
                  @click="executeDelete"
                  :disabled="deleteModal.isDeleting"
                  class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-bold shadow-lg shadow-red-600/30 transition-all disabled:opacity-50 flex items-center gap-2 cursor-pointer"
                >
                  <svg v-if="deleteModal.isDeleting" class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                  </svg>
                  <span>{{ deleteModal.isDeleting ? 'در حال حذف...' : 'بله، حذف کن' }}</span>
                </button>
              </div>
            </div>
          </div>
        </transition>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

// CSRF helper
const getCsrfToken = () => {
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
};

// State
const isAuthenticated = ref(false);
const isCheckingAuth = ref(true);
const loginPassword = ref('');
const showPassword = ref(false);
const isSubmittingLogin = ref(false);
const loginError = ref('');

const projects = ref([]);
const isLoadingProjects = ref(false);
const searchQuery = ref('');
const selectedCategory = ref('all');

const categories = [
  { id: 'all', name: 'همه پروژه‌ها' },
  { id: 'webapps', name: 'اپلیکیشن وب' },
  { id: 'js', name: 'جاوااسکریپت & API' },
  { id: 'mini', name: 'مینی پروژه‌ها' },
];

// Toast notification
const toast = ref({
  show: false,
  message: '',
  type: 'success',
});

const showToast = (message, type = 'success') => {
  toast.value = { show: true, message, type };
  setTimeout(() => {
    toast.value.show = false;
  }, 4000);
};

// Modal State
const showModal = ref(false);
const isEditing = ref(false);
const isSavingProject = ref(false);
const modalError = ref('');

const form = ref({
  id: null,
  title: '',
  category: 'webapps',
  categoryLabel: 'اپلیکیشن وب',
  icon: '🚀',
  shortDesc: '',
  fullDesc: '',
  hostedUrl: '',
  githubUrl: '',
  tagsInput: '',
  featuresInput: '',
});

// Delete Modal State
const deleteModal = ref({
  show: false,
  project: null,
  isDeleting: false,
});

// Filtered Projects
const filteredProjects = computed(() => {
  return projects.value.filter((p) => {
    const matchesCategory = selectedCategory.value === 'all' || p.category === selectedCategory.value;
    const query = searchQuery.value.trim().toLowerCase();
    const matchesQuery = !query || 
      p.title?.toLowerCase().includes(query) || 
      p.shortDesc?.toLowerCase().includes(query) || 
      (p.tags || []).some(t => t.toLowerCase().includes(query));
    return matchesCategory && matchesQuery;
  });
});

const countByCategory = (cat) => {
  return projects.value.filter(p => p.category === cat).length;
};

// Auth Checking
const checkAuth = async () => {
  isCheckingAuth.value = true;
  try {
    const res = await fetch('/api/admin/check', {
      headers: {
        'Accept': 'application/json',
      },
      credentials: 'same-origin',
    });
    if (res.ok) {
      const data = await res.json();
      isAuthenticated.value = !!data.authenticated;
      if (isAuthenticated.value) {
        fetchProjects();
      }
    } else {
      isAuthenticated.value = false;
    }
  } catch (err) {
    console.error('Error checking auth:', err);
    isAuthenticated.value = false;
  } finally {
    isCheckingAuth.value = false;
  }
};

// Login Action
const handleLogin = async () => {
  loginError.value = '';
  isSubmittingLogin.value = true;
  try {
    const res = await fetch('/api/admin/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
      },
      credentials: 'same-origin',
      body: JSON.stringify({
        password: loginPassword.value,
      }),
    });

    const data = await res.json();

    if (res.ok) {
      isAuthenticated.value = true;
      loginPassword.value = '';
      showToast('خوش آمدید! ورود به پیشخوان مدیریت با موفقیت انجام شد.');
      fetchProjects();
    } else {
      loginError.value = data.errors?.password?.[0] || data.message || 'رمز عبور اشتباه است.';
    }
  } catch (err) {
    loginError.value = 'خطا در ارتباط با سرور. لطفاً مجدداً تلاش کنید.';
  } finally {
    isSubmittingLogin.value = false;
  }
};

// Logout Action
const handleLogout = async () => {
  try {
    await fetch('/api/admin/logout', {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
      },
      credentials: 'same-origin',
    });
  } catch (err) {
    console.error(err);
  } finally {
    isAuthenticated.value = false;
    showToast('شما از حساب مدیریت خارج شدید.');
  }
};

// Fetch Projects from API
const fetchProjects = async () => {
  isLoadingProjects.value = true;
  try {
    const res = await fetch('/api/projects', {
      headers: { 'Accept': 'application/json' },
    });
    if (res.ok) {
      const json = await res.json();
      projects.value = json.data || json;
    }
  } catch (err) {
    showToast('خطا در دریافت لیست پروژه‌ها', 'error');
  } finally {
    isLoadingProjects.value = false;
  }
};

// Category change handler
const handleCategoryChange = () => {
  if (form.value.category === 'webapps') {
    form.value.categoryLabel = 'اپلیکیشن وب';
  } else if (form.value.category === 'js') {
    form.value.categoryLabel = 'جاوااسکریپت & API';
  } else if (form.value.category === 'mini') {
    form.value.categoryLabel = 'مینی پروژه';
  }
};

// Open Create Modal
const openCreateModal = () => {
  isEditing.value = false;
  modalError.value = '';
  form.value = {
    id: null,
    title: '',
    category: 'webapps',
    categoryLabel: 'اپلیکیشن وب',
    icon: '🚀',
    shortDesc: '',
    fullDesc: '',
    hostedUrl: '',
    githubUrl: '',
    tagsInput: 'HTML, CSS, JavaScript',
    featuresInput: '',
  };
  showModal.value = true;
};

// Open Edit Modal
const openEditModal = (project) => {
  isEditing.value = true;
  modalError.value = '';
  form.value = {
    id: project.id,
    title: project.title,
    category: project.category || 'webapps',
    categoryLabel: project.categoryLabel || 'اپلیکیشن وب',
    icon: project.icon || '🚀',
    shortDesc: project.shortDesc || '',
    fullDesc: project.fullDesc || '',
    hostedUrl: project.hostedUrl || '',
    githubUrl: project.githubUrl || '',
    tagsInput: Array.isArray(project.tags) ? project.tags.join(', ') : '',
    featuresInput: Array.isArray(project.features) ? project.features.join('\n') : '',
  };
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
};

// Save Project (Create or Update)
const saveProject = async () => {
  modalError.value = '';
  isSavingProject.value = true;

  // Process tags & features
  const tags = form.value.tagsInput
    .split(/[,،]/)
    .map(t => t.trim())
    .filter(Boolean);

  const features = form.value.featuresInput
    .split('\n')
    .map(f => f.trim())
    .filter(Boolean);

  const payload = {
    title: form.value.title,
    category: form.value.category,
    category_label: form.value.categoryLabel,
    icon: form.value.icon || '🚀',
    short_desc: form.value.shortDesc,
    full_desc: form.value.fullDesc,
    hosted_url: form.value.hostedUrl || null,
    github_url: form.value.githubUrl || null,
    tags: tags.length > 0 ? tags : null,
    features: features.length > 0 ? features : null,
  };

  try {
    const url = isEditing.value ? `/api/admin/projects/${form.value.id}` : '/api/admin/projects';
    const method = isEditing.value ? 'PUT' : 'POST';

    const res = await fetch(url, {
      method,
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
      },
      credentials: 'same-origin',
      body: JSON.stringify(payload),
    });

    const data = await res.json();

    if (res.ok) {
      showToast(isEditing.value ? 'پروژه با موفقیت ویرایش شد.' : 'پروژه جدید با موفقیت اضافه شد!');
      closeModal();
      await fetchProjects();
    } else {
      modalError.value = data.message || 'خطا در ذخیره پروژه. لطفاً ورودی‌ها را بررسی کنید.';
    }
  } catch (err) {
    modalError.value = 'خطا در ارتباط با سرور.';
  } finally {
    isSavingProject.value = false;
  }
};

// Confirm Delete
const confirmDelete = (project) => {
  deleteModal.value = {
    show: true,
    project,
    isDeleting: false,
  };
};

// Execute Delete
const executeDelete = async () => {
  if (!deleteModal.value.project) return;
  deleteModal.value.isDeleting = true;

  try {
    const res = await fetch(`/api/admin/projects/${deleteModal.value.project.id}`, {
      method: 'DELETE',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
      },
      credentials: 'same-origin',
    });

    if (res.ok) {
      showToast('پروژه با موفقیت حذف گردید.');
      deleteModal.value.show = false;
      await fetchProjects();
    } else {
      showToast('خطا در حذف پروژه!', 'error');
    }
  } catch (err) {
    showToast('خطای شبکه هنگام حذف پروژه', 'error');
  } finally {
    deleteModal.value.isDeleting = false;
  }
};

onMounted(() => {
  checkAuth();
});
</script>
