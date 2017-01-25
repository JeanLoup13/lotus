<?php

namespace LotusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materiel
 *
 * @ORM\Table(name="materiel")
 * @ORM\Entity(repositoryClass="LotusBundle\Repository\MaterielRepository")
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="code_fournisseur", type="string", length=255, nullable=true)
     */
    private $codeFournisseur;

    /**
     * @var int
     *
     * @ORM\Column(name="code_ean", type="integer", nullable=true)
     */
    private $codeEan;

    /**
     * @var int
     *
     * @ORM\Column(name="marque", type="integer", nullable=true)
     */
    /**
     * @ORM\OneToOne(targetEntity="LotusBundle\Entity\Marque")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque;
    
    /**
     * @var int
     *
     * @ORM\Column(name="materiel_famille", type="integer", nullable=true)
     */
    /**
     * @ORM\ManyToOne(targetEntity="LotusBundle\Entity\MaterielFamille")
     * @ORM\JoinColumn(nullable=false)
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Materiel
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
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
}

