<?php

namespace KG\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KGAdminBundle:Default:index.html.twig');
    }
}
