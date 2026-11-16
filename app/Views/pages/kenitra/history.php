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
                <?= t('kenitra.history.breadcrumb_current') ?>
            </span>
        </nav>

        <h1 class="font-display text-3xl sm:text-5xl font-bold tracking-tight text-center mb-5">
            <?= t('kenitra.history.hero_title') ?>
        </h1>
        <p class="text-emerald-100/85 text-sm sm:text-base max-w-2xl mx-auto text-center leading-relaxed">
            <?= t('kenitra.history.hero_description') ?>
        </p>
    </div>
</section>

<main class="max-w-5xl mx-auto px-4 sm:px-8 py-12 w-full">
    <article class="bg-surface rounded-3xl p-6 sm:p-10 border border-border shadow-2 space-y-5">
        <p class="text-sm sm:text-base text-muted leading-relaxed">
            <?= t('kenitra.history.paragraph_1') ?>
        </p>
        <p class="text-sm sm:text-base text-muted leading-relaxed">
            <?= t('kenitra.history.paragraph_2') ?>
        </p>
        <p class="text-sm sm:text-base text-muted leading-relaxed">
            <?= t('kenitra.history.paragraph_3') ?>
        </p>
        <p class="text-sm sm:text-base text-muted leading-relaxed">
            <?= t('kenitra.history.paragraph_4') ?>
        </p>
        <p class="text-sm sm:text-base text-muted leading-relaxed">
            <?= t('kenitra.history.paragraph_5') ?>
        </p>
        <p class="text-sm sm:text-base text-muted leading-relaxed">
            <?= t('kenitra.history.paragraph_6') ?>
        </p>
        <p class="text-sm sm:text-base text-muted leading-relaxed">
            <?= t('kenitra.history.paragraph_7') ?>
        </p>
        <p class="text-sm sm:text-base text-muted leading-relaxed">
            <?= t('kenitra.history.paragraph_8') ?>
        </p>
        <ul class="list-disc ps-6 space-y-3 text-sm sm:text-base text-muted leading-relaxed marker:text-emerald-700">
            <li><?= t('kenitra.history.urban_partition_military') ?></li>
            <li><?= t('kenitra.history.urban_partition_european') ?></li>
            <li><?= t('kenitra.history.urban_partition_moroccan') ?></li>
        </ul>
    </article>
</main>
