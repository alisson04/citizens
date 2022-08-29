<?php

namespace Alisson04\Nis\Domain\Models;

class Citizen
{
    public ?int $id;
    public string $name;
    public ?string $nis;

    public function __construct(?int $id, string $name, ?string $nis)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nis = $nis;
    }
}
