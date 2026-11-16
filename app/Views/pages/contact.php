<!DOCTYPE html><html lang="fr" dir="ltr" class="scroll-smooth"><head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact &amp; Accueil Citoyen | Commune de Kénitra</title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&amp;family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&amp;family=Readex+Pro:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Tailwind CSS CDN + Shared Config -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script id="tailwind-config">tailwind.config = {
  theme: {
    extend: {
      colors: {
        'emerald-950': '#04251d',
        'emerald-900': '#06362c',
        'emerald-800': '#08493b',
        'emerald-700': '#0b5d4b',
        'emerald-600': '#137a63',
        'emerald-500': '#1f9a7d',
        'emerald-100': '#d9efe8',
        'emerald-50': '#eef8f4',
        'gold-500': '#c9a24b',
        'gold-600': '#a9822f',
        'gold-100': '#f6ecd2',
        'sebou-600': '#1f6f8b',
        'sebou-100': '#dbeef4',
        'terracotta-600': '#b5532f',
        'sand-100': '#f7f1e3',
        ink: '#10231e',
        text: '#2b3b36',
        muted: '#5e6e68',
        border: '#dfe7e3',
        bg: '#fbfaf6',
        surface: '#ffffff',
        success: '#1e8a5a',
        warning: '#d98c1f',
        danger: '#c0392b',
        info: '#1f6f8b',
      },
      fontFamily: {
        display: ['Readex Pro', 'Noto Kufi Arabic', 'system-ui', 'sans-serif'],
        body: ['IBM Plex Sans', 'IBM Plex Sans Arabic', 'system-ui', 'sans-serif'],
        mono: ['IBM Plex Mono', 'ui-monospace', 'monospace'],
      },
      borderRadius: {
        sm: '8px',
        md: '14px',
        lg: '24px',
        xl: '32px',
        pill: '999px',
      },
      boxShadow: {
        1: '0 1px 2px rgba(6,54,44,.06), 0 1px 1px rgba(6,54,44,.04)',
        2: '0 8px 24px rgba(6,54,44,.08)',
        3: '0 20px 48px rgba(6,54,44,.14)',
      },
    },
  },
};
</script>

  <style>
    :root {
      --emerald-950: #04251d;
      --emerald-900: #06362c;
      --emerald-800: #08493b;
      --emerald-700: #0b5d4b;
      --emerald-600: #137a63;
      --emerald-500: #1f9a7d;
      --emerald-100: #d9efe8;
      --emerald-50:  #eef8f4;
      --gold-500: #c9a24b;
      --gold-600: #a9822f;
      --gold-100: #f6ecd2;
      --sebou-600: #1f6f8b;
      --sebou-100: #dbeef4;
      --terracotta-600: #b5532f;
      --sand-100: #f7f1e3;
      --ink: #10231e;
      --text: #2b3b36;
      --muted: #5e6e68;
      --border: #dfe7e3;
      --bg: #fbfaf6;
      --surface: #ffffff;
      --dir: 1;
    }
    [dir="rtl"] { --dir: -1; }
    body { font-family: 'IBM Plex Sans', sans-serif; background-color: var(--bg); color: var(--text); }
    .font-display { font-family: 'Readex Pro', sans-serif; }
    .pattern-khatam {
      background-image: 
        radial-gradient(circle at 50% 50%, rgba(201, 162, 75, 0.12) 2px, transparent 2px),
        linear-gradient(45deg, rgba(201, 162, 75, 0.06) 25%, transparent 25%, transparent 75%, rgba(201, 162, 75, 0.06) 75%),
        linear-gradient(-45deg, rgba(201, 162, 75, 0.06) 25%, transparent 25%, transparent 75%, rgba(201, 162, 75, 0.06) 75%);
      background-size: 32px 32px;
    }
    .icon-dir { transform: scaleX(var(--dir)); }
  </style>
</head>
<body class="min-h-[1024px] flex flex-col bg-bg text-text antialiased" data-stitch-vh="min-h-[1024px]===min-h-screen">

  <!-- Utility Bar -->
  <div class="bg-emerald-950 text-white/85 text-xs py-2 px-4 sm:px-8 border-b border-emerald-900/60">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <div class="flex items-center gap-2">
        <a href="../../screens/home-portal/HomePortal.html" class="flex items-center gap-1.5 hover:text-gold-500 transition-colors">
          <i data-lucide="arrow-left" class="w-3.5 h-3.5 icon-dir"></i>
          <span>Retour au portail d&#39;accueil Kénitra</span>
        </a>
      </div>
      <div class="flex items-center gap-3">
        <span class="text-gold-500 font-semibold">Bureau d&#39;Ordre &amp; Service d&#39;Accueil Citoyen</span>
      </div>
    </div>
  </div>

  <!-- Hero Header Section -->
  <section class="bg-emerald-900 text-white py-12 px-4 sm:px-8 relative overflow-hidden">
    <div class="absolute inset-0 pattern-khatam pointer-events-none opacity-20"></div>
    <div class="max-w-4xl mx-auto text-center relative z-10">
      
      <!-- Breadcrumb -->
      <nav class="flex items-center justify-center gap-2 text-xs text-emerald-200/70 mb-4">
        <a href="../../screens/home-portal/HomePortal.html" class="hover:text-white">Accueil</a>
        <i data-lucide="chevron-right" class="w-3 h-3 icon-dir"></i>
        <span class="text-gold-500 font-medium">Contact &amp; Permanences</span>
      </nav>

      <h1 class="font-display text-3xl sm:text-5xl font-bold tracking-tight mb-4 text-balance">
        À votre écoute pour toutes vos demandes
      </h1>
      <p class="text-emerald-100/85 text-sm sm:text-base max-w-2xl mx-auto mb-6 font-normal">
        Contactez nos services administratifs, localisez votre annexe de rattachement ou déposez une correspondance officielle auprès du Bureau d&#39;Ordre central.
      </p>

      <!-- Key Contact Numbers Ribbon -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-3xl mx-auto pt-6 border-t border-emerald-800">
        <div class="bg-emerald-950/60 p-3 rounded-2xl border border-emerald-800">
          <span class="text-xs text-gold-500 font-bold block">Standard Hôtel de Ville</span>
          <p class="text-sm font-bold text-white mt-1" dir="ltr">+212 5 37 37 15 18</p>
        </div>
        <div class="bg-emerald-950/60 p-3 rounded-2xl border border-emerald-800">
          <span class="text-xs text-gold-500 font-bold block">Urgence Éclairage &amp; Voirie</span>
          <p class="text-sm font-bold text-white mt-1" dir="ltr">+212 5 37 37 00 22</p>
        </div>
        <div class="bg-emerald-950/60 p-3 rounded-2xl border border-emerald-800">
          <span class="text-xs text-gold-500 font-bold block">Bureau d&#39;Hygiène (BCH)</span>
          <p class="text-sm font-bold text-white mt-1" dir="ltr">+212 5 37 37 44 10</p>
        </div>
        <div class="bg-emerald-950/60 p-3 rounded-2xl border border-emerald-800">
          <span class="text-xs text-gold-500 font-bold block">Courrier Électronique</span>
          <p class="text-sm font-bold text-white mt-1">contact@kenitra.ma</p>
        </div>
      </div>

    </div>
  </section>

  <!-- Main Content Area -->
  <main class="max-w-7xl mx-auto px-4 sm:px-8 py-12 flex-1 w-full space-y-16">
    
    <!-- Section 1: Form & Central Bureau d'Ordre 2-Column Split -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
      
      <!-- Left: Contact Form -->
      <div class="lg:col-span-7 bg-surface rounded-3xl p-6 sm:p-10 border border-border shadow-2">
        <div class="flex items-center gap-3 pb-4 border-b border-border mb-6">
          <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
            <i data-lucide="send" class="w-5 h-5"></i>
          </div>
          <div>
            <h2 class="font-display font-bold text-xl text-ink">Envoyer un message à la Commune</h2>
            <p class="text-xs text-muted">Réponse sous 48 heures ouvrées par le service compétent.</p>
          </div>
        </div>

        <form onsubmit="handleContactSubmit(event)" id="contact-form" class="space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold text-ink mb-1.5">Nom et Prénom *</label>
              <input type="text" required placeholder="Votre nom complet" class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
            </div>
            <div>
              <label class="block text-xs font-semibold text-ink mb-1.5">Numéro de téléphone *</label>
              <input type="tel" required placeholder="+212 6..." class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600" dir="ltr">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold text-ink mb-1.5">Adresse email *</label>
              <input type="email" required placeholder="nom@exemple.ma" class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
            </div>
            <div>
              <label class="block text-xs font-semibold text-ink mb-1.5">Direction destinataire *</label>
              <select class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
                <option>Secrétariat Général / DGS</option>
                <option>Division de l&#39;Urbanisme &amp; Permis</option>
                <option>État Civil &amp; Légalisation</option>
                <option>Espaces Verts &amp; Propreté</option>
                <option>Voirie, Mobilité &amp; Éclairage</option>
                <option>Bureau d&#39;Hygiène (BCH)</option>
                <option>Cabinet de la Présidente</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-ink mb-1.5">Objet de la demande *</label>
            <input type="text" required placeholder="Objet précis de votre correspondance" class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600">
          </div>

          <div>
            <label class="block text-xs font-semibold text-ink mb-1.5">Votre message *</label>
            <textarea rows="4" required placeholder="Exprimez clairement votre demande ou demande d&#39;audience..." class="w-full text-xs sm:text-sm text-ink bg-bg border border-border rounded-xl p-3 focus:ring-1 focus:ring-emerald-600"></textarea>
          </div>

          <div class="flex items-center justify-between pt-4 border-t border-border">
            <span class="text-xs text-muted flex items-center gap-1">
              <i data-lucide="lock" class="w-3.5 h-3.5 text-emerald-700"></i> Données sécurisées CNDP
            </span>
            <button type="submit" class="bg-emerald-700 hover:bg-emerald-600 text-white font-semibold text-xs sm:text-sm px-6 py-3 rounded-full shadow-1 transition-all flex items-center gap-2">
              <i data-lucide="send" class="w-4 h-4 text-gold-500"></i>
              <span>Envoyer le message</span>
            </button>
          </div>
        </form>

        <div id="contact-success" class="hidden p-6 bg-emerald-50 rounded-2xl border border-emerald-300 text-center">
          <div class="w-12 h-12 rounded-full bg-emerald-700 text-white flex items-center justify-center mx-auto mb-3">
            <i data-lucide="check" class="w-6 h-6"></i>
          </div>
          <h4 class="font-display font-bold text-base text-ink mb-1">Message envoyé avec succès</h4>
          <p class="text-xs text-muted">Un accusé de réception a été envoyé à votre adresse email. Votre demande porte la référence <strong class="font-mono">CORR-2026-1182</strong>.</p>
        </div>
      </div>

      <!-- Right: Central Hotel de Ville & Bureau d'Ordre info card -->
      <div class="lg:col-span-5 space-y-6">
        
        <div class="bg-surface rounded-3xl p-6 sm:p-8 border border-border shadow-1">
          <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-700 text-white flex items-center justify-center shadow-1">
              <i data-lucide="building-2" class="w-6 h-6 text-gold-500"></i>
            </div>
            <div>
              <h3 class="font-display font-bold text-lg text-ink">Hôtel de Ville Central</h3>
              <span class="text-xs text-muted">Siège administratif de la Commune</span>
            </div>
          </div>

          <div class="space-y-3 text-xs text-muted border-t border-border pt-4">
            <p class="flex items-start gap-2.5">
              <i data-lucide="map-pin" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
              <span>Avenue Mohammed V, B.P. 14000 Kénitra, Maroc</span>
            </p>
            <p class="flex items-center gap-2.5">
              <i data-lucide="clock" class="w-4 h-4 text-emerald-700 shrink-0"></i>
              <span>Du Lundi au Vendredi : <strong>08h30 – 16h30</strong> (En continu)</span>
            </p>
            <p class="flex items-center gap-2.5">
              <i data-lucide="phone" class="w-4 h-4 text-emerald-700 shrink-0"></i>
              <span>Téléphone : <bdi dir="ltr">+212 5 37 37 15 18</bdi></span>
            </p>
            <p class="flex items-center gap-2.5">
              <i data-lucide="printer" class="w-4 h-4 text-emerald-700 shrink-0"></i>
              <span>Fax officiel : <bdi dir="ltr">+212 5 37 37 15 20</bdi></span>
            </p>
            <p class="flex items-center gap-2.5">
              <i data-lucide="mail" class="w-4 h-4 text-emerald-700 shrink-0"></i>
              <span>Courrier : <strong>bureau.ordre@kenitra.ma</strong></span>
            </p>
          </div>

          <div class="mt-6 pt-4 border-t border-border flex items-center justify-between">
            <span class="text-xs text-emerald-700 font-semibold flex items-center gap-1">
              <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Guichets ouverts
            </span>
            <a href="https://maps.google.com/?q=Kenitra+Hotel+de+Ville" target="_blank" class="text-xs font-semibold text-emerald-700 hover:underline flex items-center gap-1">
              Itinéraire Google Maps <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
            </a>
          </div>
        </div>

        <!-- Bureau d'Ordre Digital Badge -->
        <div class="bg-emerald-50 rounded-3xl p-6 border border-emerald-200">
          <div class="flex items-center gap-3 mb-2">
            <i data-lucide="file-check" class="w-5 h-5 text-emerald-700"></i>
            <h4 class="font-display font-bold text-sm text-ink">Dépôt physique des courriers &amp; factures</h4>
          </div>
          <p class="text-xs text-muted leading-relaxed">
            Le Bureau d&#39;Ordre Central délivre un accusé de réception tamponné avec horodatage électronique pour tout pli remis en mains propres au rez-de-chaussée de l&#39;Hôtel de Ville.
          </p>
        </div>

      </div>

    </div>

  </main>

  <script>
    lucide.createIcons();

    function handleContactSubmit(e) {
      e.preventDefault();
      document.getElementById('contact-form').classList.add('hidden');
      document.getElementById('contact-success').classList.remove('hidden');
    }
  </script>


</body></html>