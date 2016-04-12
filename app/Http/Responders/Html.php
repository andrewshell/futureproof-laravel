<?php
namespace App\Http\Responders;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Html
{
    protected $request;

    protected $response;

    protected $factory;

    public function __construct(ViewFactory $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke(
        Request $request,
        Response $response,
        array $payload
    ) {
        $this->request = $request;
        $this->response = $response;
        if (isset($payload['success']) && true === $payload['success']) {
            $this->success($payload);
        } else {
            $this->error($payload);
        }
        return $this->response;
    }

    protected function htmlBody(array $data)
    {
        $view = $this->request->attributes->get('_view', 'default');
        $body = $this->factory->make($view, $data);
        $this->response->headers->set('Content-Type', 'text/html');
        $this->response->setContent($body->render());
    }

    protected function success($payload)
    {
        $this->response->setStatusCode(200);
        $this->htmlBody($payload);
    }

    protected function error($payload)
    {
        $this->response->setStatusCode(500);
        $this->request->attributes->set('_view', 'error');
        $this->htmlBody($payload);
    }
}
