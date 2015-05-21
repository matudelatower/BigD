<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaniaEncuestaAgrupadorPregunta
 *
 * @ORM\Table(name="campania_encuesta_agrupador_pregunta")
 * @ORM\Entity
 */
class CampaniaEncuestaAgrupadorPregunta
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
     * @ORM\Column(name="multiple", type="string", length=255)
     */
    private $multiple;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /** @ORM\ManyToOne(targetEntity="CampaniaEncuesta")
     *  @ORM\JoinColumn(name="campania_encuesta_id", referencedColumnName="id")
     */
    private $campaniaEncuesta;
    
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
     * @return CampaniaEncuestaAgrupadorPregunta
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
     * @return CampaniaEncuestaAgrupadorPregunta
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
     * Set multiple
     *
     * @param string $multiple
     * @return CampaniaEncuestaAgrupadorPregunta
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Get multiple
     *
     * @return string 
     */
    public function getMultiple()
    {
        return $this->multiple;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return CampaniaEncuestaAgrupadorPregunta
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
}
