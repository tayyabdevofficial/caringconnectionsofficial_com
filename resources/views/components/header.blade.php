@props(['categories' => []])

<header class="sticky top-0 z-40 w-full transition-colors duration-200">
    <!-- Main Navigation Bar -->
    <nav class="backdrop-blur-md bg-white/95 dark:bg-[#120924]/95 border-b border-purple-100/80 dark:border-purple-950/80 shadow-xs transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20 gap-2">
                <!-- Brand Logo -->
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <!-- Compact brand mark on mobile -->
                        <picture class="block sm:hidden shrink-0">
                            <source srcset="{{ asset('logo-sm.webp') }}" type="image/webp">
                            <img src="{{ asset('logo-sm.png') }}" alt="{{ config('site.name') }}" width="36" height="36" fetchpriority="high" class="h-9 w-9 object-contain rounded-xl group-hover:scale-105 transition-transform duration-300">
                        </picture>
                        <!-- Full horizontal brand logo for sm and above -->
                        <picture class="hidden sm:block shrink-0">
                            <source srcset="{{ asset('logo.webp') }}" type="image/webp">
                            <img src="{{ asset('logo.png') }}" alt="{{ config('site.name') }}" width="160" height="40" fetchpriority="high" class="h-8 sm:h-10 w-auto object-contain group-hover:scale-105 transition-transform duration-300 rounded-lg shadow-xs">
                        </picture>
                    </a>
                </div>

                <!-- Desktop Category Navigation (Max 4 primary items + More dropdown) -->
                <div class="hidden lg:flex items-center gap-1 xl:gap-2 overflow-visible">
                    @php
                        $allCats = collect($categories);
                        $primaryCats = $allCats->take(4);
                        $moreCats = $allCats->slice(4);
                    @endphp

                    @foreach($primaryCats as $category)
                        @php
                            $subCats = $category['sub_categories'] ?? [];
                            $hasSubs = !empty($subCats) && count($subCats) > 0;
                            $isActive = request()->is('category/' . ($category['slug'] ?? ''));
                        @endphp

                        @if($hasSubs)
                            <div class="relative group shrink-0">
                                <a href="{{ route('category.show', $category['slug'] ?? '#') }}" 
                                   class="px-3 py-2 rounded-xl text-xs sm:text-sm font-semibold inline-flex items-center gap-1 transition-all whitespace-nowrap {{ $isActive ? 'text-purple-700 dark:text-purple-300 bg-purple-100/70 dark:bg-purple-900/40 font-bold' : 'text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-purple-300 hover:bg-purple-50 dark:hover:bg-purple-950/40' }}">
                                    <span>{{ $category['name'] }}</span>
                                    <svg class="w-3.5 h-3.5 text-purple-400 group-hover:rotate-180 transition-transform duration-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>

                                <!-- Dropdown menu -->
                                <div class="absolute left-0 top-full pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 w-56">
                                    <div class="rounded-2xl bg-white dark:bg-[#1C1230] shadow-2xl border border-purple-100 dark:border-purple-900/60 p-2 space-y-1 backdrop-blur-xl">
                                        @foreach($subCats as $sub)
                                            <a href="{{ route('subcategory.show', $sub['slug'] ?? '#') }}" class="block px-3.5 py-2 rounded-xl text-xs sm:text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-purple-300 hover:bg-purple-50 dark:hover:bg-purple-900/40 transition-colors truncate">
                                                {{ $sub['name'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('category.show', $category['slug'] ?? '#') }}" 
                               class="px-3 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all whitespace-nowrap shrink-0 {{ $isActive ? 'text-purple-700 dark:text-purple-300 bg-purple-100/70 dark:bg-purple-900/40 font-bold' : 'text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-purple-300 hover:bg-purple-50 dark:hover:bg-purple-950/40' }}">
                                {{ $category['name'] }}
                            </a>
                        @endif
                    @endforeach

                    @if($moreCats->isNotEmpty())
                        <div class="relative group shrink-0">
                            <button type="button" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-semibold inline-flex items-center gap-1 text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-purple-300 hover:bg-purple-50 dark:hover:bg-purple-950/40 transition-all whitespace-nowrap">
                                <span>More</span>
                                <svg class="w-3.5 h-3.5 text-purple-400 group-hover:rotate-180 transition-transform duration-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute right-0 top-full pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 w-56">
                                <div class="rounded-2xl bg-white dark:bg-[#1C1230] shadow-2xl border border-purple-100 dark:border-purple-900/60 p-2 space-y-1 backdrop-blur-xl max-h-80 overflow-y-auto">
                                    @foreach($moreCats as $extraCat)
                                        <a href="{{ route('category.show', $extraCat['slug'] ?? '#') }}" class="block px-3.5 py-2 rounded-xl text-xs sm:text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-purple-700 dark:hover:text-purple-300 hover:bg-purple-50 dark:hover:bg-purple-900/40 transition-colors truncate">
                                            {{ $extraCat['name'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Action Bar: Search Trigger, Theme Toggle & Mobile Menu (Exact match to funfillia_com) -->
                <div class="flex items-center gap-2 shrink-0">
                                        <!-- WhatsApp Action Button -->
                    <a href="https://wa.me/923099700930?text={{ urlencode('Hello, I am reaching out regarding ' . config('site.name') . ' editorial / inquiries.') }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 border border-emerald-300 dark:border-emerald-800 transition-all shadow-xs shrink-0 hover:scale-105" 
                       title="WhatsApp Editorial Desk (+92 309 9700930)">
                        <svg class="w-3.5 h-3.5 fill-current text-emerald-600 dark:text-emerald-400 shrink-0" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.311.045-.698.077-1.921-.427-1.442-.593-2.368-2.055-2.439-2.151-.07-.096-.583-.777-.583-1.482 0-.705.37-1.053.501-1.198.131-.144.287-.181.382-.181.096 0 .191.002.274.007.087.004.204-.033.319.243.119.288.406 1.001.443 1.074.037.073.061.16.012.257-.048.096-.073.156-.144.24-.072.083-.153.187-.218.251-.072.072-.148.15-.064.294.084.144.373.615.8 1.001.551.498 1.016.653 1.16.726.144.073.228.064.312-.033.084-.096.36-.419.456-.563.096-.144.192-.12.324-.072.131.048.837.395.981.467.144.073.24.108.275.168.036.06.036.348-.108.753z"/><path d="M12 2C6.477 2 2 6.477 2 12c0 1.821.487 3.53 1.338 5L2 22l5.132-1.312A9.957 9.957 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.167c-1.579 0-3.048-.445-4.295-1.216l-.308-.189-3.039.778.812-2.964-.207-.324A8.136 8.136 0 013.833 12c0-4.503 3.664-8.167 8.167-8.167 4.503 0 8.167 3.664 8.167 8.167 0 4.503-3.664 8.167-8.167 8.167z"/></svg>
                        <span class="hidden xs:inline">WhatsApp</span>
                    </a>

                    <!-- Search Icon Button -->
                    <button type="button" 
                            onclick="openSearchModal()"
                            aria-label="Search stories"
                            title="Search (⌘K)"
                            class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500/50 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Theme Toggle Switch -->
                    <x-theme-toggle />

                    <!-- Mobile Hamburger Button -->
                    <button type="button" 
                            onclick="openMobileNav()"
                            class="lg:hidden p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors"
                            aria-label="Open Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Animated Mobile Drawer & Backdrop (Matching funfillia_com animations) -->
    <div id="mobile-nav-backdrop" 
         class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"
         onclick="closeMobileNav()"></div>

    <div id="mobile-nav-drawer" 
         class="fixed top-0 right-0 bottom-0 z-50 w-80 max-w-[85vw] bg-white dark:bg-[#120924] shadow-2xl border-l border-purple-100 dark:border-purple-900/60 transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden flex flex-col">
        
        <!-- Drawer Header -->
        <div class="flex items-center justify-between p-5 border-b border-purple-100 dark:border-purple-950">
            <a href="{{ route('home') }}" class="flex items-center" onclick="closeMobileNav()">
                <img src="{{ asset('logo.png') }}" alt="{{ config('site.name') }}" width="160" height="40" loading="lazy" decoding="async" class="h-8 w-auto object-contain">
            </a>
            <button type="button" 
                    onclick="closeMobileNav()" 
                    class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hover:bg-purple-50 dark:hover:bg-purple-950 transition-colors"
                    aria-label="Close Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Quick Search inside Mobile Drawer -->
        <div class="p-4 border-b border-purple-100 dark:border-purple-950">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="search" 
                       name="q" 
                       placeholder="Search stories..." 
                       class="w-full px-4 py-2.5 pl-10 rounded-xl bg-purple-50/70 dark:bg-[#1C1230] border border-purple-100 dark:border-purple-900 text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <svg class="w-4 h-4 text-purple-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </form>
        </div>

        <!-- Drawer Nav Links & Accordion -->
        <div class="flex-1 overflow-y-auto p-4 space-y-2">
            <div class="pt-2 pb-1">
                <span class="text-[11px] font-bold uppercase tracking-wider text-purple-400 px-3">Care Topics</span>
            </div>

            @foreach($categories as $index => $category)
                @php
                    $subCats = $category['sub_categories'] ?? [];
                    $hasSubs = !empty($subCats) && count($subCats) > 0;
                    $accordionId = 'mobile-sub-' . ($category['id'] ?? $index);
                @endphp

                @if($hasSubs)
                    <div class="rounded-xl overflow-hidden border border-purple-100 dark:border-purple-950">
                        <div class="flex items-center justify-between px-3.5 py-2.5 bg-purple-50/50 dark:bg-[#1A102E]/60">
                            <a href="{{ route('category.show', $category['slug'] ?? '#') }}" 
                               onclick="closeMobileNav()"
                               class="font-semibold text-sm text-slate-900 dark:text-white hover:text-purple-600 dark:hover:text-purple-400">
                                {{ $category['name'] }}
                            </a>
                            <button type="button" 
                                    onclick="toggleMobileAccordion('{{ $accordionId }}', this)" 
                                    aria-label="Toggle {{ $category['name'] }} subcategories"
                                    aria-expanded="false"
                                    class="p-1 rounded-lg text-purple-400 hover:text-purple-600 dark:hover:text-purple-300 transition-transform">
                                <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                        <div id="{{ $accordionId }}" class="hidden pl-4 pr-3 py-2 space-y-1 bg-white dark:bg-[#120924] border-t border-purple-50 dark:border-purple-950/60">
                            @foreach($subCats as $sub)
                                <a href="{{ route('subcategory.show', $sub['slug'] ?? '#') }}" 
                                   onclick="closeMobileNav()"
                                   class="block px-3 py-1.5 rounded-lg text-xs text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-purple-300 hover:bg-purple-50 dark:hover:bg-purple-950/30">
                                    {{ $sub['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ route('category.show', $category['slug'] ?? '#') }}" 
                       onclick="closeMobileNav()"
                       class="block px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-900 dark:text-white hover:bg-purple-50 dark:hover:bg-[#1C1230] transition-colors">
                        {{ $category['name'] }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</header>

<script>
    function openMobileNav() {
        const backdrop = document.getElementById('mobile-nav-backdrop');
        const drawer = document.getElementById('mobile-nav-drawer');
        backdrop?.classList.remove('opacity-0', 'pointer-events-none');
        backdrop?.classList.add('opacity-100', 'pointer-events-auto');
        drawer?.classList.remove('translate-x-full');
        drawer?.classList.add('translate-x-0');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileNav() {
        const backdrop = document.getElementById('mobile-nav-backdrop');
        const drawer = document.getElementById('mobile-nav-drawer');
        backdrop?.classList.remove('opacity-100', 'pointer-events-auto');
        backdrop?.classList.add('opacity-0', 'pointer-events-none');
        drawer?.classList.remove('translate-x-0');
        drawer?.classList.add('translate-x-full');
        document.body.style.overflow = '';
    }

    function toggleMobileAccordion(id, btn) {
        const el = document.getElementById(id);
        const icon = btn?.querySelector('svg');
        if (el) {
            const isHidden = el.classList.toggle('hidden');
            if (btn) {
                btn.setAttribute('aria-expanded', !isHidden ? 'true' : 'false');
            }
            if (icon) {
                icon.classList.toggle('rotate-180', !isHidden);
            }
        }
    }
</script>
