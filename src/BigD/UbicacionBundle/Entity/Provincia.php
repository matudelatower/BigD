<?php

namespace BigD\UbicacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Provincia
 *
 * @ORM\Table(name="provincias")
 * @ORM\Entity
 */
class Provincia {

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
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @ORM\OneToMany(targetEntity="Localidad", mappedBy="provincia")
     */
    private $localidad;

    /** @ORM\ManyToOne(targetEntity="Pais")
     *  @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     */
    private $pais;

    public function __toString() {
        return $this->descripcion;
    }
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->localidad = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Provincia
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
     * @return Provincia
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
     * Add localidad
     *
     * @param \BigD\UbicacionBundle\Entity\Localidad $localidad
     * @return Provincia
     */
    public function addLocalidad(\BigD\UbicacionBundle\Entity\Localidad $localidad)
    {
        $this->localidad[] = $localidad;

        return $this;
    }

    /**
     * Remove localidad
     *
     * @param \BigD\UbicacionBundle\Entity\Localidad $localidad
     */
    public function removeLocalidad(\BigD\UbicacionBundle\Entity\Localidad $localidad)
    {
        $this->localidad->removeElement($localidad);
    }

    /**
     * Get localidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set pais
     *
     * @param \BigD\UbicacionBundle\Entity\Pais $pais
     * @return Provincia
     */
    public function setPais(\BigD\UbicacionBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \BigD\UbicacionBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }
}
