<?php

namespace KG\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends FOSRestController
{

    public function getUsersAction(Request $request)
    {
        $users = $this->get('user_handler')->getUsers();

        $routeOptions = array(
            '_format' => $request->get('_format')
        );
        return $this->view($users, Codes::HTTP_OK, $routeOptions);
    }

    public function getUserAction(Request $request, $id)
    {
        try {
            $user = $this->get('get_or_404')->check(
                $this->get('user_handler')->getUser($id)
            );

            $routeOptions = array(
                '_format' => $request->get('_format')
            );
            return $this->view($user, Codes::HTTP_ACCEPTED, $routeOptions);
        } catch (\Exception $e){
            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            if($e->getCode()){
                return $this->view(['error' => $e->getMessage()], $e->getCode(), $routeOptions);
            }

            return $this->view(['error' => $e->getMessage()], Codes::HTTP_CONFLICT, $routeOptions);
        }

    }

    public function postUsersAction(Request $request)
    {
        try {
            $data = $this->get('verify_data')->check(
                $request->request->all(),
                $this->get('white_list')->user()
            );

            $this->get('user_handler')->saveUser($data);

            $routeOptions = array(
                '_format' => $request->get('_format')
            );
            return $this->view($this->get('user_handler')->getUsers(), Codes::HTTP_CREATED, $routeOptions);

        } catch (\Exception $e) {
            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            if($e->getCode()){
                return $this->view(['error' => $e->getMessage()], $e->getCode(), $routeOptions);
            }

            return $this->view(['error' => $e->getMessage()], Codes::HTTP_CONFLICT, $routeOptions);
        }
    }

    public function getUserRelationsAction(Request $request, $id)
    {

        try {

            $user = $this->get('get_or_404')->check(
                $this->get('user_handler')->getUser($id)
            );

            $routeOptions = array(
                '_format' => $request->get('_format')
            );
            return $this->view($user->getRelations()->getValues(), Codes::HTTP_OK, $routeOptions);

        } catch (\Exception $e) {
            $routeOptions = array(
                '_format' => $request->get('_format')
            );
            return $this->view(['error' => $e->getMessage()], Codes::HTTP_CONFLICT, $routeOptions);
        }

    }

    public function getUserRelationAction(Request $request, $id, $target)
    {

        try {

            $relation = $this->get('user_handler')
                ->getUser($id)
                ->getRelations()
                ->filter(function($rel) use ($target){
                    return $rel->getTarget()->getId() === intval($target);
                });


            $routeOptions = array(
                '_format' => $request->get('_format')
            );
            return $this->view($relation[0], Codes::HTTP_OK, $routeOptions);

        } catch (\Exception $e) {
            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            if($e->getCode()){
                return $this->view(['error' => $e->getMessage()], $e->getCode(), $routeOptions);
            }

            return $this->view(['error' => $e->getMessage()], Codes::HTTP_CONFLICT, $routeOptions);
        }

    }

    public function deleteUserRelationAction(Request $request, $id, $target)
    {
        try {
            $user = $this->get('get_or_404')->check(
                $this->get('user_handler')->getUser($id)
            );

            $targetUser = $this->get('get_or_404')->check(
                $this->get('user_handler')->getUser($target)
            );

            $this->get('user_handler')->deleteUserRelation($user, $targetUser);

            $routeOptions = array(
                '_format' => $request->get('_format')
            );
            return $this->view(null, Codes::HTTP_NO_CONTENT, $routeOptions);

        } catch (\Exception $e) {

            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            if($e->getCode()){
                return $this->view(['error' => $e->getMessage()], $e->getCode(), $routeOptions);
            }

            return $this->view(['error' => $e->getMessage()], Codes::HTTP_CONFLICT, $routeOptions);

        }
    }

    public function postUserRelationAction(Request $request, $id)
    {
        try {

            $user = $this->get('get_or_404')->check(
                $this->get('user_handler')->getUser($id)
            );

            $target = $this->get('user_handler')->getUser($request->get('user'));

            $this->get('user_handler')->addRelation($user, $target,
                $this->get('check_compatibility')->isValid($request->get('compatibility'))
            );

            $routeOptions = array(
                '_format' => $request->get('_format')
            );
            return $this->view(null, Codes::HTTP_CREATED, $routeOptions);

        } catch (\Exception $e) {
            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            if($e->getCode()){
                return $this->view(['error' => $e->getMessage()], $e->getCode(), $routeOptions);
            }

            return $this->view(['error' => $e->getMessage()], Codes::HTTP_CONFLICT, $routeOptions);
        }

    }

    public function patchUserAction(Request $request, $id)
    {
        try {

            $data = $this->get('verify_data')->checkNoLenght(
                $request->request->all(),
                $this->get('white_list')->user()
            );

            $user = $this->get('get_or_404')->check(
                $this->get('user_handler')->getUser($id)
            );

            $this->get('user_handler')->updateUser($data, $user);

            $routeOptions = array(
                '_format' => $request->get('_format')
            );
            return $this->view(null, Codes::HTTP_NO_CONTENT, $routeOptions);

        } catch (\Exception $e) {
            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            if($e->getCode()){
                return $this->view(['error' => $e->getMessage()], $e->getCode(), $routeOptions);
            }

            return $this->view(['error' => $e->getMessage()], Codes::HTTP_CONFLICT, $routeOptions);
        }
    }

    public function deleteUserAction(Request $request, $id)
    {
        try {
            $user = $this->get('get_or_404')->check(
                $this->get('user_handler')->getUser($id)
            );

            $this->get('user_handler')->deleteUser($user);

            $routeOptions = array(
                '_format' => $request->get('_format')
            );
            return $this->view(null, Codes::HTTP_NO_CONTENT, $routeOptions);

        } catch (\Exception $e) {

            $routeOptions = array(
                '_format' => $request->get('_format')
            );

            if($e->getCode()){
                return $this->view(['error' => $e->getMessage()], $e->getCode(), $routeOptions);
            }

            return $this->view(['error' => $e->getMessage()], Codes::HTTP_CONFLICT, $routeOptions);

        }
    }
}
