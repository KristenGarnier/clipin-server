<?php

namespace KG\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="UserRepository")
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
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    protected $age;

    /**
     * @var string
     *
     * @ORM\Column(name="metier", type="string", length=255, nullable=true)
     */
    protected $metier;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    protected $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    protected $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable=true)
     */
    protected $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    protected $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="entreprise", type="string", length=255, nullable=true)
     */
    protected $entreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255, nullable=true)
     */
    protected $uuid;

    /**
     * @var int
     *
     * @ORM\Column(name="total_rencontres", type="integer", nullable=true)
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

    /**
     * @var object
     *
     * @ORM\Column(name="image", type="text", nullable=true)
     */
    protected $image;

    /**
     * @var int
     *
     * @ORM\Column(name="salaireminimum", type="integer", nullable=true)
     */
    protected $salaireminimum;

    /**
     * @var string
     *
     * @ORM\Column(name="experiencespro", type="text", nullable=true)
     */
    protected $experiencespro;

    /**
     * @var string
     *
     * @ORM\Column(name="competence", type="text", nullable=true)
     */
    protected $competence;

    /**
     * @var boolean
     *
     * @ORM\Column(name="permis", type="boolean", nullable=true)
     */
    protected $permis;

    /**
     * @var string
     *
     * @ORM\Column(name="hobbies", type="text", nullable=true)
     */
    protected $hobbies;

    /**
     * @var string
     *
     * @ORM\Column(name="diplome", type="string", nullable=true)
     */
    protected $diplome;

    /**
     * @var string
     *
     * @ORM\Column(name="preferences", type="text", nullable=true)
     */
    protected $preferences;

    /**
     * @var string
     *
     * @ORM\Column(name="etre", type="string", nullable=true)
     */
    protected $etre;

    /**
     * @var string
     *
     * @ORM\Column(name="recherche", type="string", nullable=true)
     */
    protected $recherche;

    /**
     * @var string
     *
     * @ORM\Column(name="parametres", type="text")
     */
    protected $parametres = '{}';

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
        $this->relations->map(function ($item) use ($relations) {
            array_push($relations, $item);
        });
        return $relations;
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

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getMetier()
    {
        return $this->metier;
    }

    /**
     * @param string $metier
     */
    public function setMetier($metier)
    {
        $this->metier = $metier;
    }

    /**
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param string $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * @param mixed $entreprise
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return object
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param object $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Set salaireminimum
     *
     * @param integer $salaireminimum
     *
     * @return User
     */
    public function setSalaireminimum($salaireminimum)
    {
        $this->salaireminimum = $salaireminimum;

        return $this;
    }

    /**
     * Get salaireminimum
     *
     * @return integer
     */
    public function getSalaireminimum()
    {
        return $this->salaireminimum;
    }

    /**
     * Set experiencespro
     *
     * @param string $experiencespro
     *
     * @return User
     */
    public function setExperiencespro($experiencespro)
    {
        $this->experiencespro = $experiencespro;

        return $this;
    }

    /**
     * Get experiencespro
     *
     * @return string
     */
    public function getExperiencespro()
    {
        return $this->experiencespro;
    }

    /**
     * Set competence
     *
     * @param string $competence
     *
     * @return User
     */
    public function setCompetence($competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get competence
     *
     * @return string
     */
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Set permis
     *
     * @param boolean $permis
     *
     * @return User
     */
    public function setPermis($permis)
    {
        $this->permis = $permis;

        return $this;
    }

    /**
     * Get permis
     *
     * @return boolean
     */
    public function getPermis()
    {
        return $this->permis;
    }

    /**
     * Set hobbies
     *
     * @param string $hobbies
     *
     * @return User
     */
    public function setHobbies($hobbies)
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    /**
     * Get hobbies
     *
     * @return string
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * Set diplome
     *
     * @param string $diplome
     *
     * @return User
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * Get diplome
     *
     * @return string
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * @return string
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * @param string $preferences
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;
    }

    /**
     * Set etre
     *
     * @param boolean $etre
     *
     * @return User
     */
    public function setEtre($etre)
    {
        $this->etre = $etre;

        return $this;
    }

    /**
     * Get etre
     *
     * @return boolean
     */
    public function getEtre()
    {
        return $this->etre;
    }

    /**
     * Set recherche
     *
     * @param boolean $recherche
     *
     * @return User
     */
    public function setRecherche($recherche)
    {
        $this->recherche = $recherche;

        return $this;
    }

    /**
     * Get recherche
     *
     * @return boolean
     */
    public function getRecherche()
    {
        return $this->recherche;
    }

    /**
     * Set parametres
     *
     * @param string $parametres
     *
     * @return User
     */
    public function setParametres($parametres)
    {
        $this->parametres = $parametres;

        return $this;
    }

    /**
     * Get parametres
     *
     * @return string
     */
    public function getParametres()
    {
        return $this->parametres;
    }
}
