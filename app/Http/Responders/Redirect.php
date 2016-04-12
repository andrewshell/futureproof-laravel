<?php
namespace App\Http\Responders;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Redirect extends Html
{
    protected function success($payload)
    {
        $redirect = $this->request->attributes->get('_redirect', '/');
        $this->response->setStatusCode(301);
        $this->response->headers->set('Location', $redirect);
    }
}
