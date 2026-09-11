@extends('layouts.app')

@section('title', 'Cookie Policy - ' . config('site.name'))
@section('meta_description', 'Learn how cookies and local storage are utilized on ' . config('site.name') . ' to deliver a secure and personalized experience.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">
    <div class="text-center py-6 space-y-3">
        <h1 class="text-3xl sm:text-4xl font-serif font-bold text-slate-900 dark:text-white">Cookie Policy</h1>
        <p class="text-xs text-purple-600 dark:text-purple-400">Published: {{ date('F Y') }}</p>
    </div>

    <div class="p-8 sm:p-12 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 shadow-xs prose-content space-y-6">
        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">1. What Are Cookies?</h2>
        <p>
            Cookies and browser local storage are small data files placed on your device to remember user settings (such as Light or Dark theme), preserve session state, and secure our communication channels against automated spam.
        </p>

        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">2. Cookies We Use</h2>
        <ul>
            <li><strong>Theme Preference:</strong> Stores your choice of Light or Dark theme without screen flickering.</li>
            <li><strong>Security Tokens:</strong> Prevents cross-site request forgery and ensures safe form submissions.</li>
        </ul>

        <h2 class="text-xl font-serif font-bold text-slate-900 dark:text-white">3. Managing Your Preferences</h2>
        <p>
            You can configure your browser settings to refuse cookies or notify you when cookies are being sent. Note that some interactive features may experience reduced functionality without essential cookies.
        </p>
    </div>
</div>
@endsection
