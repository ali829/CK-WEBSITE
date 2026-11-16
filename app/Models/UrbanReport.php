<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class UrbanReport
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Retrieve all urban report categories.
     */
    public function getCategories(): array
    {
        $sql = "
            SELECT id, label_ar, label_fr, description_ar,
            description_fr, icon
            FROM urban_category
            ORDER BY label_fr ASC
        ";

        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Retrieve all neighborhoods.
     */
    public function getNeighborhoods(): array
    {
        $sql = "
            SELECT id, label_ar, label_fr
            FROM neighborhood
            ORDER BY label_fr ASC
        ";

        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Create a new urban report.
     */
    public function create(array $data): int
    {
        $sql = "
            INSERT INTO urban_reports (
                reference_number,
                urban_cat_id,
                neighborhood_id,
                location,
                object,
                message,
                file,
                fullname,
                phone_number,
                email
            ) VALUES (
                :reference_number,
                :urban_cat_id,
                :neighborhood_id,
                :location,
                :object,
                :message,
                :file,
                :fullname,
                :phone_number,
                :email
            )
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'reference_number' => $data['reference_number'],
            'urban_cat_id' => $data['urban_cat_id'],
            'neighborhood_id' => $data['neighborhood_id'],
            'location' => $data['location'],
            'object' => $data['object'],
            'message' => $data['message'],
            'file' => $data['file'] ?? null,
            'fullname' => $data['fullname'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'] ?? null,
        ]);

        return (int) $this->db->lastInsertId();
    }


    /**
     * Check whether a category exists.
     */
    public function categoryExists(int $id): bool
    {
        $stmt = $this->db->prepare(
            "SELECT 1 FROM urban_category WHERE id = :id LIMIT 1"
        );

        $stmt->execute(['id' => $id]);

        return (bool) $stmt->fetchColumn();
    }

    /**
     * Check whether a neighborhood exists.
     */
    public function neighborhoodExists(int $id): bool
    {
        $stmt = $this->db->prepare(
            "SELECT 1 FROM neighborhood WHERE id = :id LIMIT 1"
        );

        $stmt->execute(['id' => $id]);

        return (bool) $stmt->fetchColumn();
    }


/**
 * Find an urban report using its reference number.
 */
public function findByReference(string $referenceNumber): ?array
{
    $sql = "
        SELECT
            ur.id,
            ur.reference_number,
            ur.status,
            ur.location,
            ur.object,
            ur.message,
            ur.created_at,
            uc.label_fr AS category_fr,
            uc.label_ar AS category_ar,
            n.label_fr AS neighborhood_fr,
            n.label_ar AS neighborhood_ar

        FROM urban_reports ur

        INNER JOIN urban_category uc
            ON ur.urban_cat_id = uc.id

        INNER JOIN neighborhood n
            ON ur.neighborhood_id = n.id

        WHERE ur.reference_number = :reference_number

        LIMIT 1
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        'reference_number' => $referenceNumber
    ]);

    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    return $report ?: null;
}

}
