<!DOCTYPE html>
<html lang="<?= \App\Core\Language::code(); ?>" dir="<?= \App\Core\Language::direction(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= t('site_name') ?></title>
</head>

<body>
    <a href="?lang=fr">Français</a>
    <a href="?lang=ar">العربية</a>
    <?php require __DIR__ . '/partials/header.php'; ?>

    <?php require __DIR__ . '/partials/navbar.php'; ?>
    <?= t('welcome') ?>
    <main>
        <?= $content ?>
    </main>

    <?php require __DIR__ . '/partials/footer.php'; ?>

</body>

</html>