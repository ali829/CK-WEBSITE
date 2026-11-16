<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class DocumentProcedure
{
    private PDO $db;

    private const FEATURED_LABEL =
        'Permis de Construire (Bâtir) — Logement Individuel & Collectif';

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Shared query for procedures and their related service/division.
     */
    private function baseQuery(): string
    {
        return "
            SELECT
                dp.*,

                s.label_fr AS service_fr,
                s.label_ar AS service_ar,

                d.label_fr AS division_fr,
                d.label_ar AS division_ar

            FROM document_procedures dp

            LEFT JOIN services s
                ON dp.service_id = s.id

            LEFT JOIN divisions d
                ON s.division_id = d.id
        ";
    }

    /**
     * Retrieve the featured building permit.
     */
    public function getFeatured(): ?array
    {
        $sql = $this->baseQuery() . "
            WHERE dp.label_fr = :label
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'label' => self::FEATURED_LABEL,
        ]);

        $procedure = $stmt->fetch(PDO::FETCH_ASSOC);

        return $procedure ?: null;
    }

    /**
     * Retrieve all procedures except the featured one.
     */
    public function getAllExceptFeatured(): array
    {
        $sql = $this->baseQuery() . "
            WHERE dp.label_fr <> :label
            ORDER BY dp.label_fr ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'label' => self::FEATURED_LABEL,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve ordered steps for a procedure.
     */
    public function getSteps(int $procedureId): array
    {
        $sql = "
            SELECT
                id,
                position,
                label_ar,
                label_fr,
                description_ar,
                description_fr
            FROM document_procedure_steps
            WHERE document_procedure_id = :procedure_id
            ORDER BY position ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'procedure_id' => $procedureId,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
