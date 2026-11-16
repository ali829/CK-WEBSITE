<?php

declare(strict_types=1);

$members = [
    ['مينة حروزى', 'president'],
    ['نادية تيقار', 'vice_president_1'],
    ['ادريس شنتوف', 'vice_president_2'],
    ['عبد الكريم شهيد', 'vice_president_3'],
    ['الحسين مفتي', 'vice_president_4'],
    ['الطويل السباعي', 'vice_president_5'],
    ['سمير الأعرج', 'vice_president_6'],
    ['فاطمة بعبوس', 'vice_president_7'],
    ['خديجة هيسوفا', 'vice_president_8'],
    ['أحمد الدحيم', 'vice_president_9'],
    ['ابراهيم بوريش', 'vice_president_10'],
    ['محمد تاجي', null],
    ['بدر الدين بلخيري', null],
    ['كوثر حريف', null],
    ['أحمد باحنايك', null],
    ['محمد خلاخيل', null],
    ['نضيرة رفيق الدين', null],
    ['فاطمة الزهراء الدكالي', null],
    ['عبد الله مبيريك', null],
    ['أحمد الهيقي', null],
    ['رشيد بلمقيصية', null],
    ['عبد الحق بشري', null],
    ['حسن غويلة', null],
    ['ربيع الشيهب', null],
    ['أيوب الغباشي', null],
    ['خمار المرابطي', null],
    ['خديجة هدي', null],
    ['نعيمة هدي', null],
    ['المصطفى نعينيع', null],
    ['لحسن آيت كازو', null],
    ['اعلي زبط', null],
    ['عبد الحق عبروق', null],
    ['مليكة بوشرقي', null],
    ['عبد الكريم أوزروال', null],
    ['كمال الرعيدي', null],
    ['عبد الله الورثي', null],
    ['سناء بوشكوة', null],
    ['نجلاء الدهاجي', null],
    ['حاتم بكار', null],
    ['محمد الفطيح', null],
    ['نسرين دارو', null],
    ['فوزي الشعبي', null],
    ['زينب حساني', null],
    ['أحمد الصياد', null],
    ['زينب الشراط', null],
    ['محمد العزري', null],
    ['رضى عليجة', null],
    ['رقية الرميد', null],
    ['رشيدة صادقي', null],
    ['جرية حاجي', null],
    ['عامر النميش', null],
    ['عبد الكريم علاوي', null],
    ['عبد العالي فراح', null],
    ['نزهة بطشي', null],
    ['عبد الرزاق بد', null],
    ['محمد تلموست', null],
    ['بشرى بوحديوي', null],
    ['خيرة النهاري', null],
];

$memberCount = count($members);
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
            <span class="text-gold-500 font-medium"><?= t('conseil.breadcrumb_current') ?></span>
        </nav>

        <h1 class="font-display text-3xl sm:text-5xl font-bold tracking-tight mb-4">
            <?= t('conseil.hero_title') ?>
        </h1>
        <p class="text-emerald-100/85 text-sm sm:text-base max-w-2xl mx-auto mb-8">
            <?= sprintf(t('conseil.hero_description'), $memberCount) ?>
        </p>

        <div class="max-w-xs mx-auto pt-6 border-t border-emerald-800">
            <div class="bg-emerald-950/60 p-4 rounded-2xl border border-emerald-800">
                <span class="text-2xl font-bold text-gold-500 font-display"><?= $memberCount ?></span>
                <p class="text-xs text-emerald-100/70 mt-1"><?= t('conseil.member_count_label') ?></p>
            </div>
        </div>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full">
    <h2 class="font-display text-xl sm:text-2xl font-bold text-ink mb-6">
        <?= t('conseil.list_heading') ?>
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($members as $index => [$name, $role]): ?>
            <article
                class="bg-surface rounded-2xl p-5 border border-border shadow-1 hover:shadow-2 transition-shadow flex items-start gap-4">
                <span
                    class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-display font-bold text-sm shrink-0">
                    <?= $index + 1 ?>
                </span>
                <div class="min-w-0">
                    <h3 dir="auto" class="font-display font-bold text-base text-ink leading-snug">
                        <?= $e($name) ?>
                    </h3>
                    <p class="text-xs text-muted mt-1">
                        <?= t('conseil.' . ($role ?? 'member_role')) ?>
                    </p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</main>
