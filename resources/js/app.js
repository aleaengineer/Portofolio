import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**
 * Scroll-reveal: tambah .is-visible saat [data-reveal] masuk viewport.
 * Dukung delay via data-reveal-delay="150" (ms).
 */
function initReveal() {
    const els = document.querySelectorAll('[data-reveal]:not(.is-visible)');
    if (!('IntersectionObserver' in window) || els.length === 0) {
        els.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                const delay = Number.parseInt(el.dataset.revealDelay ?? '0', 10);
                window.setTimeout(() => el.classList.add('is-visible'), Number.isNaN(delay) ? 0 : delay);
                observer.unobserve(el);
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -8% 0px' },
    );

    els.forEach((el) => {
        if (reduceMotion) {
            el.classList.add('is-visible');
        } else {
            observer.observe(el);
        }
    });
}

/**
 * Counter animasi: [data-count-to="42"] mencacah 0 -> target saat terlihat.
 */
function initCounters() {
    const els = document.querySelectorAll('[data-count-to]');
    if (els.length === 0) return;

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const animate = (el) => {
        const target = Number.parseFloat(el.dataset.countTo ?? '0');
        if (Number.isNaN(target)) return;
        const duration = Number.parseInt(el.dataset.countDuration ?? '1200', 10);

        if (reduceMotion || duration <= 0) {
            el.textContent = formatCount(target);
            return;
        }

        const start = performance.now();
        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            // easeOutCubic
            const eased = 1 - (1 - progress) ** 3;
            el.textContent = formatCount(target * eased);
            if (progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    };

    const formatCount = (value) => {
        const rounded = Math.round(value);
        return rounded.toLocaleString('id-ID');
    };

    if (!('IntersectionObserver' in window)) {
        els.forEach(animate);
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                animate(entry.target);
                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.4 },
    );

    els.forEach((el) => observer.observe(el));
}

/**
 * Lightbox global: klik [data-lightbox] membuka overlay fullscreen.
 * Grup navigasi via data-lightbox-group="nama-grup".
 */
function initLightbox() {
    const overlay = document.getElementById('lightbox');
    if (!overlay) return;
    const img = overlay.querySelector('[data-lightbox-image]');
    const caption = overlay.querySelector('[data-lightbox-caption]');
    const prevBtn = overlay.querySelector('[data-lightbox-prev]');
    const nextBtn = overlay.querySelector('[data-lightbox-next]');
    let groupItems = [];
    let currentIndex = -1;

    const showItem = (index) => {
        if (groupItems.length === 0) return;
        currentIndex = (index + groupItems.length) % groupItems.length;
        const item = groupItems[currentIndex];
        img.src = item.src;
        img.alt = item.alt;
        if (caption) caption.textContent = item.caption;
        const single = groupItems.length <= 1;
        prevBtn?.classList.toggle('hidden', single);
        nextBtn?.classList.toggle('hidden', single);
    };

    const open = (trigger) => {
        const group = trigger.dataset.lightboxGroup;
        if (group) {
            groupItems = [...document.querySelectorAll(`[data-lightbox][data-lightbox-group="${group}"]`)].map((el) => ({
                src: el.dataset.lightbox ?? el.getAttribute('href') ?? el.src,
                alt: el.dataset.lightboxAlt ?? el.querySelector('img')?.alt ?? '',
                caption: el.dataset.lightboxCaption ?? '',
            }));
            currentIndex = groupItems.findIndex(
                (item) => item.src === (trigger.dataset.lightbox ?? trigger.getAttribute('href') ?? trigger.src),
            );
        } else {
            groupItems = [
                {
                    src: trigger.dataset.lightbox ?? trigger.getAttribute('href') ?? trigger.src,
                    alt: trigger.dataset.lightboxAlt ?? trigger.querySelector('img')?.alt ?? '',
                    caption: trigger.dataset.lightboxCaption ?? '',
                },
            ];
            currentIndex = 0;
        }
        showItem(currentIndex < 0 ? 0 : currentIndex);
        overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    };

    const close = () => {
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        img.removeAttribute('src');
        groupItems = [];
        currentIndex = -1;
    };

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-lightbox]');
        if (!trigger) return;
        // Biarkan link tanpa grup tetap dinavigasi bila user Ctrl/Cmd+klik.
        if (event.metaKey || event.ctrlKey) return;
        event.preventDefault();
        open(trigger);
    });

    overlay.addEventListener('click', (event) => {
        if (event.target.closest('[data-lightbox-close]') || event.target === overlay) close();
    });

    prevBtn?.addEventListener('click', (event) => {
        event.stopPropagation();
        showItem(currentIndex - 1);
    });
    nextBtn?.addEventListener('click', (event) => {
        event.stopPropagation();
        showItem(currentIndex + 1);
    });

    document.addEventListener('keydown', (event) => {
        if (overlay.classList.contains('hidden')) return;
        if (event.key === 'Escape') close();
        if (event.key === 'ArrowLeft') showItem(currentIndex - 1);
        if (event.key === 'ArrowRight') showItem(currentIndex + 1);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initReveal();
    initCounters();
    initLightbox();
});
