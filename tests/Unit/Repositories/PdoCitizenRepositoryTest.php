<?php

namespace Alisson04\Nis\Tests\Unit\Repositories;

use Alisson04\Nis\Domain\Models\Citizen;
use Alisson04\Nis\Infrastructure\Persistence\ConnectionCreator;
use Alisson04\Nis\Infrastructure\Repositories\PdoCitizenRepository;
use Alisson04\Nis\Tests\TestCase;
use Alisson04\Nis\Tests\TestInterface;
use \PDO;

class PdoCitizenRepositoryTest extends TestCase implements TestInterface
{
    protected PdoCitizenRepository $pdoRepository;
    protected PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createTestConnection();
        $this->pdoRepository = new PdoCitizenRepository($this->connection);
        $this->errorMessage = '';
    }

    public function runTests(): string
    {
        $methods = ['saveTest', 'findByNisTest'];

        foreach ($methods as $method) {
            $this->cleanTable();

            if (!$this->$method()) {
                $this->errorMessage = "BROKE TEST: " . __CLASS__ . ":$method(" . $this->errorMessage .")";
                break;
            }

            echo '.';
        }

        return $this->errorMessage;
    }

    private function saveTest(): bool
    {
        $citizen = new Citizen(null, 'Citizen Test', null);

        $success = $this->pdoRepository->save($citizen);

        return $this->assertTrue($success);
    }

    private function findByNisTest(): bool
    {
        $nonexistentNis = '00000000000';
        $existentNis = '10000000000';
        $this->pdoRepository->save(new Citizen(null, 'Citizen Test', null));

        $nonexistentCitizenId = $this->pdoRepository->findByNis($nonexistentNis)->id;
        $existentCitizenId = $this->pdoRepository->findByNis($existentNis)->id;


        return $this->assertIsNull($nonexistentCitizenId) && $this->assertIsNotNull($existentCitizenId);
    }
}