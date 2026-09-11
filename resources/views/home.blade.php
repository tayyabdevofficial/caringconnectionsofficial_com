@extends('layouts.app')

@section('title', config('site.name') . ' - ' . config('site.tagline'))
@section('meta_description', config('site.description'))

@section('content')
    <!-- Hero Spotlight Section -->
    @if(!empty($headerSliderBlogs) && count($headerSliderBlogs) > 0)
        <x-hero-slider :blogs="$headerSliderBlogs" />
    @endif

    <!-- Main Content Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-16">

        <!-- Featured Highlights & Community Favorites -->
        <section>
            <div class="flex items-center justify-between mb-8 pb-3 border-b border-purple-100 dark:border-purple-950/80">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-purple-600 dark:text-purple-400">Curated with Heart</span>
                    <h2 class="text-2xl sm:text-3xl font-serif font-bold text-slate-900 dark:text-white tracking-tight">Compassionate Highlights</h2>
                </div>
                <div class="h-1 flex-1 mx-6 bg-purple-50 dark:bg-[#1E1136] rounded-full hidden md:block"></div>
                <span class="text-xs font-semibold text-purple-700 dark:text-purple-300 bg-purple-50 dark:bg-purple-900/30 px-3 py-1 rounded-full">
                    Daily Reflections
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Main Featured Articles (8 cols) -->
                <div class="lg:col-span-8">
                    @if(!empty($featuredBlogs) && count($featuredBlogs) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach(array_slice($featuredBlogs, 0, 4) as $featured)
                                <x-blog-card :blog="$featured" />
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Uplifting Reads & Most Popular (4 cols) -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="rounded-3xl bg-white dark:bg-[#180E2B] p-6 border border-purple-100 dark:border-purple-900/60 shadow-sm">
                        <div class="flex items-center gap-2 mb-6 pb-3 border-b border-purple-50 dark:border-purple-900/40">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-400 animate-ping"></span>
                            <h3 class="text-lg font-serif font-bold text-slate-900 dark:text-white tracking-tight">Cherished by Readers</h3>
                        </div>

                        <div class="space-y-4">
                            @php
                                $sidebarStories = !empty($todayTopBlogs) ? $todayTopBlogs : $recentBlogs;
                            @endphp
                            @foreach(collect($sidebarStories)->take(5) as $index => $story)
                                @php
                                    $storySlug = $story['slug'] ?? '#';
                                    $storyUrl = route('blog.show', $storySlug);
                                    $storyTitle = $story['title'] ?? '';
                                    $storyCat = $story['category']['name'] ?? 'Care';
                                    $storyDate = blogger_format_date($story['published_at'] ?? null);
                                    $storyImg = blogger_media_url($story['image_200x200'] ?? $story['image_url'] ?? null);
                                @endphp
                                <a href="{{ $storyUrl }}" class="flex items-center gap-4 group p-2 rounded-2xl hover:bg-purple-50/70 dark:hover:bg-purple-950/40 transition-colors">
                                    <span class="text-2xl font-serif font-bold text-purple-300 dark:text-purple-700/80 group-hover:text-purple-600 transition-colors shrink-0 w-6 text-center">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-purple-100 dark:bg-purple-900/40 shrink-0">
                                        <img src="{{ $storyImg }}" alt="{{ $storyTitle }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-purple-600 dark:text-purple-400 block">{{ $storyCat }}</span>
                                        <h4 class="text-xs sm:text-sm font-semibold text-slate-800 dark:text-slate-200 group-hover:text-purple-700 dark:group-hover:text-purple-300 transition-colors line-clamp-2 leading-snug">
                                            {{ $storyTitle }}
                                        </h4>
                                        <span class="text-[10px] text-slate-400 mt-0.5 block">{{ $storyDate }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mid-Page Ad Placement -->
        <x-ad-banner placement="home_middle" />

        <!-- Latest Community Articles Grid -->
        <section>
            <div class="flex items-center justify-between mb-8 pb-3 border-b border-purple-100 dark:border-purple-950/80">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-purple-600 dark:text-purple-400">Fresh Perspectives</span>
                    <h2 class="text-2xl sm:text-3xl font-serif font-bold text-slate-900 dark:text-white tracking-tight">Recent Community Stories</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($recentBlogs as $blog)
                    <x-blog-card :blog="$blog" />
                @endforeach
            </div>
        </section>

        <!-- The Caring Circle Newsletter Box -->
        <x-newsletter-box />
    </div>
@endsection
