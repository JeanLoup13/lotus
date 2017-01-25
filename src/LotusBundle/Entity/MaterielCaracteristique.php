<?php

namespace LotusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MaterielCaracteristique
 *
 * @ORM\Table(name="materiel_caracteristique")
 * @ORM\Entity(repositoryClass="LotusBundle\Repository\MaterielCaracteristiqueRepository")
 */
class MaterielCaracteristique
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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;


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
     * Set value
     *
     * @param string $value
     *
     * @return MaterielCaracteristique
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}

