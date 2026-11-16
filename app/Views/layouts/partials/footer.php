<?php

declare(strict_types=1);

$footerBase = rtrim((string) BASE_URL, '/') . '/';
?>

<footer class="bg-emerald-950 text-white/80 border-t border-emerald-900">
    <div class="h-1.5 w-full bg-gradient-to-r from-emerald-800 via-gold-500 to-emerald-800"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            <section class="lg:col-span-1">
                <a href="<?= $footerBase ?>" class="inline-flex items-center gap-3 mb-4">
                    <span class="w-10 h-10 rounded-xl bg-emerald-700 text-white flex items-center justify-center border border-emerald-600">
                        <i data-lucide="landmark" class="w-5 h-5 text-gold-500"></i>
                    </span>
                    <span class="font-display font-bold text-white"><?= t('navigation.brand_name') ?></span>
                </a>
                <p class="text-xs text-white/70 leading-relaxed mb-4"><?= t('footer.description') ?></p>
                <div class="text-xs text-white/70 space-y-2">
                    <p class="flex items-start gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-gold-500 shrink-0"></i>
                        <span><?= t('footer.address') ?></span>
                    </p>
                    <a href="tel:+212537371518" class="flex items-center gap-2 hover:text-gold-500">
                        <i data-lucide="phone" class="w-4 h-4 text-gold-500"></i>
                        <bdi dir="ltr">+212 5 37 37 15 18</bdi>
                    </a>
                    <a href="mailto:contact@kenitra.ma" class="flex items-center gap-2 hover:text-gold-500">
                        <i data-lucide="mail" class="w-4 h-4 text-gold-500"></i>
                        <span>contact@kenitra.ma</span>
                    </a>
                </div>
            </section>

            <section>
                <h2 class="font-display font-bold text-white text-sm mb-4"><?= t('footer.kenitra_heading') ?></h2>
                <ul class="text-xs space-y-3">
                    <li><a href="<?= $footerBase ?>kenitra/presentation" class="hover:text-gold-500"><?= t('navigation.links.presentation') ?></a></li>
                    <li><a href="<?= $footerBase ?>kenitra/history" class="hover:text-gold-500"><?= t('navigation.links.history') ?></a></li>
                    <li><a href="<?= $footerBase ?>kenitra/gallery" class="hover:text-gold-500"><?= t('navigation.links.gallery') ?></a></li>
                    <li><a href="<?= $footerBase ?>actualites" class="hover:text-gold-500"><?= t('navigation.news') ?></a></li>
                </ul>
            </section>

            <section>
                <h2 class="font-display font-bold text-white text-sm mb-4"><?= t('footer.council_heading') ?></h2>
                <ul class="text-xs space-y-3">
                    <li><a href="<?= $footerBase ?>conseil/mot-du-president" class="hover:text-gold-500"><?= t('navigation.links.president') ?></a></li>
                    <li><a href="<?= $footerBase ?>conseil/membres" class="hover:text-gold-500"><?= t('navigation.links.members') ?></a></li>
                    <li><a href="<?= $footerBase ?>conseil/bureau" class="hover:text-gold-500"><?= t('navigation.links.bureau') ?></a></li>
                    <li><a href="<?= $footerBase ?>administration/divisions" class="hover:text-gold-500"><?= t('navigation.links.divisions') ?></a></li>
                </ul>
            </section>

            <section>
                <h2 class="font-display font-bold text-white text-sm mb-4"><?= t('footer.services_heading') ?></h2>
                <ul class="text-xs space-y-3">
                    <li><a href="<?= $footerBase ?>services/document-procedures" class="hover:text-gold-500"><?= t('navigation.links.procedures') ?></a></li>
                    <li><a href="<?= $footerBase ?>services/urban-report" class="hover:text-gold-500"><?= t('navigation.links.urban_report') ?></a></li>
                    <li><a href="<?= $footerBase ?>contact" class="hover:text-gold-500"><?= t('navigation.contact') ?></a></li>
                </ul>
            </section>
        </div>

        <div class="pt-6 border-t border-emerald-900 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/50">
            <p><?= t('footer.copyright') ?></p>
            <a href="<?= $footerBase ?>" class="hover:text-white transition-colors"><?= t('navigation.home') ?></a>
        </div>
    </div>
</footer>
