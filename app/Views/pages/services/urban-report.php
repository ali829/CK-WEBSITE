<!-- Header -->
<header class="bg-surface border-b border-border sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 h-20 flex items-center justify-between">
        <a href="../../screens/home-portal/HomePortal.html" class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-terracotta-600 text-white flex items-center justify-center shadow-1">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <span class="font-display font-bold text-lg text-ink">SIGNALEMENT URBAIN</span>
                <p class="text-xs text-muted">Signaler une anomalie dans l&#39;espace public · Kénitra</p>
            </div>
        </a>
        <div class="flex items-center gap-4">
            <a href="#tracking-modal" onclick="openTrackingModal()"
                class="text-xs font-semibold text-ink bg-bg border border-border  px-4 py-2 rounded-full hover:bg-emerald-50 transition-colors flex items-center gap-1.5">
                <i data-lucide="search" class="w-3.5 h-3.5 text-emerald-700"></i> Suivre mon signalement
            </a>
        </div>
    </div>
</header>



<!-- Main Multi-step Form Content -->
<main class="max-w-5xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full">

    <!-- Success Confirmation Banner (Hidden by default, triggered on submit) -->
    <div id="success-banner"
        class="<?= !empty($success) ? '' : 'hidden' ?> bg-emerald-50 border border-emerald-300 rounded-3xl p-6 sm:p-8 mb-8 shadow-2">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-700 text-white flex items-center justify-center shrink-0">
                <i data-lucide="check-circle-2" class="w-7 h-7"></i>
            </div>
            <div class="flex-1">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Signalement Transmis avec
                    Succès</span>
                <h3 class="font-display font-bold text-xl text-ink mt-0.5 mb-2">Votre dossier a été attribué aux
                    services
                    municipaux</h3>
                <p class="text-xs sm:text-sm text-muted mb-4 leading-relaxed">
                    Merci pour votre contribution citoyenne. Votre numéro de ticket est <strong
                        class="text-ink font-mono text-base px-2 py-0.5 bg-emerald-100 rounded-lg"><?= htmlspecialchars($referenceNumber ?? '', ENT_QUOTES, 'UTF-8') ?></strong>.
                    Un SMS
                    de confirmation a été envoyé à votre numéro et vous recevrez une notification photo dès que
                    l&#39;anomalie
                    sera réparée.
                </p>
                <div class="flex flex-wrap items-center gap-3">
                    <button onclick="window.print()"
                        class="text-xs font-semibold text-emerald-700 bg-surface border border-emerald-200 px-4 py-2 rounded-full hover:bg-emerald-50 transition-colors flex items-center gap-1.5">
                        <i data-lucide="printer" class="w-3.5 h-3.5"></i> Imprimer le reçu
                    </button>
                    <button onclick="resetForm()"
                        class="text-xs font-semibold text-white bg-emerald-700 px-4 py-2 rounded-full hover:bg-emerald-600 transition-colors">
                        Faire un autre signalement
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Errors messages -->

    <?php if (!empty($errors)): ?>
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">
            <div class="flex items-start gap-3">
                <div class="shrink-0 text-red-600">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                </div>

                <div class="flex-1">
                    <h3 class="font-semibold text-sm text-red-800 mb-2">
                        Veuillez corriger les erreurs suivantes :
                    </h3>

                    <ul class="list-disc list-inside space-y-1 text-xs text-red-700">
                        <?php foreach ($errors as $error): ?>
                            <li>
                                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- The Interactive Urban Reporting Form -->
    <form id="urban-report-form" action="<?= BASE_URL ?>services/urban-report" method="POST"
        enctype="multipart/form-data"
        class="<?= !empty($success) ? 'hidden' : '' ?> bg-surface rounded-3xl p-6 sm:p-10 border border-border shadow-2 space-y-10">
        <input type="hidden" name="csrf_token"
            value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
        <!-- ================= STEP 1: CATEGORY SELECTION ================= -->
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-border mb-6">
                <div class="flex items-center gap-3">
                    <span
                        class="w-8 h-8 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center">1</span>
                    <div>
                        <h2 class="font-display font-bold text-lg text-ink">Choisissez la catégorie du signalement</h2>
                        <p class="text-xs text-muted">Sélectionnez le type d&#39;anomalie constaté dans l&#39;espace
                            public de
                            Kénitra.</p>
                    </div>
                </div>
                <span
                    class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Obligatoire</span>
            </div>

            <input name="urban_cat_id" type="hidden" id="urban_cat_id" value="<?= $categories[0]['id'] ?? '' ?>"
                required>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($categories as $index => $category): ?>
                    <!-- Category card -->
                    <div class="cat-card p-4 rounded-2xl border border-border cursor-pointer transition-all hover:shadow-1 flex flex-col justify-between relative group <?= $index === 0 ? 'selected' : '' ?>"
                        onclick="selectCategory(<?= (int) $category['id'] ?>, this)">
                        <div class="flex items-center justify-between mb-3">
                            <div
                                class="cat-icon-box w-11 h-11 rounded-xl bg-gold-100 text-gold-600 flex items-center justify-center transition-colors">
                                <i data-lucide="<?= $category['icon'] ?>" class="w-6 h-6"></i>
                            </div>
                            <span class="cat-check text-emerald-700 hidden"><i data-lucide="check-circle"
                                    class="w-4 h-4"></i></span>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-xs sm:text-sm text-ink mb-1">
                                <?= htmlspecialchars($category['label_' . $language], ENT_QUOTES, 'UTF-8') ?>
                            </h3>
                            <p class="text-[11px] text-muted leading-tight">
                                <?= htmlspecialchars($category['description_' . $language], ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

        <!-- ================= STEP 2: DETAILS & DESCRIPTION ================= -->
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-border mb-6">
                <div class="flex items-center gap-3">
                    <span
                        class="w-8 h-8 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center">2</span>
                    <div>
                        <h2 class="font-display font-bold text-lg text-ink">Précisez la situation constatée</h2>
                        <p class="text-xs text-muted">Donnez un titre clair et une description succincte pour guider
                            l&#39;équipe
                            d&#39;intervention.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-ink mb-1.5">Intitulé du signalement *</label>
                    <input id="object" name="object" type="text" required
                        placeholder="Ex: Éclairage public éteint, nid de poule profond..."
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-ink mb-1.5">Description détaillée de l&#39;anomalie
                        *</label>
                    <textarea name="message" rows="3" required
                        placeholder="Décrivez avec précision l&#39;anomalie constatée, les repères visuels (face au magasin X, carrefour Y)..."
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600"></textarea>
                </div>
            </div>
        </div>

        <!-- ================= STEP 3: LOCATION & PHOTO ATTACHMENT ================= -->
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-border mb-6">
                <div class="flex items-center gap-3">
                    <span
                        class="w-8 h-8 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center">3</span>
                    <div>
                        <h2 class="font-display font-bold text-lg text-ink">Localisation &amp; Photo</h2>
                        <p class="text-xs text-muted">Indiquez l&#39;adresse ou le quartier et joignez une photo pour
                            accélérer
                            l&#39;intervention.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Location inputs -->
                <div class="lg:col-span-7 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-ink mb-1.5">Arrondissement / Quartier
                                *</label>
                            <select name="neighborhood_id" required
                                class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                                <?php foreach ($neighborhoods as $neighborhood): ?>
                                    <option value="<?= (int) $neighborhood['id'] ?>">
                                        <?= htmlspecialchars($neighborhood['label_' . $language], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-ink mb-1.5">Adresse / Rue / Boulevard
                                *</label>
                            <input type="text" name="location" placeholder="Exemple : Avenue Mohammed V, près de..."
                                required
                                class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                        </div>
                    </div>
                </div>

                <!-- Photo Upload Zone -->
                <div class="lg:col-span-5 flex flex-col justify-between">
                    <div>
                        <label class="block text-xs font-semibold text-ink mb-1.5">Joindre une
                            photos</label>
                        <label for="photo-upload"
                            class="border-2 border-dashed border-emerald-300/80 bg-emerald-50/40 rounded-2xl p-6 text-center hover:bg-emerald-50 transition-colors cursor-pointer block">
                            <div
                                class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="camera" class="w-6 h-6"></i>
                            </div>
                            <p class="text-xs font-semibold text-ink">Cliquez ou déposez votre photo ici</p>
                            <p class="text-[11px] text-muted mt-1">JPEG, PNG ou WEBP jusqu&#39;à 10 Mo</p>
                        </label>
                        <input type="file" class="hidden" id="photo-upload" name="file"
                            accept="image/jpeg,image/png,image/webp">
                    </div>

                    <!-- Uploaded sample thumbnail preview -->
                    <div id="image-preview"
                        class="hidden  mt-4 p-3 bg-bg rounded-xl border border-border flex items-center justify-between">
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= STEP 4: CITIZEN CONTACT & SUBMISSION ================= -->
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-border mb-6">
                <div class="flex items-center gap-3">
                    <span
                        class="w-8 h-8 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center">4</span>
                    <div>
                        <h2 class="font-display font-bold text-lg text-ink">Vos coordonnées</h2>
                        <p class="text-xs text-muted">Veuillez fournir vos coordonnées pour que nous puissions vous
                            contacter concernant votre signalement.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-ink mb-1.5">Nom et Prénom *</label>
                    <input type="text" name="fullname" placeholder="Ex: Karim Bennani" required
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-ink mb-1.5">Numéro de téléphone mobile *</label>
                    <input type="tel" name="phone_number" placeholder="Ex: +212 6 61 23 45 67" required
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600"
                        dir="ltr">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-ink mb-1.5">Adresse email (optionnel)</label>
                    <input type="email" name="email" placeholder="Ex: k.bennani@gmail.com"
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                </div>
            </div>
        </div>

        <!-- Form Action Submit Button -->
        <div class="pt-6 border-t border-border flex flex-col sm:flex-row items-center gap-4">
            <button type="submit"
                class="w-full sm:w-auto bg-emerald-700 hover:bg-emerald-600 text-white font-semibold text-sm px-8 py-3.5 rounded-full shadow-2 transition-all flex items-center justify-center gap-2">
                <i data-lucide="send" class="w-4 h-4 text-gold-500"></i>
                <span>Transmettre le signalement urbain</span>
            </button>
        </div>

    </form>
</main>


<!-- Ticket Tracking Modal -->
<div id="tracking-modal"
    class="hidden fixed inset-0 bg-emerald-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">

    <div class="bg-surface rounded-3xl p-6 sm:p-8 max-w-md w-full border border-border shadow-3">

        <div class="flex items-center justify-between mb-4">
            <h3 class="font-display font-bold text-lg text-ink">
                Suivre mon signalement
            </h3>

            <button type="button" onclick="closeTrackingModal()" class="text-muted hover:text-ink">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <p class="text-xs text-muted mb-4">
            Entrez votre numéro de référence reçu après la soumission de votre signalement :
        </p>

        <form method="POST"
            action="<?= htmlspecialchars(rtrim(BASE_URL, '/') . '/services/urban-report/tracking', ENT_QUOTES, 'UTF-8') ?>">

            <input type="hidden" name="csrf_token"
                value="<?= htmlspecialchars($_SESSION['tracking_csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <input type="text" name="reference_number" placeholder="KTR-2026-A1B2C3D4"
                value="<?= htmlspecialchars($referenceNumber ?? '', ENT_QUOTES, 'UTF-8') ?>"
                pattern="KTR-[0-9]{4}-[A-Fa-f0-9]{8}" maxlength="18" required
                class="w-full text-sm text-ink bg-bg border border-border rounded-xl p-3 mb-4 font-mono uppercase">

            <button type="submit"
                class="w-full bg-emerald-700 hover:bg-emerald-600 text-white font-semibold text-sm py-3 px-4 rounded-full transition-colors">
                Consulter l'état d'avancement
            </button>

        </form>
    </div>
</div>

<script>
    function selectCategory(catId, el) {
        document.querySelectorAll('.cat-card').forEach(card => {
            card.classList.remove('selected');
            const check = card.querySelector('.cat-check');
            if (check) check.classList.add('hidden');
        });
        el.classList.add('selected');
        const check = el.querySelector('.cat-check');
        if (check) check.classList.remove('hidden');

        document.getElementById('urban_cat_id').value = catId;
        console.log('Selected category:', catId);
    }


    function resetForm() {
        document.getElementById('urban-report-form').classList.remove('hidden');
        document.getElementById('success-banner').classList.add('hidden');
    }

    function openTrackingModal() {
        document.getElementById('tracking-modal').classList.remove('hidden');
    }

    function closeTrackingModal() {
        document.getElementById('tracking-modal').classList.add('hidden');
    }
</script>

<script src="<?= BASE_URL ?>assets/js/urban-report.js"></script>