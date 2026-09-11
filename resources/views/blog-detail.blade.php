@extends('layouts.app')

@php
    $title = $blog['title'] ?? 'Story';
    $shortDesc = $blog['short_description'] ?? '';
    $category = $blog['category']['name'] ?? 'Wellness';
    $categorySlug = $blog['category']['slug'] ?? null;
    $subCategory = $blog['sub_category']['name'] ?? null;
    $subCategorySlug = $blog['sub_category']['slug'] ?? null;
    $publishedDate = blogger_format_date($blog['published_at'] ?? $blog['created_at'] ?? null);
    $readTime = blogger_reading_time($blog['content'] ?? $shortDesc);
    $comments = $blog['active_comments'] ?? [];
    $rawImage = $blog['image_1150x900'] ?? $blog['image_850x500'] ?? $blog['image_url'] ?? null;
    $imageUrl = blogger_media_url($rawImage);
@endphp

@section('title', ($seoData['meta_title'] ?? $title) . ' - ' . config('site.name'))
@section('meta_description', $seoData['meta_description'] ?? ($shortDesc ?: 'Read ' . $title . ' on ' . config('site.name') . '.'))
@section('og_image', $imageUrl)
@section('og_type', 'article')

@section('content')
<article class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs text-purple-700/80 dark:text-purple-400 mb-6 flex-wrap">
        <a href="{{ route('home') }}" class="hover:text-purple-900 dark:hover:text-white transition-colors">Home</a>
        <span>&rsaquo;</span>
        @if($categorySlug)
            <a href="{{ route('category.show', $categorySlug) }}" class="hover:text-purple-900 dark:hover:text-white transition-colors">{{ $category }}</a>
            <span>&rsaquo;</span>
        @endif
        @if($subCategory && $subCategorySlug)
            <a href="{{ route('subcategory.show', $subCategorySlug) }}" class="hover:text-purple-900 dark:hover:text-white transition-colors">{{ $subCategory }}</a>
            <span>&rsaquo;</span>
        @endif
        <span class="text-slate-700 dark:text-slate-300 font-semibold line-clamp-1 max-w-xs sm:max-w-md">{{ $title }}</span>
    </nav>

    <!-- Article Header -->
    <div class="max-w-4xl mx-auto text-center space-y-4 mb-10">
        @if($categorySlug)
            <a href="{{ route('category.show', $categorySlug) }}" class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300 border border-purple-200 dark:border-purple-800 shadow-xs">
                {{ $category }}
            </a>
        @endif

        <h1 class="text-3xl sm:text-5xl font-serif font-bold text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ $title }}
        </h1>

        @if(!empty($shortDesc))
            <p class="text-base sm:text-xl text-slate-600 dark:text-slate-300 font-normal leading-relaxed max-w-2xl mx-auto">
                {{ $shortDesc }}
            </p>
        @endif

        <!-- Meta Information -->
        <div class="flex items-center justify-center gap-4 text-xs sm:text-sm text-purple-700/70 dark:text-purple-400/80 pt-2 flex-wrap">
            <span>{{ $publishedDate }}</span>
            <span>&bull;</span>
            <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-rose-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                {{ $readTime }} min read
            </span>
            @php
                $displayViews = $views ?? ($blog['views_count'] ?? 0);
            @endphp
            @if($displayViews > 0)
                <span>&bull;</span>
                <span>{{ number_format($displayViews) }} {{ Str::plural('read', (int)$displayViews) }}</span>
            @endif
        </div>
    </div>

    <!-- Featured Image -->
    <div class="max-w-5xl mx-auto mb-12 rounded-3xl overflow-hidden shadow-2xl shimmer-loading bg-[#1C1230] aspect-[16/9] border border-purple-100 dark:border-purple-900/60">
        <img src="{{ $imageUrl }}" alt="{{ $title }}" class="w-full h-full object-cover">
    </div>

    <!-- Main Content Layout (Article + Sidebar) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 max-w-6xl mx-auto">
        
        <!-- Social Share Column (Left Sticky on Desktop) -->
        <div class="lg:col-span-1 hidden lg:block">
            <div class="sticky top-28 flex flex-col items-center gap-3">
                <span class="text-[10px] uppercase font-bold text-purple-400 tracking-wider mb-1">Share</span>
                
                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text={{ urlencode('🌸 Inspiring read: ' . $title . ' ' . url()->current()) }}" target="_blank" rel="noopener" class="p-2.5 rounded-2xl bg-purple-50 dark:bg-[#1E1136] text-purple-700 dark:text-purple-300 hover:bg-emerald-500 hover:text-white transition-all shadow-xs" title="Share on WhatsApp">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                </a>

                <!-- Twitter / X -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($title) }}" target="_blank" rel="noopener" class="p-2.5 rounded-2xl bg-purple-50 dark:bg-[#1E1136] text-purple-700 dark:text-purple-300 hover:bg-black hover:text-white transition-all shadow-xs" title="Share on X">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="p-2.5 rounded-2xl bg-purple-50 dark:bg-[#1E1136] text-purple-700 dark:text-purple-300 hover:bg-blue-600 hover:text-white transition-all shadow-xs" title="Share on Facebook">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                
                <!-- Copy Link Button -->
                <button type="button" onclick="copyCaringLink()" class="p-2.5 rounded-2xl bg-purple-50 dark:bg-[#1E1136] text-purple-700 dark:text-purple-300 hover:bg-purple-600 hover:text-white transition-all shadow-xs" title="Copy Link">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </button>
            </div>
        </div>

        <!-- Article Body Column (8 cols) -->
        <div class="lg:col-span-8 space-y-10">
            <!-- Main Editorial Content -->
            <div class="prose-content">
                {!! $blog['content'] ?? '' !!}
            </div>

            <!-- In-Article Ad Placement -->
            <x-ad-banner placement="horizontal_ad" />

            <!-- Tags -->
            @php
                $tags = !empty($blog['tags_array']) ? $blog['tags_array'] : (is_array($blog['tags'] ?? null) ? $blog['tags'] : explode(',', $blog['tags'] ?? ''));
                $tags = array_filter(array_map('trim', $tags));
            @endphp
            @if(!empty($tags))
                <div class="pt-6 border-t border-purple-100 dark:border-purple-900/60">
                    <span class="text-xs font-bold uppercase tracking-wider text-purple-500 block mb-3">Related Themes:</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('search', ['q' => $tag]) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-purple-50 hover:bg-purple-100 dark:bg-[#1E1136] dark:hover:bg-[#2A164C] text-purple-700 dark:text-purple-300 transition-colors">
                                #{{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Previous & Next Story Navigation -->
            @if(!empty($previousBlog) || !empty($nextBlog))
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-8 border-t border-purple-100 dark:border-purple-900/60">
                    @if(!empty($previousBlog))
                        <a href="{{ route('blog.show', $previousBlog['slug']) }}" class="p-5 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 hover:border-purple-300 transition-all group shadow-xs">
                            <span class="text-[11px] font-bold text-purple-500 uppercase tracking-wider block mb-1">&larr; Previous Story</span>
                            <h4 class="text-sm font-serif font-bold text-slate-900 dark:text-white group-hover:text-purple-700 dark:group-hover:text-purple-300 line-clamp-2">{{ $previousBlog['title'] }}</h4>
                        </a>
                    @else
                        <div></div>
                    @endif

                    @if(!empty($nextBlog))
                        <a href="{{ route('blog.show', $nextBlog['slug']) }}" class="p-5 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 hover:border-purple-300 transition-all group sm:text-right shadow-xs">
                            <span class="text-[11px] font-bold text-purple-500 uppercase tracking-wider block mb-1">Next Story &rarr;</span>
                            <h4 class="text-sm font-serif font-bold text-slate-900 dark:text-white group-hover:text-purple-700 dark:group-hover:text-purple-300 line-clamp-2">{{ $nextBlog['title'] }}</h4>
                        </a>
                    @endif
                </div>
            @endif

            <!-- Comments & Discussion Section -->
            @if($blog['allow_comments'] ?? true)
                <section class="pt-10 border-t border-purple-100 dark:border-purple-900/60 space-y-8" id="comments">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-serif font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>Community Reflections</span>
                            <span id="comments-count" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-100 dark:bg-purple-900/60 text-purple-700 dark:text-purple-300">
                                {{ count($comments) }}
                            </span>
                        </h3>
                    </div>

                    <!-- Comment Form with Math Captcha & AJAX Submission -->
                    <form id="comment-form" action="{{ route('blog.comment', $blog['slug']) }}" method="POST" class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/60 space-y-5 shadow-xs">
                        @csrf
                        <input type="hidden" name="blog_id" value="{{ $blog['id'] }}">

                        <div id="comment-alert" class="hidden p-4 rounded-2xl text-xs font-semibold"></div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-purple-700 dark:text-purple-300 mb-1.5">Your Name</label>
                                <input type="text" name="full_name" required placeholder="Kind stranger or your name" class="w-full px-4 py-2.5 rounded-2xl bg-purple-50/70 dark:bg-[#120822] border border-purple-100 dark:border-purple-900 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-purple-700 dark:text-purple-300 mb-1.5">Email Address</label>
                                <input type="email" name="email" required placeholder="Never displayed publicly" class="w-full px-4 py-2.5 rounded-2xl bg-purple-50/70 dark:bg-[#120822] border border-purple-100 dark:border-purple-900 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-purple-700 dark:text-purple-300 mb-1.5">Your Reflection</label>
                            <textarea name="description" rows="4" required placeholder="Share your thoughtful perspective or kind words..." class="w-full px-4 py-3 rounded-2xl bg-purple-50/70 dark:bg-[#120822] border border-purple-100 dark:border-purple-900 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
                        </div>

                        <!-- Math Security Captcha -->
                        <div class="flex items-center gap-4 flex-wrap">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-purple-700 dark:text-purple-300">Security Check:</span>
                                <span class="px-3 py-1.5 rounded-xl bg-purple-100 dark:bg-purple-900/60 font-mono text-sm font-bold text-purple-900 dark:text-purple-200">
                                    {{ $captchaQuestion }} = ?
                                </span>
                            </div>
                            <input type="number" name="captcha" required placeholder="Answer" class="w-28 px-3 py-2 rounded-xl bg-purple-50/70 dark:bg-[#120822] border border-purple-100 dark:border-purple-900 text-sm text-center focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <button type="submit" id="comment-submit-btn" class="px-6 py-3 rounded-2xl font-bold text-sm bg-gradient-to-r from-purple-600 to-rose-500 hover:from-purple-500 hover:to-rose-400 text-white shadow-md transition-all inline-flex items-center gap-2">
                            <span>Submit Reflection</span>
                        </button>
                    </form>

                    <!-- Comments List (New comments are prepended at the top immediately) -->
                    <div id="comments-list" class="space-y-4">
                        @forelse($comments as $comment)
                            <div class="comment-item p-5 rounded-3xl bg-white dark:bg-[#180E2B] border border-purple-100 dark:border-purple-900/50 shadow-xs space-y-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-purple-500 to-rose-400 text-white font-bold text-xs flex items-center justify-center">
                                            {{ substr($comment['full_name'] ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="text-sm font-bold text-slate-900 dark:text-white block">{{ $comment['full_name'] }}</span>
                                            <span class="text-[10px] text-purple-400">{{ blogger_format_date($comment['created_at'] ?? null) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed pl-10">
                                    {{ $comment['description'] }}
                                </p>
                            </div>
                        @empty
                            <p id="no-comments-msg" class="text-xs text-purple-400 italic text-center py-6">Be the first to share a gentle reflection on this story.</p>
                        @endforelse
                    </div>
                </section>
            @endif
        </div>

        <!-- Sidebar Column (3 cols) -->
        <aside class="lg:col-span-3 space-y-8">
            <!-- Related Stories -->
            @if(!empty($relatedBlogs) && count($relatedBlogs) > 0)
                <div class="rounded-3xl bg-white dark:bg-[#180E2B] p-6 border border-purple-100 dark:border-purple-900/60 shadow-xs space-y-4">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-purple-600 dark:text-purple-400 border-b border-purple-50 dark:border-purple-900/40 pb-2">
                        Related Stories
                    </h4>
                    <div class="space-y-4">
                        @foreach(collect($relatedBlogs)->take(4) as $related)
                            @php
                                $relSlug = $related['slug'] ?? '#';
                                $relUrl = route('blog.show', $relSlug);
                                $relTitle = $related['title'] ?? '';
                                $relImg = blogger_media_url($related['image_200x200'] ?? $related['image_url'] ?? null);
                            @endphp
                            <a href="{{ $relUrl }}" class="flex items-center gap-3 group">
                                <div class="w-14 h-14 rounded-xl overflow-hidden bg-purple-50 dark:bg-purple-900/40 shrink-0">
                                    <img src="{{ $relImg }}" alt="{{ $relTitle }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h5 class="text-xs font-serif font-semibold text-slate-800 dark:text-slate-200 group-hover:text-purple-700 dark:group-hover:text-purple-300 transition-colors line-clamp-2 leading-snug">
                                        {{ $relTitle }}
                                    </h5>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Sidebar Ad Placement -->
            <x-ad-banner placement="sidebar" />
        </aside>
    </div>
</article>

<script>
    function copyCaringLink() {
        navigator.clipboard.writeText(window.location.href);
        if (typeof showCaringToast === 'function') {
            showCaringToast('Story link copied to clipboard!');
        } else {
            alert('Story link copied to clipboard!');
        }
    }

    // Dynamic Reading Progress Bar
    window.addEventListener('scroll', () => {
        const winScroll = document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        const bar = document.getElementById('reading-progress-bar');
        if (bar) bar.style.width = scrolled + '%';
    });

    // Instant AJAX Comment Submission (No Refresh & Immediate Prepend)
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('comment-form');
        const alertBox = document.getElementById('comment-alert');
        const submitBtn = document.getElementById('comment-submit-btn');
        const commentsList = document.getElementById('comments-list');
        const commentsCount = document.getElementById('comments-count');
        const noCommentsMsg = document.getElementById('no-comments-msg');

        if (form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                submitBtn.disabled = true;
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span>Submitting...</span>';
                alertBox.classList.add('hidden');

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.success !== false) {
                        // Show success alert
                        alertBox.className = 'p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-semibold';
                        alertBox.textContent = data.message || 'Your reflection has been submitted successfully!';
                        alertBox.classList.remove('hidden');

                        // Prepend comment immediately at the top
                        const commentData = data.comment || {
                            full_name: formData.get('full_name'),
                            description: formData.get('description'),
                        };

                        const initialLetter = (commentData.full_name || 'U').charAt(0).toUpperCase();
                        const newCommentEl = document.createElement('div');
                        newCommentEl.className = 'comment-item p-5 rounded-3xl bg-purple-50/50 dark:bg-[#1E1136] border border-purple-200 dark:border-purple-800/80 shadow-xs space-y-2 animate-fade-in';
                        newCommentEl.innerHTML = `
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-purple-500 to-rose-400 text-white font-bold text-xs flex items-center justify-center">
                                        ${initialLetter}
                                    </div>
                                    <div>
                                        <span class="text-sm font-bold text-slate-900 dark:text-white block">${commentData.full_name}</span>
                                        <span class="text-[10px] text-purple-400">Just now</span>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300">Live</span>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed pl-10">
                                ${commentData.description}
                            </p>
                        `;

                        if (noCommentsMsg) {
                            noCommentsMsg.remove();
                        }
                        commentsList.prepend(newCommentEl);

                        // Increment comment counter
                        if (commentsCount) {
                            const current = parseInt(commentsCount.textContent.trim()) || 0;
                            commentsCount.textContent = current + 1;
                        }

                        // Reset form fields except blog_id & csrf
                        form.querySelector('[name="description"]').value = '';
                        form.querySelector('[name="captcha"]').value = '';
                    } else {
                        // Show validation or submission error
                        alertBox.className = 'p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-semibold';
                        const errMsg = data.message || (data.errors ? Object.values(data.errors).flat()[0] : 'Failed to submit reflection.');
                        alertBox.textContent = errMsg;
                        alertBox.classList.remove('hidden');
                    }
                } catch (err) {
                    alertBox.className = 'p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-semibold';
                    alertBox.textContent = 'An error occurred while submitting your reflection. Please try again.';
                    alertBox.classList.remove('hidden');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        }
    });
</script>
@endsection
