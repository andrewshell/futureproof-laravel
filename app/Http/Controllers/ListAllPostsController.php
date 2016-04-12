<?php

namespace App\Http\Controllers;

use Blog\Domain\Interactor\ListAllPosts;
use App\Http\Responders\Html as HtmlResponder;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListAllPostsController extends BaseController
{
    private $action;
    private $responder;

    public function __construct(ListAllPosts $action, HtmlResponder $responder)
    {
        $this->action = $action;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        $request->attributes->set('_view', 'listposts');
        $response = new Response();
        return ($this->responder)($request, $response, ($this->action)());
    }
}
