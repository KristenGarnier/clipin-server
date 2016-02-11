<?php

namespace KG\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

/**
 * Class SearchController
 *
 * Api controller to search users in the db
 *
 * @package KG\ApiBundle\Controller
 */
class SearchController extends FOSRestController
{


    /**
     * @param Request $request
     *
     * Method that create the request in the db
     *
     * @return \FOS\RestBundle\View\View
     */
    public function getSearchAction(Request $request)
    {
        try {
            $data = $this->get('verify_data')->checkNoLenght(
                $request->query->all(),
                $this->get('white_list')->userQuery()
            );

            $orderBy= [];

            if($request->get('orderBy') && $request->get('order')){
                $orderBy = [$request->get('orderBy') => $request->get('order')];
            }

            $queryRes =  $this->get('get_or_404')->checkArray(
                $this->getDoctrine()->getRepository('KGUserBundle:User')->findBy(
                    $data,
                    $orderBy,
                    $request->get('limit')
                )
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
