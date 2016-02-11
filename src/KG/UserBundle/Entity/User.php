<?php

namespace KG\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez entrer votre nom", groups={"Registration", "Profile"})
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez entrer votre prénom", groups={"Registration", "Profile"})
     */
    protected $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255)
     */
    protected $uuid;

    /**
     * @var int
     *
     * @ORM\Column(name="total_rencontres", type="integer")
     */
    protected $totalRencontres = 0;

    /**
     * @ORM\OneToMany(targetEntity="KG\UserBundle\Entity\Social", mappedBy="user", cascade={"persist", "remove"})
     *
     */
    protected $socials;

    /**
     * @ORM\OneToMany(targetEntity="KG\UserBundle\Entity\Relation", mappedBy="user",  cascade={"persist", "remove"})
     */
    protected $relations;

    public function __construct()
    {
        parent::__construct();
        $this->relations = new ArrayCollection();
        $this->socials = new ArrayCollection();
    }

    /**
     * Add social
     *
     * @param \KG\UserBundle\Entity\Social $social
     *
     * @return User
     */
    public function addSocial(\KG\UserBundle\Entity\Social $social)
    {
        $this->socials[] = $social;

        $social->setUser($this);

        return $this;
    }

    /**
     * Remove social
     *
     * @param \KG\UserBundle\Entity\Social $social
     */
    public function removeSocial(\KG\UserBundle\Entity\Social $social)
    {
        $this->socials->removeElement($social);
    }

    /**
     * Get socials
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSocials()
    {
        return $this->socials;
    }

    /**
     * Add relation
     *
     * @param \KG\UserBundle\Entity\Relation $relation
     *
     * @return User
     */
    public function addRelation(\KG\UserBundle\Entity\Relation $relation)
    {
        $this->relations[] = $relation;
        $relation->setUser($this);
        return $this;
    }

    /**
     * Remove relation
     *
     * @param \KG\UserBundle\Entity\Relation $relation
     */
    public function removeRelation(\KG\UserBundle\Entity\Relation $relation)
    {
        $this->relations->removeElement($relation);
    }

    /**
     * Get relations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelations()
    {
        return new ArrayCollection($this->relations->toArray());
    }

    /**
     * Get relations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelationsArray()
    {
        $relations = [];
        $this->relations->map(function($item) use ($relations){
            array_push($relations, $item);
        });
        return  $relations;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set totalRencontres
     *
     * @param integer $totalRencontres
     *
     * @return User
     */
    public function setTotalRencontres($totalRencontres)
    {
        $this->totalRencontres = $totalRencontres;

        return $this;
    }

    /**
     * Get totalRencontres
     *
     * @return integer
     */
    public function getTotalRencontres()
    {
        return $this->totalRencontres;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     *
     * @return User
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }
}
