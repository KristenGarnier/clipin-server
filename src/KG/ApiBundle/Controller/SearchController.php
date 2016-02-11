<?php

namespace KG\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

class SearchController extends FOSRestController
{
    public function getSearchAction(Request $request)
    {
        try {
            $data = $this->get('verify_data')->checkNoLenght(
                $request->query->all(),
                $this->get('white_list')->user()
            );

            $orderBy= [];

            if($request->get('orderBy') && $request->get('order')){
                $orderBy = [$request->get('orderBy') => $request->get('order')];
            }


            $queryRes =  $this->get('get_or_404')->checkArray(
                $this->getDoctrine()->getRepository('KGUserBundle:User')->findBy($data, $orderBy)
            );

            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            return $this->view($queryRes, Codes::HTTP_OK, $routeOptions);

        } catch (\Exception $e) {
            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            if ($e->getCode()) {
                return $this->view(['error' => $e->getMessage()], $e->getCode(), $routeOptions);
            }
        }
    }
}
