<?php

namespace LotusBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Materiel
 *
 * @ORM\Table(name="materiel")
 * @ORM\Entity(repositoryClass="LotusBundle\Repository\MaterielRepository")
 * @ORM\HasLifecycleCallBacks()
 */
class Materiel
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="code_fournisseur", type="string", length=255, nullable=true)
     */
    private $codeFournisseur;

    /**
     * @var int
     *
     * @ORM\Column(name="code_ean", type="integer", nullable=true, unique=true)
     */
    private $codeEan;

    /**
     * @ORM\ManyToOne(targetEntity="LotusBundle\Entity\Marque")
     * @ORM\JoinColumn(nullable=true)
     */
    private $marque;
    
    /**
     * @ORM\ManyToOne(targetEntity="LotusBundle\Entity\MaterielFamille")
     * @ORM\JoinColumn(nullable=true)
     */
    private $materielFamille;

    /**
     * @var bool
     *
     * @ORM\Column(name="consommable", type="boolean")
     */
    private $consommable;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="outil", type="boolean")
     */
    private $outil;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime $activeChanged
     *
     * @ORM\Column(name="active_changed", type="datetime", nullable=true)
     */
    private $activeChanged;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="LotusBundle\Entity\Image")
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;
    
    
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
     * Set title
     *
     * @param string $title
     *
     * @return Materiel
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set codeFournisseur
     *
     * @param string $codeFournisseur
     *
     * @return Materiel
     */
    public function setCodeFournisseur($codeFournisseur)
    {
        $this->codeFournisseur = $codeFournisseur;

        return $this;
    }

    /**
     * Get codeFournisseur
     *
     * @return string
     */
    public function getCodeFournisseur()
    {
        return $this->codeFournisseur;
    }

    /**
     * Set codeEan
     *
     * @param integer $codeEan
     *
     * @return Materiel
     */
    public function setCodeEan($codeEan)
    {
        $this->codeEan = $codeEan;
        return $this;
    }

    /**
     * Get codeEAn
     *
     * @return int
     */
    public function getCodeEan()
    {
        return $this->codeEan;
    }

    /**
     * Set marque
     *
     * @param integer $marque
     *
     * @return Materiel
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return int
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set image
     *
     * @param integer $image
     *
     * @return Materiel
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return int
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Materiel
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }
    
    /**
     * Set consommable
     *
     * @param boolean $consommable
     *
     * @return Materiel
     */
    public function setConsommable($consommable)
    {
        $this->consommable = $consommable;

        return $this;
    }

    /**
     * Get consommable
     *
     * @return bool
     */
    public function getConsommable()
    {
        return $this->consommable;
    }

    /**
     * Set outil
     *
     * @param boolean $outil
     *
     * @return Materiel
     */
    public function setOutil($outil)
    {
        $this->outil = $outil;

        return $this;
    }

    /**
     * Get outil
     *
     * @return bool
     */
    public function getOutil()
    {
        return $this->outil;
    }
    
    /**
     * Set materielFamille
     *
     * @param $materielFamille
     *
     * @return Materiel
     */
    public function setMaterielFamille(MaterielFamille $materielFamille)
    {
        $this->materielFamille = $materielFamille;

        return $this;
    }

    /**
     * Get materielFamille
     *
     * @return MaterielFamille
     */
    public function getMaterielFamille()
    {
        return $this->materielFamille;
    }
    
    /**
     * Set updatedAt
     * @param datetime $updatedAt
     *
     * @return Materiel
     */
    public function setUpdatedAt($dateTime) 
    {  
        $this->updatedAt = $dateTime;  
    }  
  
    /** 
     * Get createdAt 
     * 
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /** 
     * Set createdAt 
     *
     * @param datetime $createdAt
     *
     * @return Materiel
     */  
    public function setCreatedAt($dateTime) 
    {  
        $this->createdAt = $dateTime;  
    }  
  
    /** 
     * Get createdAt 
     * 
     * @return \DateTime 
     */  
    public function getCreatedAt()  
    {  
        return $this->createdAt;  
    }
    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime());

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime());
        }
    }
}

