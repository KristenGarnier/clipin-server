<?php

namespace KG\ApiBundle\Handlers;

use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManager;
use KG\UserBundle\Entity\Relation;
use KG\UserBundle\Entity\User;

class UserHandler
{
    /**
     * Doctrine entity manager
     * @var ObjectManager
     */
    private $om;
    /**
     * Name of the entity
     * @var
     */
    private $entityClass;
    /**
     * Rempository of the current entity
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    private $manager;


    public function __construct(ObjectManager $om, $entityClass, UserManager $manager)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->manager = $manager;

    }

    public function getUsers()
    {
        return $this->repository->findAll();
    }

    public function getUser(int $id)
    {
        return $this->repository->find($id);
    }

    public function saveUser(array $data)
    {
        $user = $this->manager->createUser();

        $user->setEnabled(true);
        $this->hydrate($data, $user);

        $this->manager->updateUser($user);
    }

    public function updateUser(array $data, User $user)
    {

        $this->hydrate($data, $user);

        $this->manager->updateUser($user);
    }

    public function deleteUser(User $user)
    {

        $this->manager->deleteUser($user);

    }

    public function addRelation(User $user, User $target)
    {
        $relation = new Relation();

        $relation->setCompatibilite(60);
        $relation->setDate(new \DateTime());
        $relation->setTarget($target);

        $user->addRelation($relation);

        $this->manager->updateUser($user);
    }

    public function deleteUserRelation(User $user, User $target)
    {
        $t = $this->om->getRepository('KGUserBundle:Relation')->findOneBy(['target' => $target]);
        $user->removeRelation($t);

        $this->om->remove($t);
        $this->om->flush();
    }

    /**
     * @param array              $data
     * @param User|UserInterface $user
     */
    private function hydrate(array $data, $user)
    {
        foreach ($data as $key => $value) {
            if ($key === 'password') {
                $user->setPlainPassword($value);
            } else {
                $method = "set" . ucfirst($key);
                $user->{$method}($value);
            }
        }
    }


}