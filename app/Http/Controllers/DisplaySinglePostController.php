<?php

namespace App\Http\Controllers;

use Blog\Domain\Interactor\DisplaySinglePost;
use App\Http\Responders\Html as HtmlResponder;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DisplaySinglePostController extends BaseController
{
    private $action;
    private $responder;

    public function __construct(DisplaySinglePost $action, HtmlResponder $responder)
    {
        $this->action = $action;
        $this->responder = $responder;
    }

    public function __invoke(Request $request, $id)
    {
        $request->attributes->set('_view', 'singlepost');
        $response = new Response();
        return ($this->responder)($request, $response, ($this->action)($id));
    }
}
