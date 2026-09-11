<div id="search-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">
    <!-- Backdrop with blur -->
    <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-opacity" onclick="closeSearchModal()"></div>

    <div class="min-h-screen px-4 text-center flex items-center justify-center py-12">
        <div class="relative w-full max-w-2xl transform overflow-hidden rounded-3xl bg-white dark:bg-[#180E2B] p-6 sm:p-8 text-left shadow-2xl transition-all border border-purple-100 dark:border-purple-900/60">
            <!-- Modal Header / Search Form -->
            <form action="{{ route('search') }}" method="GET" class="relative">
                <div class="relative flex items-center">
                    <svg class="pointer-events-none absolute left-4 h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="search" 
                           name="q" 
                           id="modal-search-input"
                           placeholder="Search wellness, empathy, caregiving, mental health..." 
                           class="w-full rounded-2xl bg-purple-50/70 dark:bg-[#120822] py-4 pl-12 pr-28 text-slate-900 dark:text-white placeholder-purple-400/70 focus:outline-none focus:ring-2 focus:ring-purple-500 font-medium text-base sm:text-lg border border-purple-100 dark:border-purple-900/40">
                    <button type="submit" class="absolute right-2 px-4 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-rose-500 hover:from-purple-500 hover:to-rose-400 text-white font-medium text-sm transition-colors shadow-sm">
                        Search
                    </button>
                </div>
            </form>

            <!-- Quick Suggestions -->
            <div class="mt-6">
                <p class="text-xs font-semibold uppercase tracking-wider text-purple-500/80 dark:text-purple-400 mb-3">Popular Topics</p>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('search', ['q' => 'Wellness']) }}" class="px-3 py-1.5 rounded-xl text-xs font-medium bg-purple-50 hover:bg-purple-100 dark:bg-[#201338] dark:hover:bg-[#2C1B4C] text-purple-700 dark:text-purple-300 transition-colors">
                        🌸 Wellness
                    </a>
                    <a href="{{ route('search', ['q' => 'Caregiving']) }}" class="px-3 py-1.5 rounded-xl text-xs font-medium bg-purple-50 hover:bg-purple-100 dark:bg-[#201338] dark:hover:bg-[#2C1B4C] text-purple-700 dark:text-purple-300 transition-colors">
                        🤝 Caregiving
                    </a>
                    <a href="{{ route('search', ['q' => 'Mental Health']) }}" class="px-3 py-1.5 rounded-xl text-xs font-medium bg-purple-50 hover:bg-purple-100 dark:bg-[#201338] dark:hover:bg-[#2C1B4C] text-purple-700 dark:text-purple-300 transition-colors">
                        🧠 Mental Health
                    </a>
                    <a href="{{ route('search', ['q' => 'Senior Living']) }}" class="px-3 py-1.5 rounded-xl text-xs font-medium bg-purple-50 hover:bg-purple-100 dark:bg-[#201338] dark:hover:bg-[#2C1B4C] text-purple-700 dark:text-purple-300 transition-colors">
                        🏡 Senior Living
                    </a>
                    <a href="{{ route('search', ['q' => 'Kindness']) }}" class="px-3 py-1.5 rounded-xl text-xs font-medium bg-purple-50 hover:bg-purple-100 dark:bg-[#201338] dark:hover:bg-[#2C1B4C] text-purple-700 dark:text-purple-300 transition-colors">
                        💖 Kindness
                    </a>
                </div>
            </div>

            <!-- Footer Hint -->
            <div class="mt-6 pt-4 border-t border-purple-100 dark:border-purple-900/60 flex items-center justify-between text-xs text-slate-400 dark:text-slate-500">
                <span>Press <kbd class="px-1.5 py-0.5 rounded bg-purple-100 dark:bg-[#201338] text-purple-700 dark:text-purple-300 font-mono">ESC</kbd> to close</span>
                <span>Press <kbd class="px-1.5 py-0.5 rounded bg-purple-100 dark:bg-[#201338] text-purple-700 dark:text-purple-300 font-mono">↵ Enter</kbd> to search</span>
            </div>
        </div>
    </div>
</div>

<script>
    function openSearchModal() {
        const modal = document.getElementById('search-modal');
        if (modal) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('modal-search-input')?.focus();
            }, 100);
        }
    }

    function closeSearchModal() {
        const modal = document.getElementById('search-modal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            openSearchModal();
        }
        if (e.key === 'Escape') {
            closeSearchModal();
        }
    });
</script>
