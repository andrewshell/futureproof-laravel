<?php

namespace App\Http\Controllers;

use Blog\Domain\Interactor\CreateNewPost;
use Blog\Domain\Interactor\CreateNewPost\Request as CreateNewPostRequest;
use App\Http\Responders\Redirect as RedirectResponder;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateNewPostController extends BaseController
{
    private $action;
    private $responder;

    public function __construct(CreateNewPost $action, RedirectResponder $responder)
    {
        $this->action = $action;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        $response = new Response();
        return ($this->responder)($request, $response, ($this->action)(
            new CreateNewPostRequest(
                $request->input('title'),
                $request->input('content'),
                $request->input('excerpt')
            )
        ));
    }
}
