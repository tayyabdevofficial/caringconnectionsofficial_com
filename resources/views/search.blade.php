@extends('layouts.app')

@section('title', (!empty($searchTerm) ? 'Search: ' . e($searchTerm) : 'Search Stories & Wellness') . ' - ' . config('site.name'))
@section('meta_description', 'Search and discover compassionate care guides, mental health reflections, and community wellness stories on ' . config('site.name') . '.')
@section('extra_head')
    <meta name="robots" content="noindex, follow">
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
    <!-- Search Banner -->
    <div class="rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 p-8 sm:p-12 shadow-sm text-center max-w-3xl mx-auto space-y-6">
        <h1 class="text-2xl sm:text-4xl font-serif font-bold text-slate-900 dark:text-white tracking-tight">
            Search Community Reflections
        </h1>

        <form action="{{ route('search') }}" method="GET" class="relative max-w-xl mx-auto">
            <input type="search" 
                   name="q" 
                   value="{{ $searchTerm ?? '' }}"
                   placeholder="Search wellness, caregiving, mental health, kindness..." 
                   class="w-full rounded-2xl bg-purple-50/70 dark:bg-[#120822] py-4 pl-5 pr-28 text-slate-900 dark:text-white placeholder-purple-400/80 focus:outline-none focus:ring-2 focus:ring-purple-500 font-medium text-base border border-purple-100 dark:border-purple-900/50">
            <button type="submit" class="absolute right-2 top-2 bottom-2 px-5 rounded-xl bg-gradient-to-r from-purple-600 to-rose-500 hover:from-purple-500 hover:to-rose-400 text-white font-bold text-xs sm:text-sm transition-all shadow-sm">
                Search
            </button>
        </form>

        @if(!empty($searchTerm))
            <p class="text-sm text-purple-700 dark:text-purple-300">
                Showing reflections for <span class="font-bold">&ldquo;{{ $searchTerm }}&rdquo;</span>
            </p>
        @endif
    </div>

    <!-- Search Horizontal Ad -->
    <x-ad-banner placement="horizontal_ad" />

    <!-- Results Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <div class="lg:col-span-8 space-y-8">
            @if(!empty($blogs) && count($blogs) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($blogs as $blog)
                        <x-blog-card :blog="$blog" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 px-4 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 space-y-4">
                    <div class="w-16 h-16 rounded-full bg-purple-50 dark:bg-purple-900/40 text-purple-500 mx-auto flex items-center justify-center text-2xl">
                        🌸
                    </div>
                    <h3 class="text-lg font-serif font-bold text-slate-900 dark:text-white">No stories found</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm mx-auto">
                        We couldn't find any articles matching your search. Try different keywords or browse our categories.
                    </p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="lg:col-span-4 space-y-8">
            @if(!empty($allCategories) && count($allCategories) > 0)
                <div class="rounded-3xl bg-white dark:bg-[#180E2B] p-6 border border-purple-100 dark:border-purple-900/60 shadow-xs space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-purple-600 dark:text-purple-400">Care Categories</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($allCategories as $cat)
                            <a href="{{ route('category.show', $cat['slug'] ?? '#') }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-purple-50 dark:bg-purple-900/40 hover:bg-purple-600 hover:text-white dark:hover:bg-purple-600 dark:hover:text-white text-purple-700 dark:text-purple-300 transition-all">
                                {{ $cat['name'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
</div>
@endsection
