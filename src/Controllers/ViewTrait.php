<?php

namespace Alisson04\Nis\Controllers;

trait ViewTrait
{
    private function view(string $templatePath, array $data): string
    {
        extract($data);
        ob_start();

        require __DIR__ . '/../../resources/views/' . $templatePath;

        return ob_get_clean();
    }
}
