<?php

namespace KG\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relation
 *
 * @ORM\Table(name="relation")
 * @ORM\Entity(repositoryClass="KG\UserBundle\Repository\RelationRepository")
 */
class Relation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="compatibilite", type="string", length=255)
     */
    private $compatibilite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="KG\UserBundle\Entity\User", inversedBy="relations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="KG\UserBundle\Entity\User")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $target;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set compatibilite
     *
     * @param string $compatibilite
     *
     * @return Relation
     */
    public function setCompatibilite($compatibilite)
    {
        $this->compatibilite = $compatibilite;

        return $this;
    }

    /**
     * Get compatibilite
     *
     * @return string
     */
    public function getCompatibilite()
    {
        return $this->compatibilite;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Relation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param \KG\UserBundle\Entity\User $user
     *
     * @return Relation
     */
    public function setUser(\KG\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \KG\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set target
     *
     * @param \KG\UserBundle\Entity\User $target
     *
     * @return Relation
     */
    public function setTarget(\KG\UserBundle\Entity\User $target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return \KG\UserBundle\Entity\User
     */
    public function getTarget()
    {
        return $this->target;
    }
}
