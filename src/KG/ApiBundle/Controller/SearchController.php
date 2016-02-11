<?php

namespace KG\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends FOSRestController
{
    public function getSearchAction(Request $request)
    {
        try{
            return $this->get('get_or_404')->checkArray(
                $this->getDoctrine()->getRepository('KGUserBundle:User')->findBy($request->query->all())
            );
        } catch (\Exception $e){
            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            if($e->getCode()){
                return $this->view(['error' => $e->getMessage()], $e->getCode(), $routeOptions);
            }
        }
    }
}
