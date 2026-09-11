@props(['blog', 'featured' => false])

@php
    $image = blogger_media_url($blog['image_400x300'] ?? $blog['image_url'] ?? null);
    $title = $blog['title'] ?? 'Story';
    $slug = $blog['slug'] ?? '#';
    $url = route('blog.show', $slug);
    $category = $blog['category']['name'] ?? 'Wellness';
    $categorySlug = $blog['category']['slug'] ?? null;
    $date = blogger_format_date($blog['published_at'] ?? null);
    $readTime = blogger_reading_time($blog['content'] ?? $blog['short_description'] ?? '');
    $viewsCount = $blog['views_count'] ?? (is_array($blog['views'] ?? null) ? count($blog['views']) : ($blog['views'] ?? 0));
@endphp

<article class="group relative rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100/90 dark:border-purple-900/50 hover:border-purple-300 dark:hover:border-purple-600/60 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden">
    <!-- Image Header -->
    <a href="{{ $url }}" class="relative aspect-[16/10] overflow-hidden bg-purple-50 dark:bg-[#120822] block">
        <img src="{{ $image }}" 
             alt="{{ $title }}" 
             loading="lazy" 
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
        
        <div class="absolute top-3.5 left-3.5">
            @if($categorySlug)
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/90 dark:bg-[#180E2B]/90 text-purple-700 dark:text-purple-300 shadow-sm backdrop-blur-md border border-purple-100 dark:border-purple-800">
                    {{ $category }}
                </span>
            @else
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/90 dark:bg-[#180E2B]/90 text-purple-700 dark:text-purple-300 shadow-sm backdrop-blur-md">
                    {{ $category }}
                </span>
            @endif
        </div>
    </a>

    <!-- Card Body -->
    <div class="p-6 flex-1 flex flex-col justify-between space-y-3">
        <div class="space-y-2">
            <div class="flex items-center gap-2 text-xs text-purple-600 dark:text-purple-400 font-medium flex-wrap">
                <span>{{ $date }}</span>
            </div>

            <h3 class="text-lg font-serif font-bold text-slate-900 dark:text-white leading-snug group-hover:text-purple-700 dark:group-hover:text-purple-300 transition-colors line-clamp-2">
                <a href="{{ $url }}">
                    {{ $title }}
                </a>
            </h3>

            @if(!empty($blog['short_description']))
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                    {{ $blog['short_description'] }}
                </p>
            @endif
        </div>

        <!-- Card Footer: Views Count & Read Link (Author Removed) -->
        <div class="pt-3 border-t border-purple-50 dark:border-purple-950/60 flex items-center justify-between text-xs">
            <div class="flex items-center gap-1.5 text-slate-500 dark:text-slate-400 font-medium">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <span>{{ number_format((int)$viewsCount) }} {{ Str::plural('view', (int)$viewsCount) }}</span>
            </div>
            <a href="{{ $url }}" class="font-semibold text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-200 transition-colors inline-flex items-center gap-1">
                <span>Read</span>
                <span class="group-hover:translate-x-0.5 transition-transform">&rarr;</span>
            </a>
        </div>
    </div>
</article>
