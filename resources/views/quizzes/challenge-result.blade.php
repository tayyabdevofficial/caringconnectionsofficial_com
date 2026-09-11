@extends('layouts.app')

@section('title', ($result['friend_name'] ?? 'You') . ' scored ' . ($result['percentage'] ?? 0) . '% on ' . ($result['creator_name'] ?? 'Loved One') . "'s Dare! - Caring Connections")
@section('meta_description', 'Check out the caring connection quiz results and see how deeply your souls connect!')

@section('content')
<div class="min-h-screen bg-purple-50/40 dark:bg-[#0B0614] py-8 sm:py-12 transition-colors duration-300">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 space-y-8">

        @php
            $percentage = $result['percentage'] ?? 0;
            $score = $result['score'] ?? 0;
            $total = $result['total_questions'] ?? 0;
            $friendName = $result['friend_name'] ?? 'I';
            $creatorName = $result['creator_name'] ?? 'Loved One';
            $verdict = $result['verdict'] ?? 'Soulful Bond';
            $shareUrl = route('quizzes.challenge.take', $token);

            $boastText = rawurlencode(
                "💜 *OUR CONNECTION RESULTS ARE IN!* 💜\n\n" .
                "✨ I just scored *{$score}/{$total} ({$percentage}% Soul Match)* on *{$creatorName}*'s Caring Connection Dare!\n\n" .
                "🕊️ *Our Verdict:* {$verdict} 💖\n\n" .
                "🤔 *How well do you know {$creatorName}?*\n" .
                "👇 *Accept their dare challenge here:* 👇\n" .
                "{$shareUrl}\n\n" .
                "🌟 Take the test now and discover your bond! 🏆"
            );
        @endphp

        <!-- Result Score Card -->
        <div class="bg-gradient-to-br from-[#281858] via-[#432379] to-[#8B5CF6] rounded-3xl text-white p-6 sm:p-10 shadow-2xl text-center relative overflow-hidden">
            <div class="absolute -right-8 -top-8 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -left-8 -bottom-8 w-40 h-40 bg-rose-400/20 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 space-y-5">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md text-xs font-bold uppercase tracking-wider text-purple-200 shadow-sm">
                    <span>✨</span> Caring Dare Completed!
                </div>

                <div class="flex items-center justify-center gap-3">
                    <span class="text-4xl">{{ $result['creator_avatar'] ?? '💜' }}</span>
                    <h1 class="text-2xl sm:text-3xl font-black font-serif">
                        {{ $result['friend_name'] }} &amp; {{ $result['creator_name'] }}
                    </h1>
                </div>

                <!-- Big Score Pill -->
                <div class="py-4">
                    <div class="inline-flex flex-col items-center justify-center w-36 h-36 sm:w-44 sm:h-44 rounded-full bg-white/15 backdrop-blur-xl border-4 border-white/30 shadow-inner">
                        <span class="text-4xl sm:text-5xl font-black text-white tracking-tight">
                            {{ $result['score'] }}/{{ $result['total_questions'] }}
                        </span>
                        <span class="text-sm sm:text-base font-extrabold text-purple-200">
                            {{ $percentage }}% Match
                        </span>
                    </div>
                </div>

                <!-- Relationship Verdict Badge -->
                <div class="space-y-2 max-w-md mx-auto">
                    <div class="inline-block px-5 py-2 rounded-2xl bg-white text-[#281858] font-bold text-base sm:text-lg shadow-lg font-serif">
                        {{ $result['verdict'] ?? 'Soulful Bond' }}
                    </div>
                    <p class="text-xs sm:text-sm text-purple-100/90 font-normal">
                        {{ $result['verdict_desc'] ?? '' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Social Boast & Viral Actions -->
        <div class="bg-white dark:bg-[#140C26] rounded-3xl border border-purple-100 dark:border-purple-900/30 p-6 sm:p-8 shadow-sm space-y-4 text-center">
            <h2 class="text-lg font-bold text-slate-900 dark:text-white font-serif">
                Celebrate Your Bond With Loved Ones!
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                Share your connection result on WhatsApp and see if any other friends can match your score.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
                <a href="https://api.whatsapp.com/send?text={{ $boastText }}" target="_blank" rel="noopener noreferrer"
                   class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-sm shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>Share Score on WhatsApp</span>
                </a>

                <a href="{{ route('quizzes.index') }}" 
                   class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-gradient-to-r from-[#8B5CF6] via-purple-700 to-rose-500 text-white font-bold text-sm shadow-md hover:shadow-lg hover:scale-105 transition-all flex items-center justify-center gap-2">
                    <span>Create Your Own Dare Quiz</span>
                    <span>💜</span>
                </a>
            </div>
        </div>

        <!-- Side-by-Side Answers Comparison Breakdown -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white font-serif">
                    Answers Comparison
                </h3>
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400">
                    {{ $result['score'] }} Matches out of {{ $result['total_questions'] }}
                </span>
            </div>

            <div class="space-y-4">
                @foreach($result['comparison'] ?? [] as $idx => $comp)
                    <div class="p-5 rounded-3xl border-2 {{ $comp['is_match'] ? 'border-emerald-500/40 bg-emerald-50/40 dark:bg-emerald-950/20' : 'border-rose-500/40 bg-rose-50/40 dark:bg-rose-950/20' }} shadow-sm space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div class="space-y-1">
                                <span class="text-[11px] font-bold uppercase tracking-wider {{ $comp['is_match'] ? 'text-emerald-700 dark:text-emerald-400' : 'text-rose-700 dark:text-rose-400' }}">
                                    Question {{ $idx + 1 }}
                                </span>
                                <div class="font-bold text-base text-slate-900 dark:text-white font-serif">
                                    {{ $comp['question_text'] }}
                                </div>
                                @if(!empty($comp['image_url']))
                                    <div class="mt-2 rounded-xl overflow-hidden max-h-48 border border-purple-100 dark:border-purple-900/40">
                                        <img src="{{ blogger_media_url($comp['image_url']) }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>

                            <span class="shrink-0 px-3 py-1 rounded-full text-xs font-bold {{ $comp['is_match'] ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }}">
                                {{ $comp['is_match'] ? '✓ MATCH!' : '✗ MISSED' }}
                            </span>
                        </div>

                        <!-- Choices comparison -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs sm:text-sm">
                            <!-- Friend Choice -->
                            <div class="p-3 rounded-2xl {{ $comp['is_match'] ? 'bg-white dark:bg-[#140C26] border border-emerald-200 dark:border-emerald-800' : 'bg-white dark:bg-[#140C26] border border-rose-200 dark:border-rose-800' }}">
                                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">
                                    Your Guess
                                </div>
                                <div class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    @if(!empty($comp['friend_option_image']))
                                        <img src="{{ blogger_media_url($comp['friend_option_image']) }}" class="w-7 h-7 rounded-lg object-cover border border-purple-100 shrink-0">
                                    @endif
                                    <span>{{ $comp['is_match'] ? '🟢' : '🔴' }}</span>
                                    <span>{{ $comp['friend_option_text'] ?? 'No Answer' }}</span>
                                </div>
                            </div>

                            <!-- Creator Truth Choice -->
                            <div class="p-3 rounded-2xl bg-white dark:bg-[#140C26] border border-purple-100 dark:border-purple-900/30">
                                <div class="text-[10px] font-bold uppercase tracking-wider text-[#8B5CF6] dark:text-purple-300 mb-1">
                                    {{ $result['creator_name'] }}'s Actual Choice
                                </div>
                                <div class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    @if(!empty($comp['creator_option_image']))
                                        <img src="{{ blogger_media_url($comp['creator_option_image']) }}" class="w-7 h-7 rounded-lg object-cover border border-purple-100 shrink-0">
                                    @endif
                                    <span>✨</span>
                                    <span>{{ $comp['creator_option_text'] ?? 'Secret' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Leaderboard Table -->
        @if(!empty($result['leaderboard']) && count($result['leaderboard']) > 0)
            <div class="bg-white dark:bg-[#140C26] rounded-3xl border border-purple-100 dark:border-purple-900/30 p-6 sm:p-8 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-purple-50 dark:border-purple-900/30 pb-3">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white flex items-center gap-2 font-serif">
                        <span>🏆</span> {{ $result['creator_name'] }}'s Leaderboard
                    </h3>
                    <span class="text-xs font-bold text-slate-400">{{ count($result['leaderboard']) }} Friends</span>
                </div>

                <div class="divide-y divide-purple-50 dark:divide-purple-900/30">
                    @foreach($result['leaderboard'] as $i => $item)
                        @php
                            $isCurrentAttempt = ($item['id'] ?? null) == ($result['attempt_id'] ?? 0);
                        @endphp
                        <div class="py-3 flex items-center justify-between gap-4 {{ $isCurrentAttempt ? 'bg-purple-50/60 dark:bg-purple-950/40 px-3 -mx-3 rounded-xl' : '' }}">
                            <div class="flex items-center gap-3">
                                <span class="w-6 text-center font-black {{ $i === 0 ? 'text-amber-500 text-base' : 'text-slate-400 text-xs' }}">
                                    {{ $i === 0 ? '👑' : $i + 1 }}
                                </span>
                                <div>
                                    <span class="font-bold text-sm text-slate-900 dark:text-white">
                                        {{ $item['friend_name'] }}
                                        @if($isCurrentAttempt)
                                            <span class="ml-1 text-[10px] font-bold uppercase text-[#8B5CF6] dark:text-purple-300">(You)</span>
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold text-slate-600 dark:text-slate-300">
                                    {{ $item['score'] }}/{{ $item['total_questions'] }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $item['percentage'] >= 70 ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300' : 'bg-purple-100 text-[#8B5CF6] dark:bg-purple-950/60 dark:text-purple-300' }}">
                                    {{ $item['percentage'] }}%
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Bottom CTA -->
        <div class="p-8 rounded-3xl bg-gradient-to-r from-[#281858] via-[#432379] to-[#8B5CF6] text-white text-center space-y-4 shadow-xl">
            <h3 class="text-2xl sm:text-3xl font-bold font-serif">
                Dare {{ $result['creator_name'] }} Back! 🕊️
            </h3>
            <p class="text-sm sm:text-base text-purple-100/90 max-w-md mx-auto font-normal">
                Craft your own connection dare now. See how well {{ $result['creator_name'] }} understands your feelings and preferences!
            </p>
            <a href="{{ route('quizzes.index') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-white text-[#281858] font-bold text-base shadow-lg hover:bg-purple-100 hover:scale-105 transition-all">
                <span>Create My Connection Dare</span>
                <span>💜</span>
            </a>
        </div>

    </div>
</div>
@endsection
