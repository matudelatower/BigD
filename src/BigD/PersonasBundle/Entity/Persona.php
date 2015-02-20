<?php

namespace BigD\PersonasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="personas")
 * @ORM\Entity(repositoryClass="BigD\PersonasBundle\Entity\PersonaRepository")
 */
class Persona
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
     * @ORM\Column(name="otro_nombre", type="string", length=255, nullable=true)
     */
    private $otroNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="otro_apellido", type="string", length=255)
     */
    private $otroApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="calle", type="string", length=255)
     */
    private $calle;

    /**
     * @var string
     *
     * @ORM\Column(name="altura", type="string", length=255)
     */
    private $altura;

    /**
     * @var string
     *
     * @ORM\Column(name="coordenada", type="string", length=255, nullable=true)
     */
    private $coordenada;
    
    /** @ORM\ManyToOne(targetEntity="BigD\UbicacionBundle\Entity\Localidad")
     *  @ORM\JoinColumn(name="localidad_id", referencedColumnName="id")
     */
    private $localidad;


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
     * @return Persona
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
     * Set otroNombre
     *
     * @param string $otroNombre
     * @return Persona
     */
    public function setOtroNombre($otroNombre)
    {
        $this->otroNombre = $otroNombre;

        return $this;
    }

    /**
     * Get otroNombre
     *
     * @return string 
     */
    public function getOtroNombre()
    {
        return $this->otroNombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Persona
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set otroApellido
     *
     * @param string $otroApellido
     * @return Persona
     */
    public function setOtroApellido($otroApellido)
    {
        $this->otroApellido = $otroApellido;

        return $this;
    }

    /**
     * Get otroApellido
     *
     * @return string 
     */
    public function getOtroApellido()
    {
        return $this->otroApellido;
    }

    /**
     * Set calle
     *
     * @param string $calle
     * @return Persona
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set altura
     *
     * @param string $altura
     * @return Persona
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get altura
     *
     * @return string 
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set coordenada
     *
     * @param string $coordenada
     * @return Persona
     */
    public function setCoordenada($coordenada)
    {
        $this->coordenada = $coordenada;

        return $this;
    }

    /**
     * Get coordenada
     *
     * @return string 
     */
    public function getCoordenada()
    {
        return $this->coordenada;
    }

    /**
     * Set localidad
     *
     * @param \BigD\UbicacionBundle\Entity\Localidad $localidad
     * @return Persona
     */
    public function setLocalidad(\BigD\UbicacionBundle\Entity\Localidad $localidad = null)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidadUbic
     *
     * @return \BigD\UbicacionBundle\Entity\Localidad 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }
}
