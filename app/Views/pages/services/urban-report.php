<!-- Main Multi-step Form Content -->
<main class="max-w-5xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full">

    <!-- Success Confirmation Banner (Hidden by default, triggered on submit) -->
    <div id="success-banner"
        class="hidden bg-emerald-50 border border-emerald-300 rounded-3xl p-6 sm:p-8 mb-8 shadow-2">
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
                        class="text-ink font-mono text-base px-2 py-0.5 bg-emerald-100 rounded-lg">KTR-2026-08492</strong>.
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

    <!-- The Interactive Urban Reporting Form -->
    <form id="urban-report-form" action="<?= htmlspecialchars(
        rtrim(getenv('BASE_URL') ?: '', '/') . '/services/urban-report/submit',
        ENT_QUOTES,
        'UTF-8'
    ) ?>" method="POST" enctype="multipart/form-data" onsubmit="handleReportSubmit(event)"
        class="bg-surface rounded-3xl p-6 sm:p-10 border border-border shadow-2 space-y-10">

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

            <input type="hidden" id="urban_cat_id" value="<?= $categories[0]['id'] ?? '' ?>" required>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($categories as $category):  ?>
                    <!-- Category card -->
                    <div onclick="selectCategory(<?= (int) $category['id'] ?>, this)"
                        class="cat-card p-4 rounded-2xl border border-border cursor-pointer transition-all hover:shadow-1 flex flex-col justify-between relative group">
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
                    <input id="report-title" type="text" required value="3 lampadaires consécutifs éteints depuis 48h"
                        placeholder="Ex: Éclairage public éteint, nid de poule profond..."
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-ink mb-1.5">Niveau d&#39;urgence estimé *</label>
                        <select
                            class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                            <option value="normal">Normal (intervention sous 48h)</option>
                            <option value="urgent" selected>Urgent (danger ou gêne importante - sous 24h)</option>
                            <option value="critique">Critique (risque immédiat pour la sécurité des personnes)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-ink mb-1.5">Moment de constatation</label>
                        <input type="text" value="Aujourd&#39;hui à 18h30"
                            class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-ink mb-1.5">Description détaillée de l&#39;anomalie
                        *</label>
                    <textarea rows="3" required
                        placeholder="Décrivez avec précision l&#39;anomalie constatée, les repères visuels (face au magasin X, carrefour Y)..."
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">Sur l&#39;avenue Mohammed Diouri, en face de la pharmacie Centrale, 3 candélabres sont totalement éteints créant une zone d&#39;obscurité dangereuse pour les piétons traversant la chaussée.</textarea>
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
                        <h2 class="font-display font-bold text-lg text-ink">Localisation exacte &amp; Photo</h2>
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
                            <select
                                class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                                <option selected>Centre-Ville (Médina)</option>
                                <option>Quartier Maamora</option>
                                <option>Val Fleuri</option>
                                <option>Bir Rami</option>
                                <option>Saknia</option>
                                <option>Ouled Oujih</option>
                                <option>Kasbah Mehdia</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-ink mb-1.5">Adresse / Rue / Boulevard
                                *</label>
                            <input type="text" value="Avenue Mohammed Diouri, face n° 42" required
                                class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                        </div>
                    </div>

                    <!-- GPS Geolocation Quick Button -->
                    <div
                        class="p-3 bg-emerald-50 rounded-2xl border border-emerald-200 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-xs text-emerald-800">
                            <i data-lucide="crosshair" class="w-4 h-4 text-emerald-700"></i>
                            <span>Coordonnées GPS détectées : <strong class="font-mono">34.2612° N, 6.5802°
                                    W</strong></span>
                        </div>
                        <button type="button"
                            class="text-xs font-semibold text-emerald-700 bg-surface px-3 py-1 rounded-full border border-emerald-300 hover:bg-emerald-100 transition-colors">
                            Recalibrer
                        </button>
                    </div>

                    <!-- Mini Interactive OpenStreetMap Container -->
                    <div class="h-44 rounded-2xl border border-border overflow-hidden relative">
                        <iframe title="Localisation du signalement Kénitra"
                            class="w-full h-full border-0 pointer-events-none"
                            src="https://www.openstreetmap.org/export/embed.html?bbox=-6.60%2C34.25%2C-6.55%2C34.28&amp;layer=mapnik&amp;marker=34.261%2C-6.580"
                            loading="lazy">
                        </iframe>
                        <span
                            class="absolute bottom-2 start-2 bg-surface/90 text-xs px-2.5 py-1 rounded-md text-ink shadow-1 font-medium flex items-center gap-1">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-terracotta-600"></i> Point repéré sur la
                            carte
                        </span>
                    </div>
                </div>

                <!-- Photo Upload Zone -->
                <div class="lg:col-span-5 flex flex-col justify-between">
                    <div>
                        <label class="block text-xs font-semibold text-ink mb-1.5">Joindre une ou plusieurs
                            photos</label>
                        <div
                            class="border-2 border-dashed border-emerald-300/80 bg-emerald-50/40 rounded-2xl p-6 text-center hover:bg-emerald-50 transition-colors cursor-pointer">
                            <div
                                class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="camera" class="w-6 h-6"></i>
                            </div>
                            <p class="text-xs font-semibold text-ink">Cliquez ou déposez votre photo ici</p>
                            <p class="text-[11px] text-muted mt-1">JPEG, PNG ou WEBP jusqu&#39;à 10 Mo</p>
                            <input type="file" class="hidden" id="photo-upload">
                        </div>
                    </div>

                    <!-- Uploaded sample thumbnail preview -->
                    <div class="mt-4 p-3 bg-bg rounded-xl border border-border flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-lg bg-emerald-950 overflow-hidden">
                                <img src="https://lh3.googleusercontent.com/aida/ALJJyrATpG47lstmd6h8URhGTjNkgw4iUSt17uDbQ81JKXSE0ywKbX2LJL7zJFd55Ux0AHelytNMRBJO0uQy68TIwD549foSQBpffadVOV7jejLhXAOnCoDvAcJIGv2Xedd4LK_Ehe19aCRd9btUotiadDHx1uPvat_ub7SmfSIun9gJk6ZWpa9gZGJSXMGp_96PdIASdGyCe_WkohePpUSrGL-3xz0hzDPF-_WMHNJMAa8i72RfBL2I0wYLXnfNpoXTweM"
                                    alt="Preview" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <span class="text-xs font-semibold text-ink block">photo_eclairage_diouri.jpg</span>
                                <span class="text-[10px] text-muted">2.4 Mo • Prêt à l&#39;envoi</span>
                            </div>
                        </div>
                        <button type="button" class="text-muted hover:text-terracotta-600">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
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
                        <h2 class="font-display font-bold text-lg text-ink">Vos coordonnées pour le suivi SMS</h2>
                        <p class="text-xs text-muted">Indispensable pour vous envoyer le numéro de ticket et la photo
                            après
                            réparation.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-ink mb-1.5">Nom et Prénom *</label>
                    <input type="text" value="Karim Bennani" required
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-ink mb-1.5">Numéro de téléphone mobile *</label>
                    <input type="tel" value="+212 6 61 23 45 67" required
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600"
                        dir="ltr">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-ink mb-1.5">Adresse email (optionnel)</label>
                    <input type="email" value="k.bennani@gmail.com"
                        class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                </div>
            </div>

            <div class="mt-6 flex items-start gap-2.5">
                <input type="checkbox" id="consent" checked required
                    class="rounded text-emerald-700 focus:ring-emerald-500 mt-0.5">
                <label for="consent" class="text-xs text-muted leading-relaxed">
                    J&#39;accepte d&#39;être contacté par les services techniques de la Commune de Kénitra pour des
                    précisions
                    relatives à ce signalement conformément à la loi 09-08 (protection des données personnelles).
                </label>
            </div>
        </div>

        <!-- Form Action Submit Button -->
        <div class="pt-6 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-muted flex items-center gap-1.5">
                <i data-lucide="shield-check" class="w-4 h-4 text-emerald-700"></i>
                Signalement transmis directement au régisseur de permanence.
            </p>
            <button type="submit"
                class="w-full sm:w-auto bg-emerald-700 hover:bg-emerald-600 text-white font-semibold text-sm px-8 py-3.5 rounded-full shadow-2 transition-all flex items-center justify-center gap-2">
                <i data-lucide="send" class="w-4 h-4 text-gold-500"></i>
                <span>Transmettre le signalement urbain</span>
            </button>
        </div>

    </form>
</main>

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

    function handleReportSubmit(e) {
        e.preventDefault();
        document.getElementById('urban-report-form').classList.add('hidden');
        document.getElementById('success-banner').classList.remove('hidden');
        window.scrollTo({ top: 200, behavior: 'smooth' });
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