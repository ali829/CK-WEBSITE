<?php

declare(strict_types=1);

$locale = $language === 'ar' ? 'ar' : 'fr';

$e = static function ($value): string {
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
};

$localized = static function (array $row, string $field) use ($locale): string {
    return (string) ($row[$field . '_' . $locale] ?? $row[$field . '_fr'] ?? '');
};

$splitDocuments = static function (?string $documents): array {
    if (!$documents) {
        return [];
    }

    return array_values(array_filter(
        array_map('trim', explode(';', $documents)),
        static fn($item) => $item !== ''
    ));
};

$searchItems = [];

foreach ($procedures as $procedure) {
    $searchItems[] = [
        'id' => (int) $procedure['id'],
        'title' => $localized($procedure, 'label'),
        'description' => $localized($procedure, 'description'),
        'documents' => $localized($procedure, 'pieces'),
        'service' => $procedure['service_' . $locale]
            ?? $procedure['service_fr']
            ?? '',
    ];
}

$searchItemsJson = json_encode(
    $searchItems,
    JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS |
    JSON_HEX_AMP | JSON_HEX_QUOT
);

$featuredDocuments = $featuredProcedure
    ? $splitDocuments($localized($featuredProcedure, 'pieces'))
    : [];

$featuredInstructions = $featuredProcedure
    ? $localized($featuredProcedure, 'justified_pappers')
    : '';

$featuredSteps = $featuredProcedure['steps'] ?? [];

$featuredUrl = $featuredProcedure['online_service_url'] ?? '';
$featuredUrlIsValid = filter_var($featuredUrl, FILTER_VALIDATE_URL)
    && in_array(parse_url($featuredUrl, PHP_URL_SCHEME), ['http', 'https'], true);
?>

<div class="bg-emerald-950 text-white/85 text-xs py-2 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <a href="<?= $e(BASE_URL ?? '') ?>" class="flex items-center gap-2 hover:text-gold-500 transition-colors">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
            <?= t('document_procedures.utility_back') ?>
        </a>

        <span class="text-gold-500 font-semibold hidden sm:block">
            <?= t('document_procedures.utility_service') ?>
        </span>
    </div>
</div>

<section class="bg-emerald-900 text-white py-14 px-4 sm:px-8 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none opacity-20"
        style="background-image: radial-gradient(circle at 50% 50%, rgba(201,162,75,.2) 2px, transparent 2px); background-size: 32px 32px;">
    </div>

    <div class="max-w-4xl mx-auto text-center relative z-10">

        <nav class="flex items-center justify-center gap-2 text-xs text-emerald-200/70 mb-5">
            <a href="<?= $e(BASE_URL ?? '') ?>" class="hover:text-white">
                <?= t('document_procedures.breadcrumb_home') ?>
            </a>

            <i data-lucide="chevron-right" class="w-3 h-3"></i>

            <span><?= t('document_procedures.breadcrumb_services') ?></span>

            <i data-lucide="chevron-right" class="w-3 h-3"></i>

            <span class="text-gold-500 font-medium">
                <?= t('document_procedures.breadcrumb_current') ?>
            </span>
        </nav>

        <h1 class="font-display text-3xl sm:text-5xl font-bold tracking-tight mb-4">
            <?= t('document_procedures.hero_title') ?>
        </h1>

        <p class="text-emerald-100/85 text-sm sm:text-base max-w-2xl mx-auto mb-8">
            <?= t('document_procedures.hero_description') ?>
        </p>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full">

    <?php if ($featuredProcedure): ?>
        <section class="bg-white rounded-3xl p-6 sm:p-10 border border-border shadow-2 mb-12">

            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-border">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="file-badge" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">
                            <?= t('document_procedures.featured_label') ?>
                        </span>

                        <h2 class="font-display text-xl sm:text-2xl font-bold text-ink">
                            <?= $e($localized($featuredProcedure, 'label')) ?>
                        </h2>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <?php if (!empty($featuredProcedure['online_service_url'])): ?>
                        <span
                            class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold px-3 py-1 rounded-full">
                            <?= t('document_procedures.online_procedure') ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($featuredProcedure['delai_' . $locale])): ?>
                        <span
                            class="bg-gold-100 text-gold-600 border border-gold-500/30 text-xs font-semibold px-3 py-1 rounded-full">
                            <?= t('document_procedures.processing_time') ?>:
                            <?= $e($localized($featuredProcedure, 'delai')) ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-8">

                <div class="lg:col-span-6 space-y-6">
                    <h3 class="font-display font-bold text-base text-ink flex items-center gap-2">
                        <i data-lucide="list-ordered" class="w-5 h-5 text-emerald-700"></i>
                        <?= t('document_procedures.steps_title') ?>
                    </h3>

                    <?php if ($featuredSteps): ?>
                        <div class="relative ps-6 space-y-6 border-s-2 border-emerald-200">
                            <?php foreach ($featuredSteps as $index => $step): ?>
                                <div class="relative">
                                    <span
                                        class="absolute -start-[31px] top-0.5 w-6 h-6 rounded-full bg-emerald-700 text-white text-xs font-bold flex items-center justify-center">
                                        <?= (int) $step['position'] ?>
                                    </span>

                                    <h4 class="font-semibold text-sm text-ink">
                                        <?= $e($localized($step, 'label')) ?>
                                    </h4>

                                    <?php if ($localized($step, 'description') !== ''): ?>
                                        <p class="text-xs text-muted mt-1">
                                            <?= nl2br($e($localized($step, 'description'))) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-sm text-muted">
                            <?= t('document_procedures.not_specified') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div
                    class="lg:col-span-6 bg-emerald-50/60 rounded-2xl p-6 border border-emerald-100 flex flex-col justify-between">
                    <div>
                        <h3 class="font-display font-bold text-base text-ink flex items-center gap-2 mb-4">
                            <i data-lucide="check-square" class="w-5 h-5 text-emerald-700"></i>
                            <?= t('document_procedures.required_documents') ?>
                        </h3>

                        <?php if ($featuredDocuments): ?>
                            <ul class="space-y-3">
                                <?php foreach ($featuredDocuments as $document): ?>
                                    <li class="flex items-start gap-3 text-xs text-ink">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                        <span><?= $e($document) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-xs text-muted">
                                <?= t('document_procedures.not_specified') ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($featuredInstructions !== ''): ?>
                            <div class="mt-5 pt-4 border-t border-emerald-200/60">
                                <p class="text-xs font-semibold text-ink mb-1">
                                    <?= t('document_procedures.information_notice') ?>
                                </p>
                                <p class="text-xs text-muted">
                                    <?= nl2br($e($featuredInstructions)) ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-6 pt-4 border-t border-emerald-200/60 flex flex-wrap items-center justify-between gap-3">
                        <div class="text-xs text-muted">
                            <span><?= t('document_procedures.issuing_service') ?>:</span>

                            <strong class="text-ink">
                                <?= $e($featuredProcedure['service_' . $locale] ?? $featuredProcedure['service_fr'] ?? t('document_procedures.not_specified')) ?>
                            </strong>
                        </div>

                        <?php if ($featuredUrlIsValid): ?>
                            <a href="<?= $e($featuredUrl) ?>" target="_blank" rel="noopener noreferrer"
                                class="bg-emerald-700 hover:bg-emerald-600 text-white font-semibold text-xs px-5 py-2.5 rounded-full inline-flex items-center gap-2 shadow-sm transition-all">
                                <?= t('document_procedures.submit_online') ?>
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <div class="flex items-center justify-between gap-4 mb-6">
        <h2 class="font-display text-xl font-bold text-ink">
            <?= t('document_procedures.all_procedures') ?>
        </h2>

        <span class="text-xs text-muted">
            <span id="procedure-count"><?= count($procedures) ?></span>
            <?= t('document_procedures.procedure_count') ?>
        </span>
    </div>

    <div id="procedures-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach ($procedures as $procedure): ?>
            <?php
            $title = $localized($procedure, 'label');
            $description = $localized($procedure, 'description');
            $documents = $splitDocuments($localized($procedure, 'pieces'));
            $instructions = $localized($procedure, 'justified_pappers');
            $service = $procedure['service_' . $locale]
                ?? $procedure['service_fr']
                ?? '';

            $searchText = implode(' ', [
                $title,
                $description,
                $service,
                implode(' ', $documents),
                $instructions,
            ]);
            ?>

            <article
                class="procedure-item bg-white rounded-2xl p-6 border border-border shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                data-search="<?= $e(mb_strtolower($searchText, 'UTF-8')) ?>">
                <div>
                    <div class="flex items-center justify-between gap-3 mb-4">
                        <?php if (!empty($procedure['is_annexe'])): ?>
                            <span
                                class="text-[11px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                                <?= t('document_procedures.annexe_badge') ?>
                            </span>
                        <?php else: ?>
                            <span
                                class="text-[11px] font-bold uppercase tracking-wider text-sebou-600 bg-sebou-100 px-2.5 py-1 rounded-full">
                                <?= t('document_procedures.service_label') ?>
                            </span>
                        <?php endif; ?>

                        <span class="text-xs text-muted flex items-center gap-1 shrink-0">
                            <i data-lucide="clock" class="w-3 h-3"></i>
                            <?= $e($localized($procedure, 'delai') ?: t('document_procedures.not_specified')) ?>
                        </span>
                    </div>

                    <h3 class="font-display font-bold text-lg text-ink mb-2">
                        <?= $e($title) ?>
                    </h3>

                    <p class="text-xs text-muted leading-relaxed mb-4">
                        <?= $e($description ?: t('document_procedures.not_specified')) ?>
                    </p>

                    <div class="text-xs text-ink/80 space-y-2 mb-4 bg-bg p-3 rounded-xl border border-border/60">
                        <div>
                            <strong><?= t('document_procedures.documents_label') ?>:</strong>

                            <?php if ($documents): ?>
                                <?= $e(implode(', ', $documents)) ?>
                            <?php else: ?>
                                <?= t('document_procedures.not_specified') ?>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($procedure['legal_tarif'])): ?>
                            <div>
                                <strong><?= t('document_procedures.tariff_label') ?>:</strong>
                                <?= $e($procedure['legal_tarif']) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($service !== ''): ?>
                            <div>
                                <strong><?= t('document_procedures.service_label') ?>:</strong>
                                <?= $e($service) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="hidden procedure-details text-xs text-muted leading-relaxed space-y-3 mb-4">
                        <?php if ($instructions !== ''): ?>
                            <p><?= nl2br($e($instructions)) ?></p>
                        <?php endif; ?>

                        <?php if (!empty($procedure['online_service_label'])): ?>
                            <p>
                                <strong><?= $e($procedure['online_service_label']) ?></strong>
                            </p>
                        <?php endif; ?>

                        <?php if (
                            !empty($procedure['online_service_url']) &&
                            filter_var($procedure['online_service_url'], FILTER_VALIDATE_URL) &&
                            in_array(parse_url($procedure['online_service_url'], PHP_URL_SCHEME), ['http', 'https'], true)
                        ): ?>
                            <a href="<?= $e($procedure['online_service_url']) ?>" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-1 text-emerald-700 font-semibold hover:underline">
                                <?= t('document_procedures.external_link') ?>
                                <i data-lucide="external-link" class="w-3 h-3"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pt-4 border-t border-border flex items-center justify-end">
                    <button type="button"
                        class="procedure-details-toggle text-xs font-semibold text-ink hover:text-emerald-700 flex items-center gap-1">
                        <span><?= t('document_procedures.details_button') ?></span>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </article>
        <?php endforeach; ?>

    </div>

    <p id="no-procedures-message" class="hidden text-center text-sm text-muted py-12">
        <?= t('document_procedures.search_empty') ?>
    </p>

    <div class="mt-10 p-4 rounded-xl bg-sand-100 border border-gold-500/20 text-xs text-muted">
        <div class="flex items-start gap-3">
            <i data-lucide="info" class="w-5 h-5 text-gold-600 shrink-0"></i>
            <p><?= t('document_procedures.information_notice') ?></p>
        </div>
    </div>
</main>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('procedure-search');
        const searchButton = document.getElementById('procedure-search-button');
        const procedureItems = document.querySelectorAll('.procedure-item');
        const procedureCount = document.getElementById('procedure-count');
        const noResults = document.getElementById('no-procedures-message');

        const translations = {
            show: <?= json_encode(t('document_procedures.details_button')) ?>,
            hide: <?= json_encode(t('document_procedures.hide_details')) ?>
        };

        function filterProcedures() {
            const query = searchInput.value
                .trim()
                .toLocaleLowerCase();

            let visibleCount = 0;

            procedureItems.forEach(item => {
                const searchableText = (
                    item.dataset.search || ''
                ).toLocaleLowerCase();

                const matches = searchableText.includes(query);

                item.classList.toggle('hidden', !matches);

                if (matches) {
                    visibleCount++;
                }
            });

            procedureCount.textContent = visibleCount;
            noResults.classList.toggle('hidden', visibleCount !== 0);
        }

        searchInput.addEventListener('input', filterProcedures);
        searchButton.addEventListener('click', filterProcedures);

        searchInput.addEventListener('keydown', event => {
            if (event.key === 'Enter') {
                event.preventDefault();
                filterProcedures();
            }
        });

        document.querySelectorAll('.suggestion-chip').forEach(button => {
            button.addEventListener('click', () => {
                searchInput.value = button.dataset.search || '';
                filterProcedures();
                searchInput.focus();
            });
        });

        document.querySelectorAll('.procedure-details-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const card = button.closest('.procedure-item');
                const details = card.querySelector('.procedure-details');
                const label = button.querySelector('span');
                const icon = button.querySelector('i');

                const isHidden = details.classList.contains('hidden');

                details.classList.toggle('hidden', !isHidden);

                label.textContent = isHidden
                    ? translations.hide
                    : translations.show;

                icon.setAttribute(
                    'data-lucide',
                    isHidden ? 'chevron-up' : 'chevron-down'
                );

                if (window.lucide) {
                    window.lucide.createIcons();
                }
            });
        });

        if (window.lucide) {
            window.lucide.createIcons();
        }
    });
</script>