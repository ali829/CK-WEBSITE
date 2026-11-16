<?php

declare(strict_types=1);

$locale = $language === 'ar' ? 'ar' : 'fr';

$e = static function ($value): string {
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
};

$localized = static function (array $row, string $field) use ($locale): string {
    $value = trim((string) ($row[$field . '_' . $locale] ?? ''));

    if ($value === '' && $locale === 'ar') {
        $value = trim((string) ($row[$field . '_fr'] ?? ''));
    }

    return $value;
};

$serviceCount = array_sum(array_map(
    static fn(array $division): int => count($division['services']),
    $divisions
));
?>

<div class="bg-emerald-950 text-white/85 text-xs py-2 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <a href="<?= $e(BASE_URL ?? '') ?>" class="flex items-center gap-2 hover:text-gold-500 transition-colors">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5 icon-dir"></i>
            <?= t('divisions.utility_back') ?>
        </a>
        <span class="text-gold-500 font-semibold hidden sm:block">
            <?= t('divisions.utility_label') ?>
        </span>
    </div>
</div>

<section class="bg-emerald-900 text-white py-14 px-4 sm:px-8 relative overflow-hidden">
    <div class="absolute inset-0 pattern-khatam pointer-events-none opacity-20"></div>
    <div class="max-w-4xl mx-auto text-center relative z-10">
        <nav class="flex items-center justify-center gap-2 text-xs text-emerald-200/70 mb-5">
            <a href="<?= $e(BASE_URL ?? '') ?>" class="hover:text-white">
                <?= t('divisions.breadcrumb_home') ?>
            </a>
            <i data-lucide="chevron-right" class="w-3 h-3 icon-dir"></i>
            <span class="text-gold-500 font-medium"><?= t('divisions.breadcrumb_current') ?></span>
        </nav>

        <h1 class="font-display text-3xl sm:text-5xl font-bold tracking-tight mb-4">
            <?= t('divisions.hero_title') ?>
        </h1>
        <p class="text-emerald-100/85 text-sm sm:text-base max-w-2xl mx-auto mb-8">
            <?= t('divisions.hero_description') ?>
        </p>

        <div class="grid grid-cols-2 gap-4 max-w-xl mx-auto pt-6 border-t border-emerald-800">
            <div class="bg-emerald-950/60 p-4 rounded-2xl border border-emerald-800">
                <span class="text-2xl font-bold text-gold-500 font-display"><?= count($divisions) ?></span>
                <p class="text-xs text-emerald-100/70 mt-1"><?= t('divisions.stat_divisions') ?></p>
            </div>
            <div class="bg-emerald-950/60 p-4 rounded-2xl border border-emerald-800">
                <span class="text-2xl font-bold text-gold-500 font-display"><?= $serviceCount ?></span>
                <p class="text-xs text-emerald-100/70 mt-1"><?= t('divisions.stat_services') ?></p>
            </div>
        </div>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8 pb-4 border-b border-border">
        <div>
            <span class="text-xs font-bold tracking-widest text-emerald-700 uppercase">
                <?= t('divisions.section_label') ?>
            </span>
            <h2 class="font-display text-2xl sm:text-3xl font-bold text-ink mt-1">
                <?= t('divisions.section_title') ?>
            </h2>
        </div>
        <p class="text-xs text-muted max-w-sm">
            <?= t('divisions.section_description') ?>
        </p>
    </div>

    <?php if ($divisions): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($divisions as $division): ?>
                <?php
                $divisionId = (int) $division['id'];
                $divisionLabel = $localized($division, 'label');
                $divisionDescription = $localized($division, 'description');
                $divisionLocation = $localized($division, 'location');
                ?>
                <button type="button" onclick="openDeptModal(<?= $divisionId ?>)" aria-haspopup="dialog"
                    class="text-start w-full bg-surface rounded-2xl p-6 border border-border shadow-1 hover:shadow-2 hover:border-emerald-500 cursor-pointer transition-all flex flex-col justify-between group">
                    <span>
                        <span class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 group-hover:bg-emerald-700 group-hover:text-white transition-colors flex items-center justify-center mb-4">
                            <i data-lucide="building-2" class="w-5 h-5"></i>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full">
                            <?= t('divisions.division_badge') ?>
                        </span>
                        <span class="font-display font-bold text-base text-ink mt-2 mb-2 group-hover:text-emerald-700 transition-colors block">
                            <?= $e($divisionLabel) ?>
                        </span>
                        <span class="text-xs text-muted leading-relaxed block">
                            <?= $divisionDescription !== '' ? $e($divisionDescription) : t('divisions.not_specified') ?>
                        </span>
                    </span>
                    <span class="mt-4 pt-4 border-t border-border flex items-center justify-between gap-3 text-xs text-emerald-700 font-semibold">
                        <span><?= count($division['services']) ?> <?= t('divisions.services_count') ?></span>
                        <span class="flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                            <?= t('divisions.open_details') ?>
                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 icon-dir"></i>
                        </span>
                    </span>
                </button>

                <template id="division-data-<?= $divisionId ?>">
                    <span data-division-title><?= $e($divisionLabel) ?></span>
                    <span data-division-description><?= $e($divisionDescription) ?></span>
                    <span data-division-location><?= $e($divisionLocation) ?></span>
                    <span data-service-count><?= count($division['services']) ?></span>
                    <div data-division-services>
                        <?php foreach ($division['services'] as $service): ?>
                            <div data-service>
                                <span data-service-label><?= $e($localized($service, 'label')) ?></span>
                                <span data-service-description><?= $e($localized($service, 'description')) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </template>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-sm text-muted py-12"><?= t('divisions.no_divisions') ?></p>
    <?php endif; ?>
</main>

<div id="dept-modal" class="fixed inset-0 bg-emerald-950/75 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4"
    role="dialog" aria-modal="true" aria-hidden="true" aria-labelledby="modal-title">
    <div class="bg-surface rounded-3xl p-6 sm:p-8 max-w-2xl w-full border border-border shadow-3 flex flex-col max-h-[90vh]">
        <div class="flex items-start justify-between gap-4 pb-4 border-b border-border">
            <div class="flex items-center gap-3.5">
                <span class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                    <i data-lucide="building-2" class="w-6 h-6"></i>
                </span>
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full">
                        <?= t('divisions.division_badge') ?>
                    </span>
                    <h3 id="modal-title" class="font-display font-bold text-xl sm:text-2xl text-ink mt-1"></h3>
                </div>
            </div>
            <button type="button" onclick="closeDeptModal()" aria-label="<?= t('divisions.close') ?>"
                class="w-9 h-9 rounded-full bg-bg hover:bg-emerald-50 text-muted hover:text-ink flex items-center justify-center transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="overflow-y-auto py-6 space-y-6 flex-1 text-xs sm:text-sm">
            <section>
                <h4 class="font-display font-bold text-sm text-ink flex items-center gap-2 mb-2">
                    <i data-lucide="target" class="w-4 h-4 text-emerald-700"></i>
                    <?= t('divisions.missions_title') ?>
                </h4>
                <p id="modal-desc" class="text-muted leading-relaxed whitespace-pre-line"></p>
            </section>

            <section class="bg-bg p-4 rounded-2xl border border-border/80">
                <div class="flex items-center justify-between gap-3 mb-3">
                    <h4 class="font-display font-bold text-xs uppercase tracking-wider text-emerald-800">
                        <?= t('divisions.services_title') ?>
                    </h4>
                    <span id="modal-service-count" class="text-xs text-muted"></span>
                </div>
                <ul id="modal-services" class="space-y-3 text-muted text-xs"></ul>
                <p id="modal-no-services" class="hidden text-xs text-muted">
                    <?= t('divisions.no_services') ?>
                </p>
            </section>

            <div class="p-3.5 bg-emerald-50/60 rounded-xl border border-emerald-100">
                <span class="text-muted block text-[11px]"><?= t('divisions.location_label') ?>:</span>
                <strong id="modal-location" class="text-ink"></strong>
            </div>
        </div>

        <div class="pt-4 border-t border-border flex justify-end">
            <button type="button" onclick="closeDeptModal()"
                class="bg-emerald-700 hover:bg-emerald-600 text-white font-semibold text-xs px-5 py-2.5 rounded-full transition-colors">
                <?= t('divisions.close') ?>
            </button>
        </div>
    </div>
</div>

<script>
    function openDeptModal(divisionId) {
        const template = document.getElementById(`division-data-${divisionId}`);
        if (!template) {
            console.error(`Division details template not found: ${divisionId}`);
            return;
        }

        const data = template.content;
        const modal = document.getElementById('dept-modal');
        const serviceItems = Array.from(data.querySelectorAll('[data-service]'));
        const serviceList = document.getElementById('modal-services');
        const emptyServices = document.getElementById('modal-no-services');

        document.getElementById('modal-title').textContent =
            data.querySelector('[data-division-title]').textContent;
        document.getElementById('modal-desc').textContent =
            data.querySelector('[data-division-description]').textContent ||
            <?= json_encode(t('divisions.not_specified'), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
        document.getElementById('modal-location').textContent =
            data.querySelector('[data-division-location]').textContent ||
            <?= json_encode(t('divisions.not_specified'), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
        document.getElementById('modal-service-count').textContent =
            data.querySelector('[data-service-count]').textContent + ' ' +
            <?= json_encode(t('divisions.services_count'), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

        while (serviceList.firstChild) {
            serviceList.removeChild(serviceList.firstChild);
        }

        serviceItems.forEach(service => {
            const item = document.createElement('li');
            item.className = 'flex items-start gap-2';

            const icon = document.createElement('i');
            icon.setAttribute('data-lucide', 'check-circle-2');
            icon.className = 'w-4 h-4 text-emerald-600 shrink-0 mt-0.5';

            const content = document.createElement('span');
            const label = document.createElement('strong');
            label.className = 'text-ink';
            label.textContent = service.querySelector('[data-service-label]').textContent;
            content.appendChild(label);

            const description = service.querySelector('[data-service-description]').textContent;
            if (description !== '') {
                content.appendChild(document.createElement('br'));
                content.appendChild(document.createTextNode(description));
            }

            item.append(icon, content);
            serviceList.appendChild(item);
        });

        emptyServices.classList.toggle('hidden', serviceItems.length !== 0);
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');

        if (window.lucide) {
            window.lucide.createIcons();
        }
    }

    function closeDeptModal() {
        const modal = document.getElementById('dept-modal');
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
    }

    document.getElementById('dept-modal').addEventListener('click', event => {
        if (event.target === event.currentTarget) {
            closeDeptModal();
        }
    });

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            closeDeptModal();
        }
    });
</script>
