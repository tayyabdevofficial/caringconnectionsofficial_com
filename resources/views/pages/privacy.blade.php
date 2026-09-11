@extends('layouts.app')

@section('title', 'Privacy Policy - ' . config('site.name'))
@section('meta_description', 'Privacy Policy for ' . config('site.name') . '. Learn how we protect your personal data, comments, and newsletter preferences.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">
    <div class="text-center py-6 space-y-3">
        <h1 class="text-3xl sm:text-4xl font-serif font-bold text-slate-900 dark:text-white">Privacy Policy</h1>
        <p class="text-xs text-purple-600 dark:text-purple-400">Last updated: {{ date('F Y') }}</p>
    </div>

    <div class="p-8 sm:p-12 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 shadow-xs prose-content space-y-6">
        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">1. Information We Collect</h2>
        <p>
            At {{ config('site.name') }}, we value the trust you place in our community. We only collect information you voluntarily provide, such as your name and email address when submitting reflections, subscribing to "The Caring Circle" newsletter, or connecting with our wellness community.
        </p>

        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">2. How We Use Your Data</h2>
        <p>
            Your information is strictly used to deliver requested notifications, display authorized comments, and ensure a secure, respectful platform experience. We never sell, lease, or monetize your personal details to third parties.
        </p>

        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">3. Cookies &amp; Analytics</h2>
        <p>
            We use essential and functional cookies to remember your theme preference (Light/Dark mode) and protect against automated spam. You may control cookie preferences at any time through our <a href="{{ route('pages.cookies') }}">Cookie Policy</a>.
        </p>

        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">4. Contacting Our Data Team</h2>
        <p>
            If you wish to review, update, or permanently delete your stored comments or newsletter subscription, please email us directly at <a href="mailto:{{ config('site.support_email') }}">{{ config('site.support_email') }}</a>.
        </p>
    </div>
</div>
@endsection
