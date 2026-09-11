<div id="cookie-consent-banner" class="fixed bottom-4 left-4 right-4 sm:left-auto sm:right-6 sm:max-w-md z-50 transform transition-all duration-500 translate-y-24 opacity-0 pointer-events-none">
    <div class="p-6 rounded-3xl bg-white/95 dark:bg-[#180E2B]/95 backdrop-blur-xl border border-purple-100 dark:border-purple-900/60 shadow-2xl space-y-4">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 flex items-center justify-center shrink-0 text-xl shadow-xs">
                🌸
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-900 dark:text-white">Your Privacy Matters to Us</h4>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mt-1">
                    We use cookies to ensure you receive a compassionate, secure browsing experience. Read our 
                    <a href="{{ route('pages.cookies') }}" class="text-purple-700 dark:text-purple-400 font-semibold underline hover:text-purple-900">Cookie Policy</a>.
                </p>
            </div>
        </div>

        <div class="flex items-center justify-end gap-2.5 pt-1">
            <button type="button" 
                    onclick="acceptCaringCookies('essential')" 
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-300 hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                Essential Only
            </button>
            <button type="button" 
                    onclick="acceptCaringCookies('all')" 
                    class="px-5 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-purple-600 to-rose-500 hover:from-purple-500 hover:to-rose-400 text-white shadow-md transition-all">
                Accept All
            </button>
        </div>
    </div>
</div>

<script>
    function checkCaringCookieConsent() {
        const consent = localStorage.getItem('cc_cookie_consent');
        if (!consent) {
            setTimeout(() => {
                const banner = document.getElementById('cookie-consent-banner');
                if (banner) {
                    banner.classList.remove('translate-y-24', 'opacity-0', 'pointer-events-none');
                    banner.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
                }
            }, 1200);
        }
    }

    function acceptCaringCookies(preference) {
        localStorage.setItem('cc_cookie_consent', preference);
        const banner = document.getElementById('cookie-consent-banner');
        if (banner) {
            banner.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
            banner.classList.add('translate-y-24', 'opacity-0', 'pointer-events-none');
        }
    }

    document.addEventListener('DOMContentLoaded', checkCaringCookieConsent);
</script>
