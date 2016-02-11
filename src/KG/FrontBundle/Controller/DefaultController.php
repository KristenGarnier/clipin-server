<?php

namespace KG\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KGFrontBundle:Default:index.html.twig');
    }
}
