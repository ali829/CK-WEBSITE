<!DOCTYPE html>
<html lang="<?= \App\Core\Language::code(); ?>" dir="<?= \App\Core\Language::direction(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= t('site_name') ?></title>
    <!-- Styles -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/app.css">
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

<body class="min-h-[1024px] flex flex-col bg-bg text-text antialiased" data-stitch-vh="min-h-[1024px]===min-h-screen">
    <i data-lucide="MonitorStop" class="text-green-500 h-10 w-10"></i>
    <a href="?lang=fr">Français</a>
    <a href="?lang=ar">العربية</a>

    <?php require __DIR__ . '/partials/navbar.php'; ?>
    <?= t('welcome') ?>
    <main>
        <?= $content ?>
    </main>

    <?php require __DIR__ . '/partials/footer.php'; ?>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>