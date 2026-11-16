<?php

declare(strict_types=1);

$siteBase = rtrim((string) BASE_URL, '/') . '/';
$homeImages = $siteBase . 'assets/images/home%20page/';
$homePosts = [
    ['image' => 'gallery-1.jpg', 'category' => 'category_actualite', 'translation' => 'post_1'],
    ['image' => 'gallery-2.jpg', 'category' => 'category_avis', 'translation' => 'post_2'],
    ['image' => 'gallery-3.jpg', 'category' => 'category_evenement', 'translation' => 'post_3'],
    ['image' => 'gallery-4.jpg', 'category' => 'category_travaux', 'translation' => 'post_4'],
];
$escape = static function (string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
};
?>

<section id="home" class="relative bg-emerald-900 text-white overflow-hidden py-14 lg:py-20 border-b border-emerald-950">
    <div class="absolute inset-0 pattern-khatam pointer-events-none opacity-20"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            <div class="lg:col-span-6 flex flex-col items-start">
                <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-gold-500 mb-4">
                    <i data-lucide="landmark" class="w-4 h-4"></i>
                    <?= t('home_page.hero_eyebrow') ?>
                </span>
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-[1.12] mb-5 text-white">
                    <?= t('home_page.hero_title') ?>
                </h1>
                <p class="text-base sm:text-lg text-emerald-100/90 leading-relaxed max-w-2xl mb-8">
                    <?= t('home_page.hero_description') ?>
                </p>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="<?= $siteBase ?>services/document-procedures"
                        class="bg-gold-500 hover:bg-gold-600 text-emerald-950 font-semibold px-5 py-3 rounded-full shadow-1 transition-colors inline-flex items-center gap-2 text-sm">
                        <i data-lucide="file-check-2" class="w-4 h-4"></i>
                        <?= t('home_page.hero_primary') ?>
                    </a>
                    <a href="<?= $siteBase ?>kenitra/presentation"
                        class="bg-white/10 hover:bg-white/15 text-white border border-white/20 font-medium px-5 py-3 rounded-full transition-colors inline-flex items-center gap-2 text-sm">
                        <i data-lucide="compass" class="w-4 h-4 text-gold-500"></i>
                        <?= t('home_page.hero_secondary') ?>
                    </a>
                </div>
                <div class="mt-8 flex flex-wrap gap-x-6 gap-y-2 text-xs text-emerald-100/80">
                    <a href="<?= $siteBase ?>actualites" class="inline-flex items-center gap-2 hover:text-gold-500">
                        <span class="w-2 h-2 rounded-full bg-gold-500"></span>
                        <?= t('home_page.news_link') ?>
                    </a>
                    <a href="<?= $siteBase ?>services/urban-report" class="inline-flex items-center gap-2 hover:text-gold-500">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <?= t('home_page.report_link') ?>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6">
                <figure class="relative rounded-t-[8rem] rounded-b-3xl overflow-hidden border-4 border-gold-500/35 shadow-3 aspect-[4/3] bg-emerald-950">
                    <img src="<?= $homeImages ?>images%20(1).jpg"
                        alt="<?= t('home_page.hero_image_alt') ?>"
                        class="absolute inset-0 w-full h-full object-cover"
                        fetchpriority="high">
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/85 via-emerald-950/10 to-transparent"></div>
                    <figcaption class="absolute inset-x-5 bottom-5 sm:inset-x-7 sm:bottom-7 bg-surface/95 backdrop-blur-md text-ink p-4 sm:p-5 rounded-2xl border border-emerald-100 shadow-2">
                        <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-wider">
                            <?= t('home_page.hero_photo_label') ?>
                        </span>
                        <p class="font-display font-bold text-lg mt-1"><?= t('home_page.hero_photo_caption') ?></p>
                        <a href="<?= $siteBase ?>kenitra/gallery" class="inline-flex items-center gap-1 mt-2 text-xs font-semibold text-emerald-700 hover:text-emerald-900">
                            <?= t('home_page.gallery_link') ?>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 icon-dir"></i>
                        </a>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
</section>

<main class="flex-1">
    <section class="max-w-7xl mx-auto px-4 sm:px-8 -mt-6 relative z-20">
        <div class="bg-surface rounded-3xl p-5 sm:p-7 shadow-2 border border-border">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
                <div>
                    <span class="text-[11px] font-bold tracking-widest text-emerald-700 uppercase">
                        <?= t('home_page.quick_label') ?>
                    </span>
                    <h2 class="font-display text-xl sm:text-2xl font-bold text-ink mt-1">
                        <?= t('home_page.quick_title') ?>
                    </h2>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                <?php
                $quickLinks = [
                    ['icon' => 'file-check-2', 'label' => 'procedures', 'path' => 'services/document-procedures'],
                    ['icon' => 'triangle-alert', 'label' => 'report', 'path' => 'services/urban-report'],
                    ['icon' => 'building-2', 'label' => 'divisions', 'path' => 'administration/divisions'],
                    ['icon' => 'users', 'label' => 'members', 'path' => 'conseil/membres'],
                    ['icon' => 'newspaper', 'label' => 'news', 'path' => 'actualites'],
                    ['icon' => 'phone', 'label' => 'contact', 'path' => 'contact'],
                ];
                ?>
                <?php foreach ($quickLinks as $link): ?>
                    <a href="<?= $siteBase . $link['path'] ?>"
                        class="flex flex-col items-center text-center p-3 rounded-2xl border border-transparent hover:border-emerald-100 hover:bg-emerald-50 transition-colors group">
                        <span class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-2 group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                            <i data-lucide="<?= $escape($link['icon']) ?>" class="w-5 h-5"></i>
                        </span>
                        <span class="text-xs font-semibold text-ink group-hover:text-emerald-700">
                            <?= t('home_page.quick_links.' . $link['label']) ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-8 py-16 sm:py-20">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold tracking-widest text-emerald-700 uppercase bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                <?= t('home_page.services_label') ?>
            </span>
            <h2 class="font-display text-3xl sm:text-4xl font-bold text-ink mt-4">
                <?= t('home_page.services_title') ?>
            </h2>
            <p class="text-muted text-sm sm:text-base mt-3 leading-relaxed">
                <?= t('home_page.services_description') ?>
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php
            $serviceCards = [
                ['icon' => 'file-text', 'title' => 'procedures_title', 'description' => 'procedures_description', 'path' => 'services/document-procedures'],
                ['icon' => 'triangle-alert', 'title' => 'report_title', 'description' => 'report_description', 'path' => 'services/urban-report'],
                ['icon' => 'building-2', 'title' => 'divisions_title', 'description' => 'divisions_description', 'path' => 'administration/divisions'],
                ['icon' => 'message-square', 'title' => 'contact_title', 'description' => 'contact_description', 'path' => 'contact'],
            ];
            ?>
            <?php foreach ($serviceCards as $card): ?>
                <a href="<?= $siteBase . $card['path'] ?>"
                    class="bg-surface rounded-2xl p-6 border border-border shadow-1 hover:shadow-2 hover:-translate-y-0.5 transition-all group">
                    <span class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-5 group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                        <i data-lucide="<?= $escape($card['icon']) ?>" class="w-6 h-6"></i>
                    </span>
                    <h3 class="font-display font-bold text-lg text-ink mb-2 group-hover:text-emerald-700">
                        <?= t('home_page.services_cards.' . $card['title']) ?>
                    </h3>
                    <p class="text-xs text-muted leading-relaxed">
                        <?= t('home_page.services_cards.' . $card['description']) ?>
                    </p>
                    <span class="inline-flex items-center gap-1 mt-5 text-xs font-semibold text-emerald-700">
                        <?= t('home_page.discover_link') ?>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 icon-dir"></i>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bg-white border-y border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 sm:py-16 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div class="relative">
                <img src="<?= $homeImages ?>images.jpg" alt="<?= t('home_page.city_image_alt') ?>"
                    loading="lazy" decoding="async"
                    class="w-full aspect-[16/10] object-cover rounded-t-[7rem] rounded-b-3xl border-4 border-gold-500/25 shadow-2">
                <a href="<?= $siteBase ?>kenitra/gallery"
                    class="absolute bottom-4 end-4 inline-flex items-center gap-2 bg-surface/95 text-emerald-800 px-4 py-2.5 rounded-full text-xs font-semibold shadow-2 hover:bg-white">
                    <i data-lucide="images" class="w-4 h-4"></i>
                    <?= t('home_page.gallery_link') ?>
                </a>
            </div>
            <div>
                <span class="text-xs font-bold tracking-widest text-emerald-700 uppercase">
                    <?= t('home_page.city_label') ?>
                </span>
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-ink mt-2 mb-4">
                    <?= t('home_page.city_title') ?>
                </h2>
                <p class="text-sm text-muted leading-relaxed mb-6">
                    <?= t('home_page.city_description') ?>
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="<?= $siteBase ?>kenitra/presentation"
                        class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-600 text-white px-5 py-3 rounded-full text-sm font-semibold transition-colors">
                        <?= t('navigation.links.presentation') ?>
                        <i data-lucide="arrow-right" class="w-4 h-4 icon-dir"></i>
                    </a>
                    <a href="<?= $siteBase ?>kenitra/history"
                        class="inline-flex items-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 px-5 py-3 rounded-full text-sm font-semibold transition-colors">
                        <?= t('navigation.links.history') ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="president-message" class="max-w-7xl mx-auto px-4 sm:px-8 py-16 sm:py-20">
        <div class="bg-surface rounded-3xl p-6 sm:p-10 border border-border shadow-2 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
            <div class="lg:col-span-4 flex justify-center">
                <figure class="w-full max-w-xs aspect-[4/5] overflow-hidden rounded-t-[8rem] rounded-b-3xl border-4 border-gold-500/30 shadow-2 bg-emerald-50">
                    <img src="<?= $homeImages ?>president.jpg" alt="<?= t('home_page.president_image_alt') ?>"
                        loading="lazy" decoding="async" class="w-full h-full object-cover object-top">
                </figure>
            </div>
            <div class="lg:col-span-8">
                <span class="inline-flex items-center gap-2 text-xs font-bold text-gold-600 uppercase tracking-widest mb-3">
                    <i data-lucide="quote" class="w-4 h-4"></i>
                    <?= t('home_page.president_label') ?>
                </span>
                <h2 class="font-display text-2xl sm:text-3xl font-bold text-ink mb-5">
                    <?= t('home_page.president_title') ?>
                </h2>
                <blockquote class="border-s-4 border-gold-500 ps-5 text-muted text-base sm:text-lg leading-relaxed">
                    <?= t('home_page.president_quote') ?>
                </blockquote>
                <div class="mt-6 pt-5 border-t border-border flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <p class="font-display font-bold text-ink"><?= t('home_page.president_name') ?></p>
                        <p class="text-xs text-muted mt-1"><?= t('home_page.president_role') ?></p>
                    </div>
                    <a href="<?= $siteBase ?>conseil/mot-du-president"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-900">
                        <?= t('home_page.president_more') ?>
                        <i data-lucide="arrow-right" class="w-4 h-4 icon-dir"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-8 pb-16 sm:pb-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-7">
            <div>
                <span class="text-xs font-bold tracking-widest text-emerald-700 uppercase">
                    <?= t('home_page.news_label') ?>
                </span>
                <h2 class="font-display text-3xl font-bold text-ink mt-1"><?= t('home_page.news_title') ?></h2>
                <p class="text-sm text-muted mt-2"><?= t('home_page.news_description') ?></p>
            </div>
            <a href="<?= $siteBase ?>actualites"
                class="inline-flex items-center gap-2 text-xs font-semibold text-emerald-800 bg-emerald-50 px-4 py-2.5 rounded-full hover:bg-emerald-100 transition-colors shrink-0">
                <?= t('home_page.news_all') ?>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5 icon-dir"></i>
            </a>
        </div>

        <div class="mb-5 p-3.5 rounded-xl bg-sand-100 border border-gold-500/20 text-xs text-muted flex items-start gap-2.5">
            <i data-lucide="info" class="w-4 h-4 text-gold-600 shrink-0"></i>
            <p><?= t('home_page.news_demo_notice') ?></p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php foreach ($homePosts as $post): ?>
                <?php $postTitleKey = 'actualites.' . $post['translation'] . '_title'; ?>
                <article class="bg-surface rounded-2xl overflow-hidden border border-border shadow-1 hover:shadow-2 transition-shadow">
                    <a href="<?= $siteBase ?>actualites" class="block overflow-hidden">
                        <img src="<?= $siteBase ?>assets/images/mediatheque/<?= $escape($post['image']) ?>"
                            alt="<?= $escape(t($postTitleKey)) ?>" loading="lazy" decoding="async"
                            class="w-full aspect-[16/10] object-cover hover:scale-105 transition-transform duration-500">
                    </a>
                    <div class="p-4">
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                                <?= t('actualites.' . $post['category']) ?>
                            </span>
                            <span class="text-[10px] font-semibold text-muted bg-bg px-2 py-1 rounded-full">
                                <?= t('actualites.demo_label') ?>
                            </span>
                        </div>
                        <h3 class="font-display font-bold text-sm text-ink mb-2">
                            <a href="<?= $siteBase ?>actualites" class="hover:text-emerald-700">
                                <?= t($postTitleKey) ?>
                            </a>
                        </h3>
                        <p class="text-xs text-muted leading-relaxed">
                            <?= t('actualites.' . $post['translation'] . '_description') ?>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-8 pb-16 sm:pb-20">
        <div class="bg-emerald-900 rounded-3xl p-7 sm:p-10 text-white relative overflow-hidden shadow-3">
            <div class="absolute inset-0 pattern-khatam pointer-events-none opacity-20"></div>
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-7">
                <div class="max-w-2xl">
                    <span class="text-xs font-bold uppercase tracking-widest text-gold-500">
                        <?= t('home_page.contact_label') ?>
                    </span>
                    <h2 class="font-display text-2xl sm:text-3xl font-bold mt-2 mb-3">
                        <?= t('home_page.contact_title') ?>
                    </h2>
                    <p class="text-sm text-emerald-100/85 leading-relaxed">
                        <?= t('home_page.contact_description') ?>
                    </p>
                </div>
                <div class="flex flex-wrap gap-3 shrink-0">
                    <a href="<?= $siteBase ?>contact"
                        class="bg-gold-500 hover:bg-gold-600 text-emerald-950 font-semibold px-5 py-3 rounded-full text-sm transition-colors inline-flex items-center gap-2">
                        <i data-lucide="message-square" class="w-4 h-4"></i>
                        <?= t('home_page.contact_button') ?>
                    </a>
                    <a href="tel:+212537371518"
                        class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-5 py-3 rounded-full text-sm font-semibold inline-flex items-center gap-2">
                        <i data-lucide="phone" class="w-4 h-4 text-gold-500"></i>
                        <bdi dir="ltr">+212 5 37 37 15 18</bdi>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
