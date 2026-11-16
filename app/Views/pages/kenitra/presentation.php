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
                <?= t('kenitra.presentation.breadcrumb_current') ?>
            </span>
        </nav>

        <h1 class="font-display text-3xl sm:text-5xl font-bold tracking-tight text-center mb-8">
            <?= t('kenitra.presentation.hero_title') ?>
        </h1>

        <div class="space-y-5 text-emerald-100/85 text-sm sm:text-base leading-relaxed text-justify">
            <p>
            <?= t('kenitra.presentation.paragraph_1') ?>
            </p>
            <p>
            <?= t('kenitra.presentation.paragraph_2') ?>
            </p>
        </div>
    </div>
</section>