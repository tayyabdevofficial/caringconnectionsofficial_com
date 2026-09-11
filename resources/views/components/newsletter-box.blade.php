<div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#281858] via-[#3B1C71] to-[#1E1038] text-white p-8 sm:p-12 shadow-2xl border border-purple-800/60 my-10">
    <!-- Decorative background glow -->
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-rose-500/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 max-w-2xl mx-auto text-center space-y-4">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white/10 backdrop-blur-md border border-white/10 text-purple-200">
            <span>💌</span>
            <span>The Caring Circle</span>
        </div>

        <h2 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-tight">
            Nourish Your Heart with Weekly Kindness
        </h2>

        <p class="text-xs sm:text-sm text-purple-200 leading-relaxed max-w-lg mx-auto">
            Join thousands of compassionate readers receiving gentle wellness insights, uplifting stories, and heartwarming community support.
        </p>

        <div id="newsletter-msg" class="hidden p-3.5 rounded-2xl text-sm font-medium"></div>

        <form id="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-2 max-w-md mx-auto pt-2">
            @csrf
            <input type="email" 
                   name="email" 
                   required 
                   placeholder="Enter your email address..." 
                   class="flex-1 px-4 py-3 rounded-2xl bg-white/10 border border-white/20 text-white placeholder-purple-300 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 backdrop-blur-md">
            <button type="submit" 
                    id="newsletter-btn"
                    class="px-6 py-3 rounded-2xl font-bold text-sm bg-gradient-to-r from-purple-500 to-rose-500 hover:from-purple-400 hover:to-rose-400 text-white shadow-lg shadow-purple-900/40 transition-all hover:scale-102 shrink-0">
                Join Circle
            </button>
        </form>

        <p class="text-[11px] text-purple-300/80 pt-1">
            🔒 Zero spam. Unsubscribe anytime with 1 click.
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nForm = document.getElementById('newsletter-form');
        const nMsg = document.getElementById('newsletter-msg');
        const nBtn = document.getElementById('newsletter-btn');

        if (nForm) {
            nForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                nBtn.disabled = true;
                const oldText = nBtn.textContent;
                nBtn.textContent = 'Joining...';
                nMsg.classList.add('hidden');

                try {
                    const formData = new FormData(nForm);
                    const res = await fetch(nForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await res.json();
                    if (res.ok) {
                        nMsg.className = 'p-3.5 rounded-2xl bg-emerald-500/20 border border-emerald-400/40 text-emerald-200 text-sm font-medium';
                        nMsg.textContent = data.message || 'Thank you for joining the Caring Connections circle!';
                        nMsg.classList.remove('hidden');
                        nForm.reset();
                    } else {
                        nMsg.className = 'p-3.5 rounded-2xl bg-rose-500/20 border border-rose-400/40 text-rose-200 text-sm font-medium';
                        nMsg.textContent = data.message || 'Unable to subscribe. Please try again.';
                        nMsg.classList.remove('hidden');
                    }
                } catch (err) {
                    nMsg.className = 'p-3.5 rounded-2xl bg-rose-500/20 border border-rose-400/40 text-rose-200 text-sm font-medium';
                    nMsg.textContent = 'An unexpected error occurred. Please try again later.';
                    nMsg.classList.remove('hidden');
                } finally {
                    nBtn.disabled = false;
                    nBtn.textContent = oldText;
                }
            });
        }
    });
</script>
