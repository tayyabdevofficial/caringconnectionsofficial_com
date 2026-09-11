@extends('layouts.app')

@php
    $catName = $category['name'] ?? 'Category';
    $catDesc = $category['description'] ?? 'Browse curated stories and care resources in ' . $catName . '.';
    $subCategories = $category['sub_categories'] ?? [];
    $catImage = blogger_media_url($category['thumbnail'] ?? null);
@endphp

@section('title', $catName . ' - ' . config('site.name'))
@section('meta_description', $catDesc)
@section('og_image', $catImage ?: asset('logo.png'))
@section('og_type', 'website')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
    <!-- Category Hero Header -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#281858] via-[#3B1C71] to-[#1E1038] text-white p-8 sm:p-12 shadow-xl border border-purple-800/50">
        <div class="max-w-2xl space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-purple-500/20 text-purple-200 border border-purple-500/30">
                {{ $isSubCategory ? 'Subtopic' : 'Category Hub' }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-serif font-bold tracking-tight leading-tight">
                {{ $catName }}
            </h1>
            <p class="text-sm sm:text-base text-purple-200 leading-relaxed">
                {{ $catDesc }}
            </p>
        </div>

        <!-- Subcategories Filter Pills -->
        @if(!empty($subCategories) && count($subCategories) > 0)
            <div class="mt-8 pt-6 border-t border-white/10 flex items-center gap-2 flex-wrap">
                <span class="text-xs font-bold uppercase tracking-wider text-purple-300 mr-2">Explore Subtopics:</span>
                @foreach($subCategories as $sub)
                    <a href="{{ route('subcategory.show', $sub['slug'] ?? '#') }}" class="px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white/10 hover:bg-white/20 text-white transition-all backdrop-blur-md">
                        {{ $sub['name'] }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Main Content & Sidebar -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Articles Grid (8 cols on lg) -->
        <div class="lg:col-span-8 space-y-8">
            @if(!empty($blogs) && count($blogs) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($blogs as $blog)
                        <x-blog-card :blog="$blog" />
                    @endforeach
                </div>

                <!-- Custom Pagination -->
                @if(isset($pagination['last_page']) && $pagination['last_page'] > 1)
                    <div class="pt-8 flex items-center justify-center gap-2">
                        @for($i = 1; $i <= $pagination['last_page']; $i++)
                            <a href="?page={{ $i }}" 
                               class="w-10 h-10 rounded-2xl flex items-center justify-center text-sm font-bold transition-all {{ ($pagination['current_page'] ?? 1) == $i ? 'bg-gradient-to-r from-purple-600 to-rose-500 text-white shadow-md' : 'bg-white dark:bg-[#180E2B] text-slate-700 dark:text-slate-300 hover:bg-purple-50 dark:hover:bg-purple-900/30 border border-purple-100 dark:border-purple-900/60' }}">
                                {{ $i }}
                            </a>
                        @endfor
                    </div>
                @endif
            @else
                <div class="text-center py-16 bg-white dark:bg-[#180E2B] rounded-3xl border border-purple-100 dark:border-purple-900/60 p-8 space-y-4">
                    <span class="text-4xl">🌸</span>
                    <h3 class="text-lg font-serif font-bold text-slate-800 dark:text-slate-200">No stories published in this category yet.</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 max-w-sm mx-auto">Check back soon for fresh perspectives and community reflections.</p>
                    <a href="{{ route('home') }}" class="inline-block px-5 py-2.5 rounded-2xl text-xs font-bold bg-purple-600 text-white hover:bg-purple-500 transition-colors">
                        Return to Home
                    </a>
                </div>
            @endif
        </div>

        <!-- Sidebar (4 cols on lg) -->
        <aside class="lg:col-span-4 space-y-8">
            <x-ad-banner placement="sidebar" />
        </aside>
    </div>
</div>
@endsection
