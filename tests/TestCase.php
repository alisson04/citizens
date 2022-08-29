<?php

namespace Alisson04\Nis\Tests;

abstract class TestCase
{
    protected string $errorMessage;

    protected function assertTrue($compare): bool
    {
        $assert = $compare === true;

        if (!$assert) {
            $this->errorMessage = 'Was waiting for TRUE - Received FALSE';
        }

        return $assert;
    }

    protected function assertFalse($compare): bool
    {
        $assert = $compare === false;

        if (!$assert) {
            $this->errorMessage = 'Was waiting for FALSE - Received TRUE';
        }

        return $assert;
    }

    protected function assertIsNull($compare): bool
    {
        $assert = is_null($compare);

        if (!$assert) {
            $this->errorMessage = 'Was waiting for NULL - Received NOT NULL';
        }

        return $assert;
    }

    protected function assertIsNotNull($compare): bool
    {
        $assert = !is_null($compare);

        if (!$assert) {
            $this->errorMessage = 'Was waiting for NOT NULL - Received NULL';
        }

        return $assert;
    }

    protected function cleanTable(): bool
    {
        $query = "DELETE FROM " . $this->pdoRepository::TABLE;
        return $this->connection->query($query)->execute();
    }
}