<?php

namespace LotusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LotusBundle:Default:index.html.twig');
    }
}
