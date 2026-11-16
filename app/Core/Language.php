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

        // A valid URL language parameter takes priority.
        if (in_array($language, $supportedLanguages, true)) {
            $_SESSION['language'] = $language;
        } else {
            // Otherwise, restore the previously selected language.
            $language = $_SESSION['language'] ?? 'fr';
        }

        // Final validation.
        if (!in_array($language, $supportedLanguages, true)) {
            $language = 'fr';
            $_SESSION['language'] = 'fr';
        }

        self::$currentLanguage = $language;

        $file = self::LANGUAGE_PATH . $language . '.php';
        self::$translations = require $file;
    }

    public static function get(string $key): string
    {
        // Search in the selected language.
        $translation = self::findTranslation(self::$translations, $key);

        if ($translation !== null) {
            return $translation;
        }

        // Fall back to French.
        if (self::$currentLanguage !== 'fr') {
            $frenchTranslations = require self::LANGUAGE_PATH . 'fr.php';

            $translation = self::findTranslation($frenchTranslations, $key);

            if ($translation !== null) {
                return $translation;
            }
        }

        // Last fallback: return the translation key.
        return $key;
    }

    /**
     * Retrieve a translation using dot notation.
     */
    private static function findTranslation(array $translations, string $key): ?string
    {
        $keys = explode('.', $key);
        $value = $translations;

        foreach ($keys as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return null;
            }

            $value = $value[$segment];
        }

        return is_string($value) ? $value : null;
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