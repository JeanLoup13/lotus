<?php

namespace LotusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MaterielFamilleCaracteristique
 *
 * @ORM\Table(name="materiel_famille_caracteristique")
 * @ORM\Entity(repositoryClass="LotusBundle\Repository\MaterielFamilleCaracteristiqueRepository")
 */
class MaterielFamilleCaracteristique
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
     * @var int
     *
     * @ORM\Column(name="mesure", type="integer", nullable=true)
     */
    private $mesure;


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
     * @return MaterielFamilleCaracteristique
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
     * Set mesure
     *
     * @param integer $mesure
     *
     * @return MaterielFamilleCaracteristique
     */
    public function setMesure($mesure)
    {
        $this->mesure = $mesure;

        return $this;
    }

    /**
     * Get mesure
     *
     * @return int
     */
    public function getMesure()
    {
        return $this->mesure;
    }
}

