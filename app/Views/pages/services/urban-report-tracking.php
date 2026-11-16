<?php
declare(strict_types=1);

$language = $language ?? 'fr';
$isArabic = $language === 'ar';

$escape = static fn($value): string => htmlspecialchars(
    (string) ($value ?? ''),
    ENT_QUOTES,
    'UTF-8'
);

$report = $report ?? null;
$referenceNumber = $referenceNumber ?? '';
$error = $error ?? null;

$statuses = [
    'Pending' => [
        'fr' => 'En attente',
        'ar' => 'قيد الانتظار',
        'step' => 1,
        'color' => 'amber',
        'icon' => 'clock',
    ],
    'InProgress' => [
        'fr' => 'En cours de traitement',
        'ar' => 'قيد المعالجة',
        'step' => 2,
        'color' => 'blue',
        'icon' => 'wrench',
    ],
    'Resolved' => [
        'fr' => 'Résolu',
        'ar' => 'تم الحل',
        'step' => 3,
        'color' => 'emerald',
        'icon' => 'check-circle',
    ],
    'Rejected' => [
        'fr' => 'Rejeté',
        'ar' => 'مرفوض',
        'step' => 0,
        'color' => 'red',
        'icon' => 'x-circle',
    ],
];

$status = $report
    ? ($statuses[$report['status']] ?? [
        'fr' => 'Statut inconnu',
        'ar' => 'حالة غير معروفة',
        'step' => 1,
        'color' => 'gray',
        'icon' => 'help-circle',
    ])
    : null;

$category = $report
    ? ($isArabic ? $report['category_ar'] : $report['category_fr'])
    : '';

$neighborhood = $report
    ? ($isArabic ? $report['neighborhood_ar'] : $report['neighborhood_fr'])
    : '';

$submittedDate = '';

if ($report && !empty($report['created_at'])) {
    $timestamp = strtotime($report['created_at']);

    if ($timestamp !== false) {
        $submittedDate = date('d/m/Y à H:i', $timestamp);
    }
}

$baseUrl = rtrim(BASE_URL, '/') . '/';
?>

<main class="max-w-7xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full space-y-8" dir="<?= $isArabic ? 'rtl' : 'ltr' ?>">

    <!-- Page Heading -->
    <div class="space-y-2">
        <a href="<?= $escape($baseUrl . 'services/urban-report') ?>"
            class="inline-flex items-center gap-2 text-sm text-emerald-700 hover:text-emerald-800 font-semibold">
            <i data-lucide="<?= $isArabic ? 'arrow-right' : 'arrow-left' ?>" class="w-4 h-4"></i>
            <?= $isArabic ? 'العودة إلى خدمة التبليغ' : 'Retour au signalement' ?>
        </a>

        <h1 class="font-display text-2xl sm:text-3xl font-bold text-ink">
            <?= $isArabic ? 'تتبع التبليغ' : 'Suivi de mon signalement' ?>
        </h1>

        <p class="text-sm text-muted">
            <?= $isArabic
                ? 'يمكنك الاطلاع على حالة معالجة التبليغ الخاص بك باستخدام رقم المرجع.'
                : 'Consultez l’état de traitement de votre signalement à l’aide de votre numéro de référence.' ?>
        </p>
    </div>

    <!-- Search Another Report -->
    <div class="bg-surface rounded-3xl p-6 border border-border shadow-1">
        <form method="POST" action="<?= $escape($baseUrl . 'services/urban-report/tracking') ?>"
            class="flex flex-col sm:flex-row gap-3">

            <input type="hidden" name="csrf_token" value="<?= $escape($_SESSION['tracking_csrf_token'] ?? '') ?>">

            <div class="flex-1">
                <label for="reference_number" class="block text-xs font-semibold text-muted mb-2">
                    <?= $isArabic ? 'رقم المرجع' : 'Numéro de référence' ?>
                </label>

                <input type="text" id="reference_number" name="reference_number"
                    value="<?= $escape($referenceNumber) ?>" placeholder="KTR-2026-A1B2C3D4"
                    pattern="KTR-[0-9]{4}-[A-Fa-f0-9]{8}" maxlength="18" required
                    class="w-full text-sm text-ink bg-bg border border-border rounded-xl p-3 font-mono uppercase focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>

            <div class="sm:self-end">
                <button type="submit"
                    class="w-full sm:w-auto bg-emerald-700 hover:bg-emerald-600 text-white font-semibold text-sm py-3 px-6 rounded-full transition-colors">
                    <?= $isArabic ? 'بحث' : 'Rechercher' ?>
                </button>
            </div>
        </form>
    </div>

    <!-- Error Message -->
    <?php if ($error): ?>
        <div class="bg-red-50 border border-red-200 rounded-2xl p-5 flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 shrink-0"></i>

            <p class="text-sm text-red-800">
                <?= $escape($error) ?>
            </p>
        </div>
    <?php endif; ?>

    <?php if ($report && $status): ?>

        <!-- Status Header Banner -->
        <div
            class="bg-surface rounded-3xl p-6 sm:p-8 border border-border shadow-2 flex flex-col md:flex-row md:items-center justify-between gap-6">

            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-200">
                    <i data-lucide="file-text" class="w-7 h-7"></i>
                </div>

                <div>
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="text-xs font-mono font-bold text-muted uppercase">
                            <?= $isArabic ? 'رقم المرجع:' : 'Référence :' ?>
                        </span>

                        <span
                            class="font-mono text-sm sm:text-base font-bold text-ink bg-bg px-2.5 py-1 rounded-lg border border-border">
                            <?= $escape($report['reference_number']) ?>
                        </span>
                    </div>

                    <p class="text-xs text-muted mt-2">
                        <?= $isArabic ? 'تاريخ الإيداع:' : 'Déposé le :' ?>
                        <?= $escape($submittedDate) ?>
                    </p>

                    <h2 class="font-display text-xl sm:text-2xl font-bold text-ink mt-1">
                        <?= $escape($report['object']) ?>
                    </h2>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="flex flex-col items-start md:items-end gap-2 shrink-0">
                <span class="text-xs text-muted font-medium">
                    <?= $isArabic ? 'حالة التبليغ:' : 'Statut du dossier :' ?>
                </span>

                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs sm:text-sm font-bold
                    <?php
                    echo match ($status['color']) {
                        'amber' => 'bg-amber-50 text-amber-800 border border-amber-300',
                        'blue' => 'bg-blue-50 text-blue-800 border border-blue-300',
                        'emerald' => 'bg-emerald-50 text-emerald-800 border border-emerald-300',
                        'red' => 'bg-red-50 text-red-800 border border-red-300',
                        default => 'bg-gray-100 text-gray-700 border border-gray-300',
                    };
                    ?>">

                    <i data-lucide="<?= $escape($status['icon']) ?>" class="w-4 h-4"></i>

                    <?= $isArabic ? $escape($status['ar']) : $escape($status['fr']) ?>
                </div>
            </div>
        </div>

        <!-- Rejected Status Message -->
        <?php if ($report['status'] === 'Rejected'): ?>
            <div class="bg-red-50 border border-red-200 rounded-2xl p-5 flex items-start gap-3">
                <i data-lucide="info" class="w-5 h-5 text-red-600 shrink-0"></i>

                <p class="text-sm text-red-800">
                    <?= $isArabic
                        ? 'تم رفض هذا التبليغ. يرجى التواصل مع المصالح الجماعية للحصول على مزيد من المعلومات.'
                        : 'Ce signalement a été rejeté. Veuillez contacter les services communaux pour obtenir davantage d’informations.' ?>
                </p>
            </div>
        <?php endif; ?>
        <!-- Report Details -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- Left Column -->
            <div class="lg:col-span-8 bg-surface rounded-3xl p-6 sm:p-10 border border-border shadow-2 space-y-8">

                <!-- Category and Title -->
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 block mb-2">
                        <?= $isArabic ? 'تفاصيل التبليغ' : 'Détails de l’anomalie signalée' ?>
                    </span>

                    <span
                        class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 font-bold text-xs px-3.5 py-2 rounded-full border border-emerald-200">
                        <i data-lucide="tag" class="w-4 h-4"></i>
                        <?= $escape($category) ?>
                    </span>

                    <h3 class="font-display font-bold text-xl sm:text-2xl text-ink mt-3">
                        <?= $escape($report['object']) ?>
                    </h3>
                </div>

                <!-- Description -->
                <div class="bg-bg p-5 rounded-2xl border border-border">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-muted mb-2">
                        <?= $isArabic ? 'الوصف التفصيلي:' : 'Description détaillée :' ?>
                    </h4>

                    <p class="text-xs sm:text-sm text-ink leading-relaxed whitespace-pre-line">
                        <?= $escape($report['message']) ?>
                    </p>
                </div>

                <!-- Location -->
                <div>
                    <h4 class="font-display font-bold text-base text-ink mb-3 flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-5 h-5 text-emerald-700"></i>
                        <?= $isArabic ? 'موقع التدخل' : 'Localisation de l’intervention' ?>
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="p-4 bg-emerald-50/50 rounded-2xl border border-emerald-100">
                            <span class="text-muted block text-xs">
                                <?= $isArabic ? 'الحي:' : 'Quartier :' ?>
                            </span>

                            <strong class="text-ink font-semibold mt-1 block text-sm">
                                <?= $escape($neighborhood) ?>
                            </strong>
                        </div>

                        <div class="p-4 bg-emerald-50/50 rounded-2xl border border-emerald-100">
                            <span class="text-muted block text-xs">
                                <?= $isArabic ? 'العنوان:' : 'Adresse :' ?>
                            </span>

                            <strong class="text-ink font-semibold mt-1 block text-sm">
                                <?= $escape($report['location']) ?>
                            </strong>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Right Column -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Report Summary Card -->
                <div class="bg-surface rounded-3xl p-6 border border-border shadow-1">

                    <h4 class="font-display font-bold text-sm text-ink flex items-center gap-2 mb-4">
                        <i data-lucide="clipboard-list" class="w-4 h-4 text-emerald-700"></i>
                        <?= $isArabic ? 'ملخص التبليغ' : 'Résumé du signalement' ?>
                    </h4>

                    <div class="space-y-4 text-xs">

                        <div>
                            <span class="text-muted block mb-1">
                                <?= $isArabic ? 'رقم المرجع' : 'Numéro de référence' ?>
                            </span>

                            <strong class="font-mono text-ink">
                                <?= $escape($report['reference_number']) ?>
                            </strong>
                        </div>

                        <div class="border-t border-border pt-3">
                            <span class="text-muted block mb-1">
                                <?= $isArabic ? 'تاريخ الإيداع' : 'Date de dépôt' ?>
                            </span>

                            <strong class="text-ink">
                                <?= $escape($submittedDate) ?>
                            </strong>
                        </div>

                        <div class="border-t border-border pt-3">
                            <span class="text-muted block mb-1">
                                <?= $isArabic ? 'التصنيف' : 'Catégorie' ?>
                            </span>

                            <strong class="text-ink">
                                <?= $escape($category) ?>
                            </strong>
                        </div>

                        <div class="border-t border-border pt-3">
                            <span class="text-muted block mb-1">
                                <?= $isArabic ? 'الحالة الحالية' : 'Statut actuel' ?>
                            </span>

                            <strong class="text-ink">
                                <?= $isArabic ? $escape($status['ar']) : $escape($status['fr']) ?>
                            </strong>
                        </div>

                    </div>
                </div>

                <!-- Information Card -->
                <div class="bg-emerald-900 rounded-3xl p-6 text-white border border-emerald-800 shadow-2">

                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 text-emerald-100 flex items-center justify-center">
                            <i data-lucide="info" class="w-5 h-5"></i>
                        </div>

                        <h4 class="font-display font-bold text-sm">
                            <?= $isArabic ? 'معلومات مهمة' : 'Information importante' ?>
                        </h4>
                    </div>

                    <p class="text-xs text-emerald-100/90 leading-relaxed">
                        <?= $isArabic
                            ? 'احتفظ برقم المرجع الخاص بك. يمكنك استخدامه في أي وقت للاطلاع على حالة معالجة التبليغ.'
                            : 'Conservez votre numéro de référence. Il vous permettra de consulter à tout moment l’état de traitement de votre signalement.' ?>
                    </p>

                    <a href="<?= $escape($baseUrl . 'services/urban-report') ?>"
                        class="mt-5 w-full bg-white hover:bg-emerald-50 text-emerald-900 font-bold text-xs py-3 px-4 rounded-full flex items-center justify-center gap-2 transition-colors">

                        <i data-lucide="plus-circle" class="w-4 h-4"></i>

                        <?= $isArabic ? 'إرسال تبليغ جديد' : 'Déposer un nouveau signalement' ?>
                    </a>
                </div>

            </div>

        </div>

    <?php endif; ?>

</main>