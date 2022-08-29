<?php

namespace Alisson04\Nis\Controllers\Citizen;

use Alisson04\Nis\Controllers\ViewTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class HomeController implements RequestHandlerInterface
{
    use ViewTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->view('citizens/home.php', ['title' => 'Cidadãos']);
        return new Response(200, [], $html);
    }
}
