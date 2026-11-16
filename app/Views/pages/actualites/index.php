<?php

declare(strict_types=1);

$posts = [
    [
        'image' => 'gallery-1.jpg',
        'category' => 'category_actualite',
        'filter' => 'actualite',
        'translation' => 'post_1',
    ],
    [
        'image' => 'gallery-2.jpg',
        'category' => 'category_avis',
        'filter' => 'avis',
        'translation' => 'post_2',
    ],
    [
        'image' => 'gallery-3.jpg',
        'category' => 'category_evenement',
        'filter' => 'evenement',
        'translation' => 'post_3',
    ],
    [
        'image' => 'gallery-4.jpg',
        'category' => 'category_travaux',
        'filter' => 'travaux',
        'translation' => 'post_4',
    ],
];

$e = static function (string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
};
?>

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
    <div class="max-w-4xl mx-auto text-center relative z-10">
        <nav class="flex items-center justify-center gap-2 text-xs text-emerald-200/70 mb-5">
            <a href="<?= BASE_URL ?>" class="hover:text-white">
                <?= t('kenitra.presentation.breadcrumb_home') ?>
            </a>
            <i data-lucide="chevron-right" class="w-3 h-3 icon-dir"></i>
            <span class="text-gold-500 font-medium"><?= t('actualites.breadcrumb_current') ?></span>
        </nav>

        <h1 class="font-display text-3xl sm:text-5xl font-bold tracking-tight mb-5">
            <?= t('actualites.hero_title') ?>
        </h1>
        <p class="text-emerald-100/85 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            <?= t('actualites.hero_description') ?>
        </p>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full">
    <aside class="mb-8 p-4 rounded-xl bg-sand-100 border border-gold-500/20 text-xs sm:text-sm text-muted">
        <div class="flex items-start gap-3">
            <i data-lucide="info" class="w-5 h-5 text-gold-600 shrink-0"></i>
            <p><?= t('actualites.demo_notice') ?></p>
        </div>
    </aside>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <h2 class="font-display text-2xl sm:text-3xl font-bold text-ink">
            <?= t('actualites.section_title') ?>
        </h2>
        <div class="flex flex-wrap gap-2" role="group" aria-label="<?= t('actualites.filter_label') ?>">
            <button type="button" data-post-filter="all" aria-pressed="true"
                class="post-filter bg-emerald-700 border border-emerald-700 text-white text-xs font-semibold px-4 py-2 rounded-full transition-colors">
                <?= t('actualites.filter_all') ?>
            </button>
            <button type="button" data-post-filter="actualite" aria-pressed="false"
                class="post-filter bg-surface border border-border text-ink text-xs font-semibold px-4 py-2 rounded-full hover:bg-emerald-50 transition-colors">
                <?= t('actualites.category_actualite') ?>
            </button>
            <button type="button" data-post-filter="avis" aria-pressed="false"
                class="post-filter bg-surface border border-border text-ink text-xs font-semibold px-4 py-2 rounded-full hover:bg-emerald-50 transition-colors">
                <?= t('actualites.category_avis') ?>
            </button>
            <button type="button" data-post-filter="evenement" aria-pressed="false"
                class="post-filter bg-surface border border-border text-ink text-xs font-semibold px-4 py-2 rounded-full hover:bg-emerald-50 transition-colors">
                <?= t('actualites.category_evenement') ?>
            </button>
            <button type="button" data-post-filter="travaux" aria-pressed="false"
                class="post-filter bg-surface border border-border text-ink text-xs font-semibold px-4 py-2 rounded-full hover:bg-emerald-50 transition-colors">
                <?= t('actualites.category_travaux') ?>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($posts as $post): ?>
            <?php $titleKey = 'actualites.' . $post['translation'] . '_title'; ?>
            <article data-post-category="<?= $e($post['filter']) ?>"
                class="news-post bg-surface rounded-2xl overflow-hidden border border-border shadow-1 hover:shadow-2 transition-shadow">
                <img src="<?= BASE_URL ?>assets/images/mediatheque/<?= $e($post['image']) ?>"
                    alt="<?= t($titleKey) ?>" loading="lazy" decoding="async"
                    class="w-full aspect-[16/10] object-cover">
                <div class="p-5">
                    <div class="flex items-center justify-between gap-3 mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                            <?= t('actualites.' . $post['category']) ?>
                        </span>
                        <span class="text-[10px] font-semibold text-muted bg-bg px-2.5 py-1 rounded-full">
                            <?= t('actualites.demo_label') ?>
                        </span>
                    </div>
                    <h3 class="font-display font-bold text-base text-ink mb-2">
                        <?= t($titleKey) ?>
                    </h3>
                    <p class="text-xs text-muted leading-relaxed">
                        <?= t('actualites.' . $post['translation'] . '_description') ?>
                    </p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<script>
    const postFilters = document.querySelectorAll('.post-filter');
    const newsPosts = document.querySelectorAll('.news-post');

    postFilters.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.dataset.postFilter;

            postFilters.forEach(filterButton => {
                const isActive = filterButton === button;
                filterButton.setAttribute('aria-pressed', String(isActive));
                filterButton.classList.toggle('bg-emerald-700', isActive);
                filterButton.classList.toggle('border-emerald-700', isActive);
                filterButton.classList.toggle('text-white', isActive);
                filterButton.classList.toggle('bg-surface', !isActive);
                filterButton.classList.toggle('border-border', !isActive);
                filterButton.classList.toggle('text-ink', !isActive);
            });

            newsPosts.forEach(post => {
                post.classList.toggle(
                    'hidden',
                    filter !== 'all' && post.dataset.postCategory !== filter
                );
            });
        });
    });
</script>
