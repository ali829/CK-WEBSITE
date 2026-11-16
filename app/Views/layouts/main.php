<!DOCTYPE html>
<html lang="<?= \App\Core\Language::code(); ?>" dir="<?= \App\Core\Language::direction(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= t('site_name') ?></title>
    <!-- Styles -->
    <!-- <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/app.css"> -->
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
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/main.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&amp;family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&amp;family=Readex+Pro:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <!-- Development version -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="min-h-screen flex flex-col bg-bg text-text antialiased">
    <?php require __DIR__ . '/partials/navbar.php'; ?>
    <?= $content ?>

    <?php require __DIR__ . '/partials/footer.php'; ?>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>