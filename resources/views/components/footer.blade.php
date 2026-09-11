@props(['categories' => []])

<footer class="bg-[#0B0515] text-purple-200 border-t border-purple-950/80 transition-colors pt-16 pb-12 relative z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-purple-950/80">
            <!-- Brand & Mission Column (5 cols on lg) -->
            <div class="lg:col-span-5 space-y-5">
                <a href="{{ route('home') }}" class="inline-block group">
                    <img src="{{ asset('logo.png') }}" alt="{{ config('site.name') }}" class="h-10 sm:h-12 w-auto object-contain rounded-lg shadow-sm group-hover:scale-105 transition-transform duration-300">
                </a>
                
                <p class="text-sm text-purple-300/80 leading-relaxed max-w-sm">
                    {{ config('site.description') }}
                </p>

                <div class="flex items-center gap-3 pt-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-purple-900/40 text-purple-300 border border-purple-800/60">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                        </span>
                        <span>Compassionate Wellness Publication</span>
                    </div>
                </div>
            </div>

            <!-- Explore Categories Column (4 cols on lg) -->
            <div class="lg:col-span-4 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-widest text-white border-b border-purple-900/60 pb-2">
                    Care Categories
                </h4>
                <ul class="space-y-2 text-sm">
                    @foreach(collect($categories)->take(6) as $cat)
                        <li>
                            <a href="{{ route('category.show', $cat['slug'] ?? '#') }}" 
                               class="group flex items-center justify-between text-purple-300/80 hover:text-white transition-colors py-1">
                                <span class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-500 group-hover:bg-purple-300 group-hover:scale-125 transition-all"></span>
                                    <span class="group-hover:translate-x-0.5 transition-transform">{{ $cat['name'] }}</span>
                                </span>
                                <svg class="w-3.5 h-3.5 text-purple-500 group-hover:text-purple-300 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Company & Legal Column (3 cols on lg) -->
            <div class="lg:col-span-3 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-widest text-white border-b border-purple-900/60 pb-2">
                    Community &amp; Legal
                </h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('pages.about') }}" class="text-purple-300/80 hover:text-white transition-colors flex items-center gap-2 group">
                            <span class="text-purple-500 group-hover:text-purple-300 transition-colors">&rsaquo;</span>
                            <span class="group-hover:translate-x-0.5 transition-transform">About Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pages.contact') }}" class="text-purple-300/80 hover:text-white transition-colors flex items-center gap-2 group">
                            <span class="text-purple-500 group-hover:text-purple-300 transition-colors">&rsaquo;</span>
                            <span class="group-hover:translate-x-0.5 transition-transform">Contact Support</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pages.privacy') }}" class="text-purple-300/80 hover:text-white transition-colors flex items-center gap-2 group">
                            <span class="text-purple-500 group-hover:text-purple-300 transition-colors">&rsaquo;</span>
                            <span class="group-hover:translate-x-0.5 transition-transform">Privacy Policy</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pages.terms') }}" class="text-purple-300/80 hover:text-white transition-colors flex items-center gap-2 group">
                            <span class="text-purple-500 group-hover:text-purple-300 transition-colors">&rsaquo;</span>
                            <span class="group-hover:translate-x-0.5 transition-transform">Terms &amp; Conditions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pages.cookies') }}" class="text-purple-300/80 hover:text-white transition-colors flex items-center gap-2 group">
                            <span class="text-purple-500 group-hover:text-purple-300 transition-colors">&rsaquo;</span>
                            <span class="group-hover:translate-x-0.5 transition-transform">Cookie Policy</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sitemap') }}" class="text-purple-300/80 hover:text-white transition-colors flex items-center gap-2 group">
                            <span class="text-purple-500 group-hover:text-purple-300 transition-colors">&rsaquo;</span>
                            <span class="group-hover:translate-x-0.5 transition-transform">XML Sitemap</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright & Bottom Bar -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-purple-400/80">
            <p>&copy; {{ date('Y') }} {{ config('site.name') }}. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <a href="{{ route('pages.privacy') }}" class="hover:text-white transition-colors">Privacy</a>
                <span>&bull;</span>
                <a href="{{ route('pages.terms') }}" class="hover:text-white transition-colors">Terms</a>
                <span>&bull;</span>
                <a href="{{ route('pages.cookies') }}" class="hover:text-white transition-colors">Cookies</a>
                <span>&bull;</span>
                <a href="{{ route('sitemap') }}" class="hover:text-white transition-colors">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
