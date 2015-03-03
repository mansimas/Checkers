<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }
    public function rulesAction()
    {
        return $this->render('AppBundle:Default:rules.html.twig');
    }
    public function add($a, $b)
    {
        return $a + $b;
    }
}