<?php

declare(strict_types=1);

$presidentName = 'مينة حروزى';

$vicePresidents = [
    ['name' => 'نادية تقار', 'number' => 1],
    ['name' => 'ادريس شنتوف', 'number' => 2],
    ['name' => 'عبد الكريم شهيد', 'number' => 3],
    ['name' => 'الحسين مفتي', 'number' => 4],
    ['name' => 'الطويل السباعي', 'number' => 5],
    ['name' => 'سمير الأعرج', 'number' => 6],
    ['name' => 'فاطمة بعبوس', 'number' => 7],
    ['name' => 'خديجة هيسوفا', 'number' => 8],
    ['name' => 'أحمد الدحيم', 'number' => 9],
    ['name' => 'ابراهيم بوريش', 'number' => 10],
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
            <span class="text-gold-500 font-medium">
                <?= t('conseil.bureau.breadcrumb_current') ?>
            </span>
        </nav>

        <h1 class="font-display text-3xl sm:text-5xl font-bold tracking-tight mb-5">
            <?= t('conseil.bureau.hero_title') ?>
        </h1>
        <p class="text-emerald-100/85 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            <?= t('conseil.bureau.hero_description') ?>
        </p>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full">
    <aside class="mb-8 p-4 rounded-xl bg-sand-100 border border-gold-500/20 text-xs sm:text-sm text-muted">
        <div class="flex items-start gap-3">
            <i data-lucide="info" class="w-5 h-5 text-gold-600 shrink-0"></i>
            <p><?= t('conseil.bureau.translation_notice') ?></p>
        </div>
    </aside>

    <section class="bg-surface rounded-3xl p-6 sm:p-8 border border-gold-500/30 shadow-2 mb-10">
        <div class="flex items-center gap-4">
            <span class="w-12 h-12 rounded-2xl bg-gold-100 text-gold-600 flex items-center justify-center shrink-0">
                <i data-lucide="crown" class="w-6 h-6"></i>
            </span>
            <div>
                <h2 dir="auto" class="font-display font-bold text-xl sm:text-2xl text-ink">
                    <?= $e($presidentName) ?>
                </h2>
                <p class="text-sm text-emerald-700 font-semibold mt-1">
                    <?= t('conseil.president') ?>
                </p>
            </div>
        </div>
    </section>

    <h2 class="font-display text-xl sm:text-2xl font-bold text-ink mb-6">
        <?= t('conseil.bureau.vice_presidents_heading') ?>
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <?php foreach ($vicePresidents as $vicePresident): ?>
            <?php $number = $vicePresident['number']; ?>
            <article class="bg-surface rounded-2xl p-6 border border-border shadow-1 hover:shadow-2 transition-shadow">
                <div class="flex items-start gap-4 mb-5">
                    <span class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-display font-bold text-sm shrink-0">
                        <?= $number ?>
                    </span>
                    <div class="min-w-0">
                        <h3 dir="auto" class="font-display font-bold text-lg text-ink leading-snug">
                            <?= $e($vicePresident['name']) ?>
                        </h3>
                        <p class="text-xs text-emerald-700 font-semibold mt-1">
                            <?= t('conseil.vice_president_' . $number) ?>
                        </p>
                    </div>
                </div>

                <div class="pt-4 border-t border-border">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-800 mb-2">
                        <?= t('conseil.bureau.delegation_label') ?>
                    </h4>
                    <p class="text-sm text-muted leading-relaxed">
                        <?= t('conseil.bureau.delegation_' . $number) ?>
                    </p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</main>
