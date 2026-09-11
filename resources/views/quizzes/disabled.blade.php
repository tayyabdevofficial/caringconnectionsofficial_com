@extends('layouts.app')

@section('title', $siteTitle ?? 'Challenge Inactive - ' . config('site.name'))
@section('meta_description', 'This challenge is currently paused. Check out our other active community challenges on ' . config('site.name') . '!')

@section('content')
<div class="min-h-screen py-12 sm:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Inactive Card Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 shadow-xl p-8 sm:p-12 text-center">
            <div class="relative z-10 max-w-xl mx-auto space-y-5">
                <div class="w-20 h-20 mx-auto rounded-3xl bg-purple-50 dark:bg-purple-950/40 text-purple-600 flex items-center justify-center text-4xl shadow-inner border border-purple-200/60 dark:border-purple-800/40">
                    ⏸️
                </div>

                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-purple-100 dark:bg-purple-950/60 text-purple-800 dark:text-purple-300 text-xs font-bold uppercase tracking-wider">
                    Temporarily Paused
                </div>

                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-bold text-slate-900 dark:text-white tracking-tight">
                    {{ $quizTitle ?? 'This Challenge' }} Is Currently Inactive
                </h1>

                <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                    {{ $message ?? 'This challenge has been paused by the admin. New creations and responses are temporarily paused.' }}
                </p>

                <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('quizzes.index') }}" class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-purple-600 to-rose-500 hover:from-purple-500 hover:to-rose-400 text-white font-bold text-sm sm:text-base shadow-lg transition-all hover:scale-105 inline-flex items-center gap-2">
                        <span>✨ Explore Active Challenges</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('home') }}" class="px-5 py-3.5 rounded-2xl bg-purple-50 dark:bg-[#1E1136] hover:bg-purple-100 dark:hover:bg-[#281544] text-purple-700 dark:text-purple-300 font-bold text-sm transition-colors inline-flex items-center gap-2">
                        <span>Back to Homepage</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Other Available Challenges Section -->
        @if(!empty($otherQuizzes) && count($otherQuizzes) > 0)
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-serif font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>💜</span> Other Meaningful Challenges
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">Pick any challenge below and share with your loved ones!</p>
                    </div>
                    <a href="{{ route('quizzes.index') }}" class="text-xs sm:text-sm font-bold text-purple-600 dark:text-purple-400 hover:underline">
                        View All →
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(array_slice($otherQuizzes, 0, 3) as $oq)
                        @php
                            $oqSlug = $oq['slug'] ?? '#';
                            $oqImg = blogger_media_url($oq['image'] ?? null);
                        @endphp
                        <a href="{{ route('quizzes.create', $oqSlug) }}" class="p-5 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 shadow-xs hover:shadow-lg transition-all group block">
                            <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-purple-50 dark:bg-purple-950/40 mb-4">
                                <img src="{{ $oqImg }}" alt="{{ $oq['title'] ?? '' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                            </div>
                            <h3 class="font-serif font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 line-clamp-2">{{ $oq['title'] ?? '' }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
