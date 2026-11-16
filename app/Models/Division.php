<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class Division
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAllWithServices(): array
    {
        $sql = "
            SELECT
                d.id AS division_id,
                d.label_fr AS division_label_fr,
                d.label_ar AS division_label_ar,
                d.description_fr AS division_description_fr,
                d.description_ar AS division_description_ar,
                d.location_fr AS division_location_fr,
                d.location_ar AS division_location_ar,

                s.id AS service_id,
                s.label_fr AS service_label_fr,
                s.label_ar AS service_label_ar,
                s.description_fr AS service_description_fr,
                s.description_ar AS service_description_ar

            FROM divisions d
            LEFT JOIN services s ON s.division_id = d.id
            ORDER BY d.id ASC, s.id ASC
        ";

        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $divisions = [];

        foreach ($rows as $row) {
            $divisionId = (int) $row['division_id'];

            if (!isset($divisions[$divisionId])) {
                $divisions[$divisionId] = [
                    'id' => $divisionId,
                    'label_fr' => $row['division_label_fr'],
                    'label_ar' => $row['division_label_ar'],
                    'description_fr' => $row['division_description_fr'],
                    'description_ar' => $row['division_description_ar'],
                    'location_fr' => $row['division_location_fr'],
                    'location_ar' => $row['division_location_ar'],
                    'services' => [],
                ];
            }

            if ($row['service_id'] !== null) {
                $divisions[$divisionId]['services'][] = [
                    'id' => (int) $row['service_id'],
                    'label_fr' => $row['service_label_fr'],
                    'label_ar' => $row['service_label_ar'],
                    'description_fr' => $row['service_description_fr'],
                    'description_ar' => $row['service_description_ar'],
                ];
            }
        }

        return array_values($divisions);
    }
}
