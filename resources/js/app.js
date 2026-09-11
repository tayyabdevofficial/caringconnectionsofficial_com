// Caring Connections Theme Management (Default Auto with System Match)
window.toggleTheme = function () {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('cc_theme', isDark ? 'dark' : 'light');
    updateThemeIcons();
};

function updateThemeIcons() {
    const isDark = document.documentElement.classList.contains('dark');
    document.querySelectorAll('.theme-sun-icon').forEach(el => {
        el.style.display = isDark ? 'block' : 'none';
    });
    document.querySelectorAll('.theme-moon-icon').forEach(el => {
        el.style.display = isDark ? 'none' : 'block';
    });
}

// Auto change according to system if user did not manually specify
try {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('cc_theme')) {
            if (e.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            updateThemeIcons();
        }
    });
} catch (e) {}

// Copy story link utility
window.copyCaringLink = function (url) {
    navigator.clipboard.writeText(url || window.location.href).then(() => {
        showCaringToast('Story link copied to clipboard!');
    }).catch(() => {
        showCaringToast('Could not copy link.');
    });
};

window.showCaringToast = function (message, isError = false) {
    let toast = document.getElementById('caring-toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'caring-toast';
        toast.className = 'fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl shadow-2xl transition-all duration-300 transform translate-y-12 opacity-0 flex items-center gap-3 text-sm font-semibold';
        document.body.appendChild(toast);
    }
    toast.className = `fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl shadow-2xl transition-all duration-300 transform translate-y-12 opacity-0 flex items-center gap-3 text-sm font-semibold ${
        isError ? 'bg-rose-900 text-white' : 'bg-[#281858] text-white border border-purple-500/30'
    }`;
    toast.textContent = message;
    toast.classList.remove('translate-y-12', 'opacity-0');
    toast.classList.add('translate-y-0', 'opacity-100');

    setTimeout(() => {
        toast.classList.remove('translate-y-0', 'opacity-100');
        toast.classList.add('translate-y-12', 'opacity-0');
    }, 3200);
};

// Reading Progress Bar
function initReadingProgress() {
    const progressBar = document.getElementById('reading-progress-bar');
    if (!progressBar) return;

    window.addEventListener('scroll', () => {
        const winScroll = document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        if (height > 0) {
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = Math.min(100, Math.max(0, scrolled)) + '%';
        }
    }, { passive: true });
}

document.addEventListener('DOMContentLoaded', () => {
    updateThemeIcons();
    initReadingProgress();

    // Search modal keyboard shortcut (Ctrl+K or Cmd+K)
    window.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            const modal = document.getElementById('search-modal');
            if (modal) {
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                    document.getElementById('modal-search-input')?.focus();
                } else {
                    modal.classList.add('hidden');
                }
            }
        }
        if (e.key === 'Escape') {
            document.getElementById('search-modal')?.classList.add('hidden');
            if (typeof window.closeMobileNav === 'function') {
                window.closeMobileNav();
            }
        }
    });
});
