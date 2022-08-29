<?php

namespace Alisson04\Nis\Controllers\Citizen;

use Alisson04\Nis\Domain\Models\Citizen;
use Alisson04\Nis\Infrastructure\Persistence\ConnectionCreator;
use Alisson04\Nis\Infrastructure\Repositories\PdoCitizenRepository;
use Nyholm\Psr7\Response;
use PDOException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CreateController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

        try {
            $citizen = new Citizen(null, $name, null);
            $repository = new PdoCitizenRepository(ConnectionCreator::createConnection());
            $repository->save($citizen);

            $responseInterface = json_encode($citizen);
        } catch (PDOException $e) {
            $responseInterface = json_encode(['error' => $e->getMessage()]);
        }

        return new Response(200, [], $responseInterface);
    }
}
