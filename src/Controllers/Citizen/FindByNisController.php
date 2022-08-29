<?php

namespace Alisson04\Nis\Controllers\Citizen;

use Alisson04\Nis\Infrastructure\Persistence\ConnectionCreator;
use Alisson04\Nis\Infrastructure\Repositories\PdoCitizenRepository;
use Nyholm\Psr7\Response;
use PDOException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FindByNisController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $nis = filter_input(INPUT_POST, 'nis', FILTER_SANITIZE_STRING);

        try {
            $repository = new PdoCitizenRepository(ConnectionCreator::createConnection());
            $citizen = $repository->findByNis($nis);

            $responseInterface = json_encode($citizen);
        } catch (PDOException $e) {
            $responseInterface = json_encode(['error' => $e->getMessage()]);
        }

        return new Response(200, [], $responseInterface);
    }
}
