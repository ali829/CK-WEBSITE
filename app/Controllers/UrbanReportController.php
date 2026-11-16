<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Language;
use App\Core\View;
use App\Models\UrbanReport;

final class UrbanReportController
{
    private UrbanReport $urbanReport;

    private const MAX_FILE_SIZE = 10 * 1024 * 1024;

    public function __construct()
    {
        $this->urbanReport = new UrbanReport();
    }

    /**
     * Display the urban report form.
     */
    public function index(): void
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        if (empty($_SESSION['tracking_csrf_token'])) {
            $_SESSION['tracking_csrf_token'] = bin2hex(random_bytes(32));
        }

        $this->renderForm();
    }

    /**
     * Handle urban report submission.
     */
    public function store(): void
    {
        $errors = [];

        // 1. Verify CSRF token.
        $submittedToken = $_POST['csrf_token'] ?? '';

        if (
            !is_string($submittedToken) ||
            !hash_equals($_SESSION['csrf_token'] ?? '', $submittedToken)
        ) {
            $errors[] = 'Votre session a expiré. Veuillez actualiser la page.';
        }

        // 2. Read and validate submitted fields.
        $urbanCatId = filter_var(
            $_POST['urban_cat_id'] ?? null,
            FILTER_VALIDATE_INT
        );

        $neighborhoodId = filter_var(
            $_POST['neighborhood_id'] ?? null,
            FILTER_VALIDATE_INT
        );

        $location = trim($_POST['location'] ?? '');
        $object = trim($_POST['object'] ?? '');
        $message = trim($_POST['message'] ?? '');
        $fullname = trim($_POST['fullname'] ?? '');
        $phoneNumber = trim($_POST['phone_number'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (
            !$urbanCatId || $urbanCatId < 1 ||
            !$this->urbanReport->categoryExists($urbanCatId)
        ) {
            $errors[] = 'Veuillez sélectionner une catégorie valide.';
        }

        if (
            !$neighborhoodId || $neighborhoodId < 1 ||
            !$this->urbanReport->neighborhoodExists($neighborhoodId)
        ) {
            $errors[] = 'Veuillez sélectionner un quartier valide.';
        }

        if ($location === '' || mb_strlen($location) > 255) {
            $errors[] = 'Veuillez fournir une adresse valide.';
        }

        if ($object === '' || mb_strlen($object) > 255) {
            $errors[] = 'Veuillez fournir un intitulé valide.';
        }

        if ($message === '') {
            $errors[] = 'Veuillez décrire le problème constaté.';
        }

        if ($fullname === '' || mb_strlen($fullname) > 150) {
            $errors[] = 'Veuillez fournir votre nom complet.';
        }

        if ($phoneNumber === '' || mb_strlen($phoneNumber) > 12) {
            $errors[] = 'Veuillez fournir un numéro de téléphone valide.';
        }

        if (
            $email !== '' &&
            (
                !filter_var($email, FILTER_VALIDATE_EMAIL) ||
                mb_strlen($email) > 254
            )
        ) {
            $errors[] = 'Veuillez fournir une adresse email valide.';
        }

        // 3. Validate the optional image.
        $file = $_FILES['file'] ?? null;

        if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'Une erreur est survenue lors de l’envoi de la photo.';
            } elseif ($file['size'] > self::MAX_FILE_SIZE) {
                $errors[] = 'La photo ne doit pas dépasser 10 Mo.';
            } elseif (!is_uploaded_file($file['tmp_name'])) {
                $errors[] = 'Fichier envoyé non valide.';
            } else {
                $finfo = new \finfo(FILEINFO_MIME_TYPE);
                $mimeType = $finfo->file($file['tmp_name']);

                $allowedTypes = [
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/webp' => 'webp',
                ];

                if (!isset($allowedTypes[$mimeType])) {
                    $errors[] = 'Format de photo non autorisé.';
                }
            }
        }

        // Stop if validation failed.
        if ($errors !== []) {
            $this->renderForm(['errors' => $errors]);
            return;
        }

        // 4. Store the uploaded image, if provided.
        $storedFile = null;
        $absoluteFilePath = null;

        try {
            if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
                $uploadDirectory = dirname(__DIR__, 2)
                    . '/storage/uploads/urban-reports';

                if (
                    !is_dir($uploadDirectory) &&
                    !mkdir($uploadDirectory, 0750, true) &&
                    !is_dir($uploadDirectory)
                ) {
                    throw new \RuntimeException('Upload directory unavailable.');
                }

                $extension = $allowedTypes[$mimeType];
                $filename = bin2hex(random_bytes(16)) . '.' . $extension;

                $absoluteFilePath = $uploadDirectory . '/' . $filename;

                if (!move_uploaded_file($file['tmp_name'], $absoluteFilePath)) {
                    throw new \RuntimeException('Unable to store uploaded image.');
                }

                $storedFile = 'urban-reports/' . $filename;
            }

            // 5. Generate a unique reference number.
            $referenceNumber = 'KTR-' . date('Y') . '-'
                . strtoupper(bin2hex(random_bytes(4)));

            // 6. Save the report.
            $this->urbanReport->create([
                'reference_number' => $referenceNumber,
                'urban_cat_id' => $urbanCatId,
                'neighborhood_id' => $neighborhoodId,
                'location' => $location,
                'object' => $object,
                'message' => $message,
                'file' => $storedFile,
                'fullname' => $fullname,
                'phone_number' => $phoneNumber,
                'email' => $email !== '' ? $email : null,
            ]);

            // Rotate the token after successful submission.
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

            $this->renderForm([
                'success' => true,
                'referenceNumber' => $referenceNumber,
            ]);

        } catch (\Throwable $exception) {
            // Remove the uploaded file if database insertion failed.
            if ($absoluteFilePath && is_file($absoluteFilePath)) {
                unlink($absoluteFilePath);
            }

            error_log($exception->getMessage());

            $this->renderForm([
                'errors' => [
                    'Une erreur est survenue. Veuillez réessayer ultérieurement.'
                ],
            ]);
        }
    }

    /**
     * Render the form with the required data.
     */
    private function renderForm(array $extraData = []): void
    {
        View::render('services/urban-report', array_merge([
            'categories' => $this->urbanReport->getCategories(),
            'neighborhoods' => $this->urbanReport->getNeighborhoods(),
            'language' => Language::code(),
            'direction' => Language::direction(),
        ], $extraData));
    }



    /**
     * Display the urban report tracking page.
     */
    public function tracking(): void
    {
        if (empty($_SESSION['tracking_csrf_token'])) {
            $_SESSION['tracking_csrf_token'] = bin2hex(random_bytes(32));
        }

        $referenceNumber = $_SESSION['tracking_reference'] ?? null;
        $report = null;


        if (is_string($referenceNumber) && $referenceNumber !== '') {
            $report = $this->urbanReport->findByReference($referenceNumber);
        }



        View::render('services/urban-report-tracking', [
            'report' => $report,
            'referenceNumber' => $referenceNumber ?? '',
        ]);
    }

    /**
     * Search for an urban report using its reference number.
     */
    public function searchTracking(): void
    {
        unset($_SESSION['tracking_reference']);
        // 1. Verify CSRF token.
        $submittedToken = $_POST['csrf_token'] ?? '';

        if (
            !is_string($submittedToken) ||
            !hash_equals(
                $_SESSION['tracking_csrf_token'] ?? '',
                $submittedToken
            )
        ) {
            $this->renderTracking([
                'error' => 'Votre session a expiré. Veuillez actualiser la page.',
            ]);

            return;
        }

        // 2. Read and normalize the reference number.
        $referenceNumber = strtoupper(
            trim($_POST['reference_number'] ?? '')
        );

        // 3. Validate reference number format.
        if (
            !preg_match('/^KTR-\d{4}-[A-F0-9]{8,32}$/', $referenceNumber)
        ) {
            $this->renderTracking([
                'error' => 'Veuillez saisir un numéro de référence valide.',
            ]);

            return;
        }

        // 4. Search the database.
        try {
            $report = $this->urbanReport->findByReference($referenceNumber);

            if ($report === null) {
                $this->renderTracking([
                    'error' => 'Aucun signalement ne correspond à ce numéro de référence.',
                    'referenceNumber' => $referenceNumber,
                ]);

                return;
            }

            $_SESSION['tracking_reference'] = $referenceNumber;

            // 5. Display the report.
            $this->renderTracking([
                'report' => $report,
                'referenceNumber' => $referenceNumber,
            ]);

        } catch (\Throwable $exception) {
            error_log($exception->getMessage());

            $this->renderTracking([
                'error' => 'Une erreur est survenue. Veuillez réessayer ultérieurement.',
            ]);
        }
    }

    /**
     * Render the tracking page.
     */
    private function renderTracking(array $extraData = []): void
    {
        View::render('services/urban-report-tracking', array_merge([
            'language' => Language::code(),
            'direction' => Language::direction(),
        ], $extraData));
    }

}
