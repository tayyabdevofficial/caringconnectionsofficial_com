@extends('layouts.app')

@section('title', 'About Us - ' . config('site.name'))
@section('meta_description', 'Learn about Caring Connections — our mission of empathy, mental health support, caregiving resources, and heartwarming community wellness.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Header -->
    <div class="text-center py-8 sm:py-12 space-y-4 max-w-3xl mx-auto">
        <nav class="flex items-center justify-center gap-2 text-xs font-semibold text-purple-400">
            <a href="{{ route('home') }}" class="hover:text-purple-700 dark:hover:text-white transition-colors">Home</a>
            <span>/</span>
            <span>Community</span>
            <span>/</span>
            <span class="text-purple-700 dark:text-purple-300">About Us</span>
        </nav>

        <div class="flex justify-center">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300 border border-purple-200 dark:border-purple-800 shadow-xs">
                <span>🌸</span>
                <span>Compassion &amp; Solidarity</span>
            </span>
        </div>

        <h1 class="text-3xl sm:text-5xl font-serif font-bold text-slate-900 dark:text-white tracking-tight leading-tight">
            Nurturing Empathy, Mental Wellness &amp; Meaningful Bonds
        </h1>

        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-xl mx-auto leading-relaxed">
            Caring Connections is a dedicated digital sanctuary created to provide compassionate guidance, senior care knowledge, mental health perspectives, and genuine community empathy.
        </p>
    </div>

    <!-- Values Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 shadow-xs space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 flex items-center justify-center text-2xl">
                💜
            </div>
            <h3 class="text-lg font-serif font-bold text-slate-900 dark:text-white">Empathy First</h3>
            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                Every reflection, guide, and story is crafted with tenderness, respect, and deep understanding of human vulnerability.
            </p>
        </div>

        <div class="p-6 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 shadow-xs space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 flex items-center justify-center text-2xl">
                🤝
            </div>
            <h3 class="text-lg font-serif font-bold text-slate-900 dark:text-white">Caregiver Support</h3>
            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                Practical, heartfelt advice for those dedicating their lives to caring for elderly parents, children, and loved ones.
            </p>
        </div>

        <div class="p-6 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 shadow-xs space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 flex items-center justify-center text-2xl">
                ✨
            </div>
            <h3 class="text-lg font-serif font-bold text-slate-900 dark:text-white">Emotional Wellness</h3>
            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                Evidence-informed reflections on mindfulness, dealing with grief, emotional fatigue, and rekindling hope.
            </p>
        </div>
    </div>

    <!-- Editorial Statement -->
    <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-br from-purple-50 to-rose-50/50 dark:from-[#1E1136] dark:to-[#281544] border border-purple-100 dark:border-purple-900/60 space-y-4">
        <h2 class="text-xl sm:text-2xl font-serif font-bold text-slate-900 dark:text-white">Our Community Promise</h2>
        <p class="text-xs sm:text-sm text-slate-700 dark:text-purple-200 leading-relaxed">
            In an increasingly disconnected digital world, Caring Connections stands as a reminder that kindness matters, listening heals, and no one should have to navigate life's challenges in isolation.
        </p>
    </div>
</div>
@endsection
