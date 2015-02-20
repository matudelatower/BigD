<?php

namespace BigD\UbicacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localidad
 *
 * @ORM\Table(name="localidades")
 * @ORM\Entity(repositoryClass="BigD\UbicacionBundle\Entity\LocalidadRepository")
 */
class Localidad
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_postal", type="string", length=255)
     */
    private $codigoPostal;

    
    /** @ORM\ManyToOne(targetEntity="Provincia", inversedBy="localidad")
     *  @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     */
    private $provincia;

    public function __toString() {
        return $this->descripcion;
    }
    
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Localidad
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
     * Set codigo
     *
     * @param string $codigo
     * @return Localidad
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set codigoPostal
     *
     * @param string $codigoPostal
     * @return Localidad
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return string 
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set provincia
     *
     * @param \BigD\UbicacionBundle\Entity\Provincia $provincia
     * @return Localidad
     */
    public function setProvincia(\BigD\UbicacionBundle\Entity\Provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \BigD\UbicacionBundle\Entity\Provincia 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}
