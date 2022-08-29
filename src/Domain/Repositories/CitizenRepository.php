<?php

namespace Alisson04\Nis\Domain\Repositories;

use Alisson04\Nis\Domain\Models\Citizen;

interface CitizenRepository
{
    public function save(Citizen $citizen): bool;
    public function findByNis(string $nis): Citizen;
}