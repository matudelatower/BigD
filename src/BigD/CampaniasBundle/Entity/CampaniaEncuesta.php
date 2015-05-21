<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaniaEncuesta
 *
 * @ORM\Table(name="campania_encuesta")
 * @ORM\Entity
 */
class CampaniaEncuesta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /** @ORM\ManyToOne(targetEntity="Campania")
     *  @ORM\JoinColumn(name="campania_id", referencedColumnName="id")
     */
    private $campania;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CampaniaEncuesta
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CampaniaEncuesta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return CampaniaEncuesta
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set campania
     *
     * @param \BigD\CampaniasBundle\Entity\Campania $campania
     * @return CampaniaEncuesta
     */
    public function setCampania(\BigD\CampaniasBundle\Entity\Campania $campania = null)
    {
        $this->campania = $campania;

        return $this;
    }

    /**
     * Get campania
     *
     * @return \BigD\CampaniasBundle\Entity\Campania 
     */
    public function getCampania()
    {
        return $this->campania;
    }
}
