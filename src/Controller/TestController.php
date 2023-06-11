<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Runtime\Symfony\Component\HttpFoundation\RequestRuntime;

class TestController
{

    public function index()
    {
        $request = Request::createFromGlobals();
        $age = $request->query->get('age', 0);
        dd("ça fonctionnnne $age");
    }
    /**
     * @Route(": /test",name="test",methods={"GET","POST"})
     */
    public function test(Request $request)
    {

        $age = $request->query->get('age', 0);
        return new Response("vous avez d $age ans");
    }
}
