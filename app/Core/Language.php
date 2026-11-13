<?php

/**
 * RULES :
 * - French (fr) is the default language.
 * - Arabic (ar) is the second supported language.
 * - Only fr and ar are accepted.
 * - Invalid language values fall back to French
 * - Missing translation keys fall back to French, then to the key itself.
 */

declare(strict_types=1);

namespace App\Core;

class Language
{
    private const LANGUAGE_PATH = __DIR__ . '/../../lang/';

    private static string $currentLanguage = 'fr';

    private static array $translations = [];

    public static function initialize(?string $language = null): void
    {
        $supportedLanguages = ['fr', 'ar'];

        if (!in_array($language, $supportedLanguages, true)) {
            $language = 'fr';
        }

        self::$currentLanguage = $language;

        $file = self::LANGUAGE_PATH . $language . '.php';

        self::$translations = require $file;
    }

    public static function get(string $key): string
    {
        if (isset(self::$translations[$key])) {
            return self::$translations[$key];
        }

        // Fall back to French if the selected translation is missing.
        if (self::$currentLanguage !== 'fr') {
            $frenchTranslations = require self::LANGUAGE_PATH . 'fr.php';

            if (isset($frenchTranslations[$key])) {
                return $frenchTranslations[$key];
            }
        }

        // Last fallback: return the translation key.
        return $key;
    }

    public static function code(): string
    {
        return self::$currentLanguage;
    }

    public static function direction(): string
    {
        return self::$currentLanguage === 'ar' ? 'rtl' : 'ltr';
    }
}