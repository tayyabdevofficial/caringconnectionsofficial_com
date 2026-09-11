@extends('layouts.app')

@section('title', 'Terms and Conditions - ' . config('site.name'))
@section('meta_description', 'Terms and Conditions governing the use of ' . config('site.name') . ' wellness articles, reflections, and community resources.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">
    <div class="text-center py-6 space-y-3">
        <h1 class="text-3xl sm:text-4xl font-serif font-bold text-slate-900 dark:text-white">Terms and Conditions</h1>
        <p class="text-xs text-purple-600 dark:text-purple-400">Effective Date: {{ date('F Y') }}</p>
    </div>

    <div class="p-8 sm:p-12 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 shadow-xs prose-content space-y-6">
        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">1. Agreement to Terms</h2>
        <p>
            By accessing and reading articles on {{ config('site.name') }}, you agree to be bound by these Terms and Conditions and adhere to our community code of kindness and respect.
        </p>

        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">2. Informational &amp; Wellness Disclaimer</h2>
        <p>
            Articles published on {{ config('site.name') }} are provided solely for educational, emotional support, and inspirational purposes. They do not constitute formal medical, psychiatric, or legal advice. If you or a loved one are experiencing acute distress, please contact professional healthcare providers or emergency helplines.
        </p>

        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">3. User Conduct in Discussions</h2>
        <p>
            Our comments section is a safe space. We strictly prohibit harassment, hate speech, defamatory language, unsolicited commercial advertising, and discriminatory remarks. Violating submissions will be immediately removed.
        </p>

        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">4. Intellectual Property</h2>
        <p>
            All original editorial articles, artwork, layout designs, and logos on this website are protected under applicable copyright laws. Reproduction without written consent is strictly prohibited.
        </p>
    </div>
</div>
@endsection
