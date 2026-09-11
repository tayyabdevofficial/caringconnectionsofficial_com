@extends('layouts.app')

@section('title', 'Contact Us - ' . config('site.name'))
@section('meta_description', 'Connect with the Caring Connections team. We welcome your stories, questions, and community partnership inquiries.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Header -->
    <div class="text-center py-8 sm:py-12 space-y-4 max-w-3xl mx-auto">
        <nav class="flex items-center justify-center gap-2 text-xs font-semibold text-purple-400">
            <a href="{{ route('home') }}" class="hover:text-purple-700 dark:hover:text-white transition-colors">Home</a>
            <span>/</span>
            <span>Community</span>
            <span>/</span>
            <span class="text-purple-700 dark:text-purple-300">Contact Us</span>
        </nav>

        <div class="flex justify-center">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300 border border-purple-200 dark:border-purple-800 shadow-xs">
                <span>✉</span>
                <span>We Welcome Your Message</span>
            </span>
        </div>

        <h1 class="text-3xl sm:text-5xl font-serif font-bold text-slate-900 dark:text-white tracking-tight leading-tight">
            Reach Out with Care
        </h1>

        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-xl mx-auto leading-relaxed">
            Whether you have a personal reflection to share, feedback on our wellness guides, or a question for our team, we would love to hear from you.
        </p>
    </div>

    <!-- Contact Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="p-6 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 text-center space-y-2 shadow-xs">
            <span class="text-2xl">✉</span>
            <h4 class="text-sm font-bold text-slate-900 dark:text-white">Email Us</h4>
            <p class="text-xs text-purple-600 dark:text-purple-400 font-medium">{{ config('site.support_email') }}</p>
        </div>

        <div class="p-6 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 text-center space-y-2 shadow-xs">
            <span class="text-2xl">⏱</span>
            <h4 class="text-sm font-bold text-slate-900 dark:text-white">Response Time</h4>
            <p class="text-xs text-slate-500 dark:text-slate-400">Within 24 Hours</p>
        </div>

        <div class="p-6 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 text-center space-y-2 shadow-xs">
            <span class="text-2xl">💜</span>
            <h4 class="text-sm font-bold text-slate-900 dark:text-white">Community</h4>
            <p class="text-xs text-slate-500 dark:text-slate-400">Safe &amp; Supportive</p>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="p-8 sm:p-12 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 shadow-xl space-y-6">
        <h2 class="text-2xl font-serif font-bold text-slate-900 dark:text-white">Send Us a Direct Note</h2>

        <div id="contact-alert" class="hidden p-4 rounded-2xl text-xs font-semibold"></div>

        <form id="contact-form" action="{{ route('pages.contact.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-purple-700 dark:text-purple-300 mb-1.5">Your Full Name</label>
                    <input type="text" name="name" required placeholder="Kind Friend" class="w-full px-4 py-3 rounded-2xl bg-purple-50/70 dark:bg-[#120822] border border-purple-100 dark:border-purple-900 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-purple-700 dark:text-purple-300 mb-1.5">Email Address</label>
                    <input type="email" name="email" required placeholder="name@example.com" class="w-full px-4 py-3 rounded-2xl bg-purple-50/70 dark:bg-[#120822] border border-purple-100 dark:border-purple-900 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-purple-700 dark:text-purple-300 mb-1.5">Subject</label>
                <input type="text" name="subject" required placeholder="Story submission, question, or feedback..." class="w-full px-4 py-3 rounded-2xl bg-purple-50/70 dark:bg-[#120822] border border-purple-100 dark:border-purple-900 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-purple-700 dark:text-purple-300 mb-1.5">Message</label>
                <textarea name="message" rows="5" required placeholder="Write your message here..." class="w-full px-4 py-3 rounded-2xl bg-purple-50/70 dark:bg-[#120822] border border-purple-100 dark:border-purple-900 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <!-- Math Security Captcha -->
            <div class="flex items-center gap-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-purple-700 dark:text-purple-300">Security Check:</span>
                    <span class="px-3 py-1.5 rounded-xl bg-purple-100 dark:bg-purple-900/60 font-mono text-sm font-bold text-purple-900 dark:text-purple-200">
                        {{ $captchaQuestion ?? '4 + 5' }} = ?
                    </span>
                </div>
                <input type="number" name="captcha" required placeholder="Answer" class="w-28 px-3 py-2 rounded-xl bg-purple-50/70 dark:bg-[#120822] border border-purple-100 dark:border-purple-900 text-sm text-center focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <button type="submit" id="contact-btn" class="px-8 py-3.5 rounded-2xl font-bold text-sm bg-gradient-to-r from-purple-600 to-rose-500 hover:from-purple-500 hover:to-rose-400 text-white shadow-lg transition-all inline-flex items-center gap-2">
                <span>Send Message &rarr;</span>
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cForm = document.getElementById('contact-form');
        const cAlert = document.getElementById('contact-alert');
        const cBtn = document.getElementById('contact-btn');

        if (cForm) {
            cForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                cBtn.disabled = true;
                const oldText = cBtn.innerHTML;
                cBtn.innerHTML = '<span>Sending...</span>';
                cAlert.classList.add('hidden');

                try {
                    const formData = new FormData(cForm);
                    const res = await fetch(cForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    });

                    const data = await res.json();
                    if (res.ok && data.success !== false) {
                        cAlert.className = 'p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-semibold';
                        cAlert.textContent = data.message || 'Thank you! Your message has been received with care.';
                        cAlert.classList.remove('hidden');
                        cForm.reset();
                    } else {
                        cAlert.className = 'p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-semibold';
                        const errMsg = data.message || (data.errors ? Object.values(data.errors).flat()[0] : 'Unable to send message. Please check the fields.');
                        cAlert.textContent = errMsg;
                        cAlert.classList.remove('hidden');
                    }
                } catch (err) {
                    cAlert.className = 'p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-semibold';
                    cAlert.textContent = 'An unexpected error occurred while sending your message. Please try again.';
                    cAlert.classList.remove('hidden');
                } finally {
                    cBtn.disabled = false;
                    cBtn.innerHTML = oldText;
                }
            });
        }
    });
</script>
@endsection
