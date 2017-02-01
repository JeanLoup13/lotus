<?php

namespace LotusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zone
 *
 * @ORM\Table(name="zone")
 * @ORM\Entity(repositoryClass="LotusBundle\Repository\ZoneRepository")
 */
class Zone
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
     * @ORM\Column(name="zone_secteur", type="integer", nullable=true)
     */
    /**
     * @ORM\OneToOne(targetEntity="LotusBundle\Entity\ZoneSecteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zoneSecteur;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="zone_type", type="integer", nullable=true)
     */
    /**
     * @ORM\OneToOne(targetEntity="LotusBundle\Entity\ZoneType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zoneType;


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
     * @return Zone
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
     * Set zoneSecteur
     *
     * @param integer $zoneSecteur
     *
     * @return Zone
     */
    public function setZoneSecteur(ZoneSecteur $zoneSecteur)
    {
        $this->zoneSecteur = $zoneSecteur;
        return $this;
    }

    /**
     * Get zoneSecteur
     *
     * @return ZoneSecteur
     */
    public function getZoneSecteur()
    {
        return $this->zoneSecteur;
    }
    
    /**
     * Set zoneType
     *
     * @param integer $zoneType
     *
     * @return Zone
     */
    public function setZoneType(ZoneType $zoneType)
    {
        $this->zoneType = $zoneType;
        return $this;
    }

    /**
     * Get zoneType
     *
     * @return ZoneType
     */
    public function getZoneType()
    {
        return $this->zoneType;
    }
}

