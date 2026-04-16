<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#047857">
    <meta name="description" content="منصة أسرة القفاري — تطبيق موحد يربط أبناء الأسرة: شجرة العائلة، الأخبار، المناسبات، العروض، وصندوق الأسرة في مكان واحد.">

    <title>{{ config('app.name', 'أسرة القفاري') }} — المنصة الرسمية للأسرة</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700,800&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <meta property="og:title" content="{{ config('app.name') }} — المنصة الرسمية للأسرة">
    <meta property="og:description" content="تطبيق موحد يربط أبناء الأسرة في مكان واحد.">
    <meta property="og:type" content="website">
</head>
<body class="antialiased bg-white text-ink-900 selection:bg-brand-200 selection:text-brand-900">

    {{-- ═══════════════════════════════ Navbar ═══════════════════════════════ --}}
    <header class="sticky top-0 z-40 backdrop-blur-md bg-white/80 border-b border-ink-100">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 h-16 flex items-center justify-between gap-6">
            <a href="#" class="flex items-center gap-3 shrink-0">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-brand-600 to-brand-800 text-white shadow-sm shadow-brand-900/20">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 2v6"/><path d="M12 8l-5 4v4"/><path d="M12 8l5 4v4"/>
                        <circle cx="12" cy="2.5" r="1.5" fill="currentColor"/>
                        <circle cx="7" cy="18" r="2.2" fill="currentColor"/>
                        <circle cx="17" cy="18" r="2.2" fill="currentColor"/>
                        <circle cx="12" cy="13" r="2.2" fill="currentColor"/>
                    </svg>
                </span>
                <span class="font-extrabold text-lg leading-none tracking-tight">أسرة القفاري</span>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-ink-700">
                <a href="#features" class="hover:text-brand-700 transition">المميزات</a>
                <a href="#showcase" class="hover:text-brand-700 transition">التطبيق</a>
                <a href="#news" class="hover:text-brand-700 transition">الأخبار</a>
                <a href="#download" class="hover:text-brand-700 transition">حمّل الآن</a>
            </nav>

            <div class="flex items-center gap-2">
                <a href="/docs" class="hidden sm:inline-flex items-center px-4 h-10 rounded-xl text-sm font-semibold text-ink-700 hover:bg-ink-50 transition">وثائق API</a>
                <a href="/admin" class="inline-flex items-center gap-2 px-4 h-10 rounded-xl text-sm font-semibold bg-ink-900 text-white hover:bg-brand-800 transition shadow-sm">
                    لوحة الإدارة
                    <svg class="w-4 h-4 rtl:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M13 6l6 6-6 6"/></svg>
                </a>
            </div>
        </div>
    </header>

    {{-- ═══════════════════════════════ Hero ═══════════════════════════════ --}}
    <section class="relative overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 text-brand-600/10 bg-grid-soft mask-fade-b"></div>
        <div aria-hidden="true" class="absolute -top-32 -start-32 w-96 h-96 rounded-full bg-brand-400/20 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 end-0 w-[32rem] h-[32rem] rounded-full bg-gold-300/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6 lg:px-8 pt-16 lg:pt-24 pb-20 lg:pb-28 grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7">
                <span class="inline-flex items-center gap-2 px-3 h-8 rounded-full bg-brand-50 border border-brand-200 text-brand-800 text-xs font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                    الإصدار 1.0 متاح الآن
                </span>

                <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.15]">
                    منصةٌ تجمع
                    <span class="relative whitespace-nowrap text-brand-700">
                        أبناء الأسرة
                        <svg class="absolute -bottom-2 inset-x-0 w-full text-gold-400" viewBox="0 0 200 10" fill="none" preserveAspectRatio="none" aria-hidden="true">
                            <path d="M0 6 Q 50 0, 100 6 T 200 6" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </span>
                    في مكانٍ واحد
                </h1>

                <p class="mt-6 text-lg text-ink-500 max-w-xl leading-relaxed">
                    تطبيق أسرة القفاري يربط أبناء الأسرة بشجرة العائلة، الأخبار، المناسبات القادمة، العروض التجارية، وصندوق الأسرة — بتجربةٍ حديثة وآمنة.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="#download" class="inline-flex items-center gap-2 h-12 px-6 rounded-xl bg-brand-700 hover:bg-brand-800 text-white font-semibold shadow-lg shadow-brand-900/20 transition">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M5 21h14"/></svg>
                        تحميل التطبيق
                    </a>
                    <a href="#features" class="inline-flex items-center gap-2 h-12 px-6 rounded-xl bg-white border border-ink-200 hover:border-ink-500 text-ink-900 font-semibold transition">
                        استكشف المميزات
                    </a>
                </div>

                <div class="mt-10 flex items-center gap-6 text-sm text-ink-500">
                    <div class="flex -space-x-2 space-x-reverse">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="w-8 h-8 rounded-full ring-2 ring-white bg-gradient-to-br {{ ['from-brand-400 to-brand-700', 'from-gold-400 to-gold-600', 'from-brand-500 to-brand-800', 'from-gold-300 to-gold-500'][$i] }}"></div>
                        @endfor
                    </div>
                    <span>ينضمّ <strong class="text-ink-900">{{ number_format($stats['members']) }}+</strong> فردٍ من العائلة</span>
                </div>
            </div>

            {{-- Phone mockup --}}
            <div class="lg:col-span-5 flex justify-center lg:justify-end">
                <div class="relative">
                    <div aria-hidden="true" class="absolute -inset-8 bg-gradient-to-tr from-brand-500/20 via-transparent to-gold-400/20 rounded-[3rem] blur-2xl"></div>
                    <div class="relative w-[300px] h-[600px] rounded-[2.8rem] bg-ink-900 p-3 shadow-2xl shadow-brand-900/30">
                        <div class="absolute top-3 left-1/2 -translate-x-1/2 w-28 h-6 bg-ink-900 rounded-b-2xl z-10"></div>
                        <div class="w-full h-full rounded-[2.2rem] overflow-hidden bg-gradient-to-b from-brand-50 to-white relative">
                            {{-- Mock app header --}}
                            <div class="bg-gradient-to-l from-brand-700 to-brand-900 text-white px-5 pt-10 pb-6">
                                <div class="flex items-center justify-between">
                                    <svg class="w-5 h-5 text-white/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 12h18"/><path d="M3 6h18"/><path d="M3 18h18"/></svg>
                                    <span class="font-bold">أسرة القفاري</span>
                                    <svg class="w-5 h-5 text-white/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                                </div>
                                <div class="mt-5 grid grid-cols-2 gap-2">
                                    <div class="bg-white/10 backdrop-blur rounded-xl p-3">
                                        <div class="text-[10px] opacity-80">زيارة للتطبيق</div>
                                        <div class="text-xl font-extrabold">{{ number_format($stats['members'] + 1500) }}</div>
                                    </div>
                                    <div class="bg-white/10 backdrop-blur rounded-xl p-3">
                                        <div class="text-[10px] opacity-80">فرد مشترك</div>
                                        <div class="text-xl font-extrabold">{{ number_format($stats['members']) }}</div>
                                    </div>
                                </div>
                            </div>
                            {{-- Mock content --}}
                            <div class="p-4 space-y-3">
                                <div class="flex gap-2 text-[10px]">
                                    <span class="px-3 py-1 bg-brand-700 text-white rounded-full font-semibold">الكل</span>
                                    <span class="px-3 py-1 bg-ink-100 text-ink-700 rounded-full">زواج</span>
                                    <span class="px-3 py-1 bg-ink-100 text-ink-700 rounded-full">عزاء</span>
                                </div>
                                <div class="text-xs font-bold text-ink-900">آخر الأخبار</div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="aspect-square rounded-xl bg-gradient-to-br from-brand-300 to-brand-600"></div>
                                    <div class="aspect-square rounded-xl bg-gradient-to-br from-gold-300 to-gold-500"></div>
                                </div>
                                <div class="text-xs font-bold text-ink-900 pt-1">المناسبات القادمة</div>
                                <div class="rounded-xl bg-white border border-ink-100 p-3 shadow-sm">
                                    <div class="h-2 w-2/3 bg-ink-200 rounded-full mb-2"></div>
                                    <div class="h-2 w-1/2 bg-ink-100 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════ Stats Strip ═══════════════════════════════ --}}
    <section class="border-y border-ink-100 bg-ink-50/60">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-10 grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach ([
                ['value' => $stats['members'],  'label' => 'عضواً في الأسرة', 'icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2 M9 11a4 4 0 100-8 4 4 0 000 8z M23 21v-2a4 4 0 00-3-3.87 M16 3.13a4 4 0 010 7.75'],
                ['value' => $stats['families'], 'label' => 'فرعاً وعائلة',    'icon' => 'M3 21v-2a5 5 0 015-5h8a5 5 0 015 5v2 M7 7a5 5 0 1110 0A5 5 0 017 7z'],
                ['value' => $stats['events'],   'label' => 'مناسبة نشطة',     'icon' => 'M8 2v4 M16 2v4 M3 10h18 M5 6h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z'],
                ['value' => $stats['offers'],   'label' => 'عرضاً تجارياً',   'icon' => 'M20 12V8H6a2 2 0 01-2-2c0-1.1.9-2 2-2h12v4 M4 6v12a2 2 0 002 2h14v-4 M18 12a2 2 0 000 4h4v-4h-4z'],
            ] as $stat)
                <div class="flex items-start gap-4">
                    <div class="shrink-0 inline-flex items-center justify-center w-11 h-11 rounded-xl bg-brand-100 text-brand-700">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $stat['icon'] }}"/></svg>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold tracking-tight">{{ number_format($stat['value']) }}<span class="text-brand-600">+</span></div>
                        <div class="text-sm text-ink-500 mt-1">{{ $stat['label'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ═══════════════════════════════ Features ═══════════════════════════════ --}}
    <section id="features" class="py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="max-w-2xl">
                <span class="inline-block text-brand-700 text-sm font-bold tracking-wide uppercase">المميزات</span>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold tracking-tight">كل ما تحتاجه عائلتك في تطبيقٍ واحد</h2>
                <p class="mt-4 text-lg text-ink-500 leading-relaxed">من شجرة العائلة إلى المناسبات والعروض — منظومة متكاملة مصمَّمة خصيصاً لتلبية احتياجات الأسرة الممتدة.</p>
            </div>

            <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ([
                    ['title' => 'شجرة العائلة',        'desc' => 'توثيق أبناء الأسرة وأبنائهم وبناتهم بربطٍ دقيق للأنساب، مع صفحةٍ شخصية لكل فرد.',                     'color' => 'from-brand-500 to-brand-700',   'icon' => 'M12 2v6 M12 8l-5 4v4 M12 8l5 4v4 M6 20h2 M11 20h2 M16 20h2'],
                    ['title' => 'الأخبار العاجلة',     'desc' => 'تصل إليك أخبار الأسرة المهمة فور نشرها مع إشعاراتٍ فوريّة للبنود العاجلة.',                          'color' => 'from-red-500 to-red-700',       'icon' => 'M10 3h4 M12 3v14 M6 21h12 M8 7a4 4 0 118 0v10H8V7z'],
                    ['title' => 'المناسبات',          'desc' => 'أعراس، مناسبات، واجتماعات — مع إمكانية تأكيد الحضور (RSVP) ومشاركة الموقع.',                          'color' => 'from-gold-400 to-gold-600',     'icon' => 'M8 2v4 M16 2v4 M3 10h18 M5 6h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z'],
                    ['title' => 'العروض التجارية',    'desc' => 'اكتشف العروض والخدمات المقدّمة من أبناء الأسرة بخصوماتٍ حصرية.',                                        'color' => 'from-purple-500 to-purple-700', 'icon' => 'M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16'],
                    ['title' => 'صندوق الأسرة',       'desc' => 'متابعة الإيرادات والمصروفات بشفافية كاملة، مع تقاريرَ دوريّة لأبناء الأسرة.',                           'color' => 'from-emerald-500 to-teal-700',  'icon' => 'M12 1v22 M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6'],
                    ['title' => 'إشعارات ذكيّة',      'desc' => 'تنبيهات مخصَّصة لكل فرد بناءً على المناسبات، الأخبار، والعروض التي تهمّه.',                              'color' => 'from-blue-500 to-blue-700',     'icon' => 'M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9 M13.73 21a2 2 0 01-3.46 0'],
                ] as $feature)
                    <article class="group relative bg-white border border-ink-100 rounded-2xl p-6 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-900/5 transition-all">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br {{ $feature['color'] }} text-white shadow-md">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $feature['icon'] }}"/></svg>
                        </div>
                        <h3 class="mt-5 text-lg font-bold">{{ $feature['title'] }}</h3>
                        <p class="mt-2 text-sm text-ink-500 leading-relaxed">{{ $feature['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════ Showcase ═══════════════════════════════ --}}
    <section id="showcase" class="py-24 bg-gradient-to-b from-ink-50/60 to-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-block text-brand-700 text-sm font-bold tracking-wide uppercase">تجربةٌ حديثة</span>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold tracking-tight">صُمِّم ليكون الأسرع والأجمل</h2>
                <p class="mt-4 text-lg text-ink-500 leading-relaxed">واجهةٌ عربية بالكامل، دعمٌ كامل للـ RTL، وأداءٌ مُحسَّن — لتجربةٍ سلسة على أي جهاز.</p>

                <ul class="mt-8 space-y-4">
                    @foreach ([
                        ['title' => 'أمان بمعايير بنكية', 'desc' => 'مصادقة OTP، توكينات Sanctum، وتشفير البيانات الحسّاسة.'],
                        ['title' => 'دعم متعدد اللغات',   'desc' => 'محتوى قابلٌ للترجمة (عربي/إنجليزي) باستخدام Spatie Translatable.'],
                        ['title' => 'نظام صلاحيات مرن',   'desc' => 'أدوار دقيقة: أمين السر، المسؤول المالي، الأعضاء، ومجلس الأسرة.'],
                    ] as $item)
                        <li class="flex gap-4">
                            <span class="shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-full bg-brand-100 text-brand-700">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <div>
                                <h4 class="font-bold">{{ $item['title'] }}</h4>
                                <p class="text-sm text-ink-500 mt-0.5">{{ $item['desc'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="relative flex justify-center">
                <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-tr from-brand-500/10 to-gold-400/10 rounded-3xl blur-3xl"></div>
                <div class="relative grid grid-cols-2 gap-6">
                    <div class="relative w-48 h-96 rounded-[2rem] bg-ink-900 p-2 shadow-2xl shadow-brand-900/20 translate-y-8 rotate-[-4deg]">
                        <div class="w-full h-full rounded-[1.6rem] bg-gradient-to-b from-brand-600 to-brand-900 overflow-hidden p-4 text-white">
                            <div class="text-[10px] opacity-70">الأعضاء</div>
                            <div class="mt-3 space-y-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur rounded-lg p-2">
                                        <div class="w-7 h-7 rounded-full bg-white/30"></div>
                                        <div class="flex-1 space-y-1">
                                            <div class="h-1.5 w-3/4 bg-white/40 rounded-full"></div>
                                            <div class="h-1.5 w-1/2 bg-white/20 rounded-full"></div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="relative w-48 h-96 rounded-[2rem] bg-ink-900 p-2 shadow-2xl shadow-brand-900/20 -translate-y-4 rotate-[4deg]">
                        <div class="w-full h-full rounded-[1.6rem] bg-white overflow-hidden p-4">
                            <div class="text-[10px] text-ink-500 font-bold">الفعاليات</div>
                            <div class="mt-3 space-y-3">
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="rounded-xl p-3 bg-gradient-to-br {{ ['from-brand-50 to-brand-100', 'from-gold-300/30 to-gold-400/30', 'from-red-50 to-red-100'][$i] }} border border-ink-100">
                                        <div class="h-1.5 w-2/3 bg-ink-700 rounded-full"></div>
                                        <div class="mt-2 h-1.5 w-1/2 bg-ink-300 rounded-full"></div>
                                        <div class="mt-3 flex items-center gap-1 text-[9px] text-ink-500 font-semibold">
                                            <span class="w-1 h-1 bg-brand-600 rounded-full"></span>
                                            الرياض
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════ News Preview ═══════════════════════════════ --}}
    @if($latestNews->isNotEmpty())
        <section id="news" class="py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="flex items-end justify-between gap-6 flex-wrap">
                    <div class="max-w-xl">
                        <span class="inline-block text-brand-700 text-sm font-bold tracking-wide uppercase">آخر الأخبار</span>
                        <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold tracking-tight">ما يجري في الأسرة</h2>
                    </div>
                    <a href="/docs" class="inline-flex items-center gap-1 text-brand-700 hover:text-brand-900 font-semibold text-sm">
                        عرض الكل
                        <svg class="w-4 h-4 rtl:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M13 6l6 6-6 6"/></svg>
                    </a>
                </div>

                <div class="mt-10 grid md:grid-cols-3 gap-6">
                    @foreach($latestNews as $item)
                        <article class="group bg-white border border-ink-100 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-brand-900/5 transition-all">
                            <div class="aspect-[16/10] bg-gradient-to-br from-brand-200 to-brand-500 relative overflow-hidden">
                                @php $cover = rescue(fn() => $item->getFirstMediaUrl('cover_image', 'medium'), null, false); @endphp
                                @if($cover)
                                    <img src="{{ $cover }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                                @if($item->is_urgent)
                                    <span class="absolute top-3 start-3 inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-600 text-white text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                        عاجل
                                    </span>
                                @endif
                            </div>
                            <div class="p-5">
                                <time class="text-xs text-ink-500 font-medium">{{ $item->published_at?->translatedFormat('d F Y') }}</time>
                                <h3 class="mt-2 font-bold leading-snug line-clamp-2">{{ $item->getTranslation('title', 'ar') }}</h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══════════════════════════════ Download CTA ═══════════════════════════════ --}}
    <section id="download" class="py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-700 via-brand-800 to-ink-900 text-white px-8 sm:px-16 py-16 lg:py-20">
                <div aria-hidden="true" class="absolute -top-24 -end-24 w-80 h-80 rounded-full bg-gold-400/20 blur-3xl"></div>
                <div aria-hidden="true" class="absolute -bottom-24 -start-24 w-80 h-80 rounded-full bg-brand-400/20 blur-3xl"></div>
                <div aria-hidden="true" class="absolute inset-0 bg-grid-soft text-white/20 opacity-30"></div>

                <div class="relative grid lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">حمّل التطبيق وابدأ الآن</h2>
                        <p class="mt-4 text-lg text-white/80 leading-relaxed max-w-lg">متاح مجاناً على iOS وAndroid — بتجربةٍ موحدة ومزامنة فورية عبر جميع أجهزتك.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 lg:justify-end">
                        <a href="#" class="inline-flex items-center gap-3 h-14 px-6 rounded-2xl bg-white text-ink-900 hover:bg-brand-50 transition font-semibold">
                            <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/></svg>
                            <div class="text-start">
                                <div class="text-[10px] opacity-70">متاح على</div>
                                <div class="text-sm font-bold">App Store</div>
                            </div>
                        </a>
                        <a href="#" class="inline-flex items-center gap-3 h-14 px-6 rounded-2xl bg-white text-ink-900 hover:bg-brand-50 transition font-semibold">
                            <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.198l2.807 1.626a1 1 0 010 1.73l-2.808 1.626L15.194 12l2.504-2.491zM5.864 2.658L16.802 8.99l-2.302 2.302-8.636-8.634z"/></svg>
                            <div class="text-start">
                                <div class="text-[10px] opacity-70">احصل عليه من</div>
                                <div class="text-sm font-bold">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════ Footer ═══════════════════════════════ --}}
    <footer class="border-t border-ink-100 bg-ink-50/50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-14 grid md:grid-cols-4 gap-10">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-brand-600 to-brand-800 text-white">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v6"/><path d="M12 8l-5 4v4"/><path d="M12 8l5 4v4"/><circle cx="12" cy="2.5" r="1.5" fill="currentColor"/><circle cx="7" cy="18" r="2.2" fill="currentColor"/><circle cx="17" cy="18" r="2.2" fill="currentColor"/><circle cx="12" cy="13" r="2.2" fill="currentColor"/></svg>
                    </span>
                    <span class="font-extrabold text-lg">أسرة القفاري</span>
                </div>
                <p class="mt-4 text-sm text-ink-500 leading-relaxed max-w-sm">منصّةٌ رسميّة تربط أبناء الأسرة بشجرة العائلة، الأخبار، والمناسبات في مكانٍ واحد.</p>
            </div>

            <div>
                <h4 class="font-bold text-sm mb-4">المنصّة</h4>
                <ul class="space-y-3 text-sm text-ink-500">
                    <li><a href="#features" class="hover:text-brand-700">المميزات</a></li>
                    <li><a href="#showcase" class="hover:text-brand-700">التطبيق</a></li>
                    <li><a href="/docs" class="hover:text-brand-700">وثائق API</a></li>
                    <li><a href="/admin" class="hover:text-brand-700">لوحة الإدارة</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-sm mb-4">الموارد</h4>
                <ul class="space-y-3 text-sm text-ink-500">
                    <li><a href="#" class="hover:text-brand-700">سياسة الخصوصية</a></li>
                    <li><a href="#" class="hover:text-brand-700">شروط الاستخدام</a></li>
                    <li><a href="#" class="hover:text-brand-700">الدعم الفنّي</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-ink-100">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-ink-500">
                <span>© {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.</span>
                <span>صُنع بعنايةٍ لأبناء الأسرة.</span>
            </div>
        </div>
    </footer>

</body>
</html>
