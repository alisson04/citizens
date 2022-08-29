<?php

namespace Alisson04\Nis\Infrastructure\Repositories;

use Alisson04\Nis\Domain\Models\Citizen;
use Alisson04\Nis\Domain\Repositories\CitizenRepository;
use PDO;

class PdoCitizenRepository implements CitizenRepository
{
    private PDO $connection;
    public const TABLE = 'citizens';

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Citizen $citizen): bool
    {
        return $this->insert($citizen);
    }

    public function findByNis(string $nis): Citizen
    {
        return $this->selectByNis($nis);
    }

    private function selectByNis(string $nis): Citizen
    {
        $query = "SELECT * FROM " . Self::TABLE . " WHERE nis = :nis";
        $stmt = $this->connection->prepare($query);

        $stmt->execute(['nis' => $nis]);

        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$record) {
            return new Citizen(null, '', null);
        }

        return new Citizen($record['id'], $record['name'], $record['nis']);
    }

    private function insert(Citizen $citizen): bool
    {
        $query = "INSERT INTO " . Self::TABLE . " (name) VALUES (:name);";
        $stmt = $this->connection->prepare($query);

        $success = $stmt->execute(['name' => $citizen->name]);

        if ($success) {
            $citizen->id = $this->connection->lastInsertId();
        }

        return $success && $this->generateNis($citizen);
    }

    public function generateNis(Citizen $citizen): bool
    {
        $citizen->nis = (int) substr_replace('00000000000', $citizen->id, 0, strlen($citizen->id));

        $query = "UPDATE " . Self::TABLE . " SET nis = :nis WHERE id = :id;";
        $stmt = $this->connection->prepare($query);

        $success = $stmt->execute(['nis' => $citizen->nis, 'id' => $citizen->id]);

        if ($success) {
            $citizen->id = $this->connection->lastInsertId();
        }

        return $success;
    }
}
