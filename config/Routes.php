<?php

namespace Alisson04\Nis\Config;

use Alisson04\Nis\Controllers\Citizen\CreateController;
use Alisson04\Nis\Controllers\Citizen\FindByNisController;
use Alisson04\Nis\Controllers\Citizen\HomeController;

class Routes
{
    public static function getRoutes(): array
    {
        return [
            '/citizens' => HomeController::class,
            '/citizens/save' => CreateController::class,
            '/citizens/find_by_nis' => FindByNisController::class,
        ];
    }
}
