<?php

declare(strict_types=1);

function t(string $key): string
{
    $translationText = htmlspecialchars(\App\Core\Language::get($key), ENT_QUOTES, 'UTF-8');
    return $translationText;
}