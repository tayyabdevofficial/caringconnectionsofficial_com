@props(['blogs' => []])

@if(!empty($blogs) && count($blogs) > 0)
    @php
        $mainHero = $blogs[0];
        $secondaryHeroes = array_slice($blogs, 1, 2);
    @endphp

    <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
            <!-- Main Featured Story (8 cols on lg) -->
            @php
                $mainImage = blogger_media_url($mainHero['image_1150x900'] ?? $mainHero['image_850x500'] ?? $mainHero['image_url'] ?? null);
                $mainTitle = $mainHero['title'] ?? '';
                $mainSlug = $mainHero['slug'] ?? '#';
                $mainDetailUrl = route('blog.show', $mainSlug);
                $mainCat = $mainHero['category']['name'] ?? 'Inspiration';
                $mainCatSlug = $mainHero['category']['slug'] ?? null;
                $mainDate = blogger_format_date($mainHero['published_at'] ?? null);
                $mainViews = $mainHero['views_count'] ?? (is_array($mainHero['views'] ?? null) ? count($mainHero['views']) : ($mainHero['views'] ?? 0));
                $mainReadTime = blogger_reading_time($mainHero['content'] ?? $mainHero['short_description'] ?? '');
            @endphp
            <div onclick="window.location.href='{{ $mainDetailUrl }}'" 
                 class="lg:col-span-8 relative rounded-3xl overflow-hidden aspect-[16/10] sm:aspect-[16/9] shadow-2xl group cursor-pointer shimmer-loading bg-[#0E071A] border border-purple-200/30 dark:border-purple-900/40">

                <img src="{{ $mainImage }}" alt="{{ $mainTitle }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                
                <!-- Full Dark Gradient Scrim to ensure complete legibility against baked-in image texts -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#0E071A] via-[#0E071A]/75 to-[#0E071A]/40"></div>

                <div class="absolute inset-0 p-6 sm:p-10 flex flex-col justify-between z-10">
                    <!-- Top Category & Badges -->
                    <div class="flex items-center gap-2.5 flex-wrap">
                        @if($mainCatSlug)
                            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-purple-700 to-rose-600 text-white shadow-md backdrop-blur-md">
                                {{ $mainCat }}
                            </span>
                        @endif
                        <span class="px-3.5 py-1 rounded-full text-xs font-semibold bg-white/20 text-purple-100 backdrop-blur-md border border-white/20">
                            💜 Heartbeat Story
                        </span>
                    </div>

                    <!-- Bottom Content -->
                    <div class="space-y-3 max-w-2xl">
                        <div class="flex items-center gap-3 text-xs sm:text-sm text-purple-200 font-medium">
                            <span>{{ $mainDate }}</span>
                            <span>&bull;</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-rose-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $mainReadTime }} min read
                            </span>
                            @if($mainViews > 0)
                                <span>&bull;</span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>{{ number_format((int)$mainViews) }} {{ Str::plural('view', (int)$mainViews) }}</span>
                                </span>
                            @endif
                        </div>

                        <h2 class="text-2xl sm:text-4xl font-serif font-bold text-white leading-tight tracking-tight group-hover:text-purple-200 transition-colors drop-shadow-md">
                            {{ $mainTitle }}
                        </h2>

                        @if(!empty($mainHero['short_description']))
                            <p class="text-sm sm:text-base text-purple-100/90 line-clamp-2 leading-relaxed hidden sm:block">
                                {{ $mainHero['short_description'] }}
                            </p>
                        @endif

                        <div class="pt-2">
                            <span class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-gradient-to-r from-purple-600 to-rose-500 hover:from-purple-500 hover:to-rose-400 text-white font-bold text-xs sm:text-sm shadow-xl transition-all">
                                <span>Read Full Story</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Featured Cards (4 cols on lg, 2 stacked items) -->
            <div class="lg:col-span-4 flex flex-col gap-6 justify-between">
                @foreach($secondaryHeroes as $subHero)
                    @php
                        $subImage = blogger_media_url($subHero['image_500x500'] ?? $subHero['image_400x300'] ?? $subHero['image_url'] ?? null);
                        $subTitle = $subHero['title'] ?? '';
                        $subSlug = $subHero['slug'] ?? '#';
                        $subDetailUrl = route('blog.show', $subSlug);
                        $subCat = $subHero['category']['name'] ?? 'Care';
                        $subCatSlug = $subHero['category']['slug'] ?? null;
                        $subDate = blogger_format_date($subHero['published_at'] ?? null);
                        $subViews = $subHero['views_count'] ?? (is_array($subHero['views'] ?? null) ? count($subHero['views']) : ($subHero['views'] ?? 0));
                    @endphp

                    <div onclick="window.location.href='{{ $subDetailUrl }}'"
                         class="relative flex-1 rounded-3xl overflow-hidden shadow-lg group aspect-[16/9] lg:aspect-auto cursor-pointer shimmer-loading bg-[#0E071A] border border-purple-200/30 dark:border-purple-900/40 min-h-[175px]">
                        <img src="{{ $subImage }}" alt="{{ $subTitle }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0E071A] via-[#0E071A]/75 to-[#0E071A]/35"></div>
                        
                        <div class="absolute inset-0 p-6 flex flex-col justify-end z-10">
                            @if($subCatSlug)
                                <span class="self-start px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-purple-600/90 text-white mb-2 shadow-sm backdrop-blur-md">
                                    {{ $subCat }}
                                </span>
                            @endif
                            <h3 class="text-base sm:text-lg font-serif font-bold text-white leading-snug line-clamp-2 group-hover:text-purple-200 transition-colors">
                                {{ $subTitle }}
                            </h3>
                            <div class="flex items-center gap-2 text-xs text-purple-200/90 mt-2">
                                <span>{{ $subDate }}</span>
                                @if($subViews > 0)
                                    <span>&bull;</span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>{{ number_format((int)$subViews) }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
