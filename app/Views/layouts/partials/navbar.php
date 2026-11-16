<?php

declare(strict_types=1);

$siteBase = rtrim((string) BASE_URL, '/') . '/';
$navigationGroups = [
    [
        'key' => 'kenitra',
        'links' => [
            ['key' => 'presentation', 'path' => 'kenitra/presentation'],
            ['key' => 'history', 'path' => 'kenitra/history'],
            ['key' => 'gallery', 'path' => 'kenitra/gallery'],
        ],
    ],
    [
        'key' => 'council',
        'links' => [
            ['key' => 'president', 'path' => 'conseil/mot-du-president'],
            ['key' => 'members', 'path' => 'conseil/membres'],
            ['key' => 'bureau', 'path' => 'conseil/bureau'],
        ],
    ],
    [
        'key' => 'administration',
        'links' => [
            ['key' => 'divisions', 'path' => 'administration/divisions'],
        ],
    ],
    [
        'key' => 'services',
        'links' => [
            ['key' => 'procedures', 'path' => 'services/document-procedures'],
            ['key' => 'urban_report', 'path' => 'services/urban-report'],
        ],
    ],
];
?>

<div class="bg-emerald-950 text-white/85 text-xs py-2 px-4 sm:px-8 border-b border-emerald-900/60">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
        <span class="inline-flex items-center gap-2 font-medium text-gold-500">
            <i data-lucide="landmark" class="w-3.5 h-3.5"></i>
            <?= t('navigation.brand_subtitle') ?>
        </span>
        <div class="flex items-center gap-4">
            <a href="tel:+212537371518" class="hidden sm:inline-flex items-center gap-1.5 hover:text-gold-500 transition-colors">
                <i data-lucide="phone-call" class="w-3.5 h-3.5 text-emerald-400"></i>
                <bdi dir="ltr">+212 5 37 37 15 18</bdi>
            </a>
            <div class="flex items-center gap-2 border-s border-emerald-800 ps-3" aria-label="<?= t('navigation.language') ?>">
                <a href="?lang=fr" lang="fr" hreflang="fr"
                    class="hover:text-white <?= \App\Core\Language::code() === 'fr' ? 'text-white font-semibold' : 'text-white/65' ?>">
                    FR
                </a>
                <span class="text-white/30">|</span>
                <a href="?lang=ar" lang="ar" hreflang="ar"
                    class="hover:text-white <?= \App\Core\Language::code() === 'ar' ? 'text-white font-semibold' : 'text-white/65' ?>">
                    العربية
                </a>
            </div>
        </div>
    </div>
</div>

<header class="site-nav sticky top-0 bg-surface/95 backdrop-blur-md border-b border-border z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 min-h-20 flex items-center justify-between gap-4">
        <a href="<?= $siteBase ?>" class="flex items-center gap-3 shrink-0" aria-label="<?= t('home') ?>">
            <span class="w-11 h-11 rounded-2xl bg-emerald-700 text-white flex items-center justify-center shadow-1 border border-emerald-600/40">
                <i data-lucide="landmark" class="w-6 h-6 text-gold-500"></i>
            </span>
            <span class="flex flex-col">
                <span class="font-display font-bold text-base sm:text-lg text-ink leading-tight"><?= t('navigation.brand_name') ?></span>
                <span class="text-[10px] sm:text-xs text-muted"><?= t('navigation.brand_tagline') ?></span>
            </span>
        </a>

        <nav class="hidden xl:flex items-center gap-1 text-xs font-medium text-ink" aria-label="<?= t('navigation.main_menu') ?>">
            <?php foreach ($navigationGroups as $group): ?>
                <details class="relative">
                    <summary class="list-none cursor-pointer flex items-center gap-1 px-2.5 py-2 rounded-full hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                        <?= t('navigation.groups.' . $group['key']) ?>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-muted"></i>
                    </summary>
                    <div class="nav-dropdown absolute start-0 top-full w-60 bg-surface border border-border rounded-2xl shadow-3 p-2 text-sm z-50">
                        <?php foreach ($group['links'] as $link): ?>
                            <a href="<?= $siteBase . $link['path'] ?>"
                                class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                                <?= t('navigation.links.' . $link['key']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </details>
            <?php endforeach; ?>
            <a href="<?= $siteBase ?>actualites" class="px-2.5 py-2 rounded-full hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                <?= t('navigation.news') ?>
            </a>
            <a href="<?= $siteBase ?>contact" class="px-2.5 py-2 rounded-full hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                <?= t('contact') ?>
            </a>
        </nav>

        <a href="<?= $siteBase ?>services/document-procedures"
            class="hidden lg:inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-600 text-white font-semibold text-xs px-4 py-2.5 rounded-full shadow-1 transition-colors shrink-0">
            <i data-lucide="file-check-2" class="w-4 h-4 text-gold-500"></i>
            <?= t('navigation.online_service') ?>
        </a>

        <details class="relative xl:hidden">
            <summary class="list-none cursor-pointer w-10 h-10 rounded-xl border border-border flex items-center justify-center text-emerald-800 hover:bg-emerald-50"
                aria-label="<?= t('navigation.open_menu') ?>">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </summary>
            <nav class="absolute end-0 top-full mt-2 w-[min(90vw,22rem)] max-h-[75vh] overflow-y-auto bg-surface border border-border rounded-2xl shadow-3 p-3 z-50"
                aria-label="<?= t('navigation.main_menu') ?>">
                <?php foreach ($navigationGroups as $group): ?>
                    <section class="py-2 border-b border-border last:border-0">
                        <h2 class="px-2.5 pb-1 text-[11px] font-bold uppercase tracking-wider text-emerald-700">
                            <?= t('navigation.groups.' . $group['key']) ?>
                        </h2>
                        <?php foreach ($group['links'] as $link): ?>
                            <a href="<?= $siteBase . $link['path'] ?>"
                                class="block p-2.5 rounded-xl text-sm hover:bg-emerald-50 hover:text-emerald-700">
                                <?= t('navigation.links.' . $link['key']) ?>
                            </a>
                        <?php endforeach; ?>
                    </section>
                <?php endforeach; ?>
                <a href="<?= $siteBase ?>actualites" class="block p-2.5 rounded-xl text-sm hover:bg-emerald-50 hover:text-emerald-700">
                    <?= t('navigation.news') ?>
                </a>
                <a href="<?= $siteBase ?>contact" class="block p-2.5 rounded-xl text-sm hover:bg-emerald-50 hover:text-emerald-700">
                    <?= t('contact') ?>
                </a>
                <a href="<?= $siteBase ?>services/document-procedures" class="block p-2.5 mt-1 rounded-xl text-sm font-semibold text-emerald-800 bg-emerald-50 hover:bg-emerald-100">
                    <?= t('navigation.online_service') ?>
                </a>
            </nav>
        </details>
    </div>
</header>

<style>
    .site-nav details[open] > .nav-dropdown {
        display: block;
    }

    .site-nav summary::-webkit-details-marker {
        display: none;
    }

    .site-nav .nav-dropdown {
        display: none;
    }
</style>
