<div class="bg-emerald-950 text-white/85 text-xs py-2 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <a href="<?= BASE_URL ?>" class="flex items-center gap-2 hover:text-gold-500 transition-colors">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5 icon-dir"></i>
            <?= t('kenitra.presentation.utility_back') ?>
        </a>
        <span class="text-gold-500 font-semibold hidden sm:block">
            <?= t('kenitra.presentation.utility_label') ?>
        </span>
    </div>
</div>

<section class="bg-emerald-900 text-white py-14 px-4 sm:px-8 relative overflow-hidden">
    <div class="absolute inset-0 pattern-khatam pointer-events-none opacity-20"></div>
    <div class="max-w-4xl mx-auto relative z-10">
        <nav class="flex items-center justify-center gap-2 text-xs text-emerald-200/70 mb-5">
            <a href="<?= BASE_URL ?>" class="hover:text-white">
                <?= t('kenitra.presentation.breadcrumb_home') ?>
            </a>
            <i data-lucide="chevron-right" class="w-3 h-3 icon-dir"></i>
            <span class="text-gold-500 font-medium">
                <?= t('kenitra.gallery.breadcrumb_current') ?>
            </span>
        </nav>

        <h1 class="font-display text-3xl sm:text-5xl font-bold tracking-tight text-center mb-5">
            <?= t('kenitra.gallery.hero_title') ?>
        </h1>
        <p class="text-emerald-100/85 text-sm sm:text-base max-w-2xl mx-auto text-center leading-relaxed">
            <?= t('kenitra.gallery.hero_description') ?>
        </p>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <h2 class="font-display text-2xl sm:text-3xl font-bold text-ink">
            <?= t('kenitra.gallery.section_title') ?>
        </h2>
        <div class="flex flex-wrap gap-2" role="group" aria-label="<?= t('kenitra.gallery.filter_label') ?>">
            <button type="button" data-gallery-filter="all" aria-pressed="true"
                class="gallery-filter bg-emerald-700 border border-emerald-700 text-white text-xs font-semibold px-4 py-2 rounded-full transition-colors">
                <?= t('kenitra.gallery.filter_all') ?>
            </button>
            <button type="button" data-gallery-filter="photo" aria-pressed="false"
                class="gallery-filter bg-surface border border-border text-ink text-xs font-semibold px-4 py-2 rounded-full hover:bg-emerald-50 transition-colors">
                <?= t('kenitra.gallery.filter_photos') ?>
            </button>
            <button type="button" data-gallery-filter="video" aria-pressed="false"
                class="gallery-filter bg-surface border border-border text-ink text-xs font-semibold px-4 py-2 rounded-full hover:bg-emerald-50 transition-colors">
                <?= t('kenitra.gallery.filter_videos') ?>
            </button>
        </div>
    </div>

    <div id="media-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <figure data-media-type="photo"
            class="media-item bg-surface rounded-2xl overflow-hidden border border-border shadow-1 hover:shadow-2 transition-shadow">
            <img src="<?= BASE_URL ?>assets/images/mediatheque/gallery-1.jpg"
                alt="<?= t('kenitra.gallery.photo_1_title') ?>" loading="lazy" decoding="async"
                class="w-full aspect-[16/10] object-cover">
            <figcaption class="p-4 text-sm font-semibold text-ink">
                <?= t('kenitra.gallery.photo_1_title') ?>
            </figcaption>
        </figure>

        <figure data-media-type="photo"
            class="media-item bg-surface rounded-2xl overflow-hidden border border-border shadow-1 hover:shadow-2 transition-shadow">
            <img src="<?= BASE_URL ?>assets/images/mediatheque/gallery-2.jpg"
                alt="<?= t('kenitra.gallery.photo_2_title') ?>" loading="lazy" decoding="async"
                class="w-full aspect-[16/10] object-cover">
            <figcaption class="p-4 text-sm font-semibold text-ink">
                <?= t('kenitra.gallery.photo_2_title') ?>
            </figcaption>
        </figure>

        <figure data-media-type="photo"
            class="media-item bg-surface rounded-2xl overflow-hidden border border-border shadow-1 hover:shadow-2 transition-shadow">
            <img src="<?= BASE_URL ?>assets/images/mediatheque/gallery-3.jpg"
                alt="<?= t('kenitra.gallery.photo_3_title') ?>" loading="lazy" decoding="async"
                class="w-full aspect-[16/10] object-cover">
            <figcaption class="p-4 text-sm font-semibold text-ink">
                <?= t('kenitra.gallery.photo_3_title') ?>
            </figcaption>
        </figure>

        <figure data-media-type="photo"
            class="media-item bg-surface rounded-2xl overflow-hidden border border-border shadow-1 hover:shadow-2 transition-shadow">
            <img src="<?= BASE_URL ?>assets/images/mediatheque/gallery-4.jpg"
                alt="<?= t('kenitra.gallery.photo_4_title') ?>" loading="lazy" decoding="async"
                class="w-full aspect-[16/10] object-cover">
            <figcaption class="p-4 text-sm font-semibold text-ink">
                <?= t('kenitra.gallery.photo_4_title') ?>
            </figcaption>
        </figure>

        <figure data-media-type="video"
            class="media-item bg-surface rounded-2xl overflow-hidden border border-border shadow-1 hover:shadow-2 transition-shadow">
            <video controls preload="metadata" poster="<?= BASE_URL ?>assets/images/mediatheque/gallery-3.jpg"
                class="w-full aspect-[16/10] object-cover">
                <source src="<?= BASE_URL ?>assets/images/mediatheque/V16.mp4" type="video/mp4">
            </video>
            <figcaption class="p-4 text-sm font-semibold text-ink">
                <?= t('kenitra.gallery.video_title') ?>
            </figcaption>
        </figure>
    </div>
</main>

<script>
    document.querySelectorAll('.gallery-filter').forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.dataset.galleryFilter;

            document.querySelectorAll('.gallery-filter').forEach(filterButton => {
                const isActive = filterButton === button;
                filterButton.setAttribute('aria-pressed', String(isActive));
                filterButton.classList.toggle('bg-emerald-700', isActive);
                filterButton.classList.toggle('border-emerald-700', isActive);
                filterButton.classList.toggle('text-white', isActive);
                filterButton.classList.toggle('bg-surface', !isActive);
                filterButton.classList.toggle('border-border', !isActive);
                filterButton.classList.toggle('text-ink', !isActive);
            });

            document.querySelectorAll('.media-item').forEach(item => {
                const isVisible = filter === 'all' || item.dataset.mediaType === filter;
                item.classList.toggle('hidden', !isVisible);
            });
        });
    });
</script>
