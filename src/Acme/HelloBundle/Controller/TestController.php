<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 31.07.14
 * Time: 16:44
 */

namespace Acme\HelloBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller {

    public function indexAction($type, $name, Request $request){


        $session = $this->get("session");
        //$session->getFlashBag()->add("msg", "Ha-ha!");
        //->getFlashBag()->add("msg1", "Ha-ha-ha!");

        return $this->render("AcmeHelloBundle:Test:index.html.twig", array("name" => $name, "type" => $type));

    }

} 