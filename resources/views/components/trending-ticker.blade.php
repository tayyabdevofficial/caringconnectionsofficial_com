@props(['topics' => []])

@if(!empty($topics) && count($topics) > 0)
<div class="bg-gradient-to-r from-[#281858] via-[#3B1C71] to-[#281858] text-purple-100 text-xs py-2 px-4 overflow-hidden border-b border-purple-900/50">
    <div class="max-w-7xl mx-auto flex items-center gap-3">
        <div class="flex items-center gap-1.5 shrink-0 font-bold uppercase tracking-wider text-[11px] text-purple-300">
            <span class="inline-block w-2 h-2 rounded-full bg-rose-400 animate-ping"></span>
            <span class="inline-block">💜 Wellness Wire:</span>
        </div>
        <div class="overflow-x-auto no-scrollbar flex items-center gap-4 text-xs whitespace-nowrap">
            @foreach($topics as $topic)
                <a href="{{ route('search', ['q' => $topic['name'] ?? $topic]) }}" class="hover:text-white transition-colors flex items-center gap-1">
                    <span class="text-purple-400">#</span>{{ $topic['name'] ?? $topic }}
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif
