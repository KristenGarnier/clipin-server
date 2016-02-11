<?php

namespace KG\UserBundle\Controller;

use KG\UserBundle\Entity\Relation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KGUserBundle:Default:index.html.twig');
    }

    public function enrichUserAction($id)
    {
        $useren = $this
            ->getDoctrine()
            ->getRepository('KGUserBundle:User')
            ->find($id);


        $rel = new Relation();
        $rel->setCompatibilite(60);
        $rel->setDate(new \DateTime());
        $rel->setTarget($useren);

        $user = $this->getDoctrine()->getRepository('KGUserBundle:User')->find($this->getUser()->getId());

        $user->addRelation($rel);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();


        return $this->redirect($this->generateUrl('kg_admin_homepage'));
    }
}
