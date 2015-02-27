<?php

namespace BigD\UbicacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ORM\OneToMany(targetEntity="Departamento", mappedBy="provincia")
     */
    private $departamento;

    /** @ORM\ManyToOne(targetEntity="Pais")
     *  @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     */
    private $pais;

    /**
     * @var datetime $creado
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="creado", type="datetime")
     */
    private $creado;

    /**
     * @var datetime $actualizado
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="actualizado",type="datetime")
     */
    private $actualizado;

    /**
     * @var integer $creadoPor
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="BigD\UsuariosBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="creado_por", referencedColumnName="id", nullable=true)
     */
    private $creadoPor;

    /**
     * @var integer $actualizadoPor
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="BigD\UsuariosBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="actualizado_por", referencedColumnName="id", nullable=true)
     */
    private $actualizadoPor;

    public function __toString() {
        return $this->descripcion;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->departamento = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Provincia
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Provincia
     */
    public function setCodigo($codigo) {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo() {
        return $this->codigo;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return Provincia
     */
    public function setCreado($creado) {
        $this->creado = $creado;

        return $this;
    }

    /**
     * Get creado
     *
     * @return \DateTime 
     */
    public function getCreado() {
        return $this->creado;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Provincia
     */
    public function setActualizado($actualizado) {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * Get actualizado
     *
     * @return \DateTime 
     */
    public function getActualizado() {
        return $this->actualizado;
    }

    /**
     * Add departamento
     *
     * @param \BigD\UbicacionBundle\Entity\Departamento $departamento
     * @return Provincia
     */
    public function addDepartamento(\BigD\UbicacionBundle\Entity\Departamento $departamento) {
        $this->departamento[] = $departamento;

        return $this;
    }

    /**
     * Remove departamento
     *
     * @param \BigD\UbicacionBundle\Entity\Departamento $departamento
     */
    public function removeDepartamento(\BigD\UbicacionBundle\Entity\Departamento $departamento) {
        $this->departamento->removeElement($departamento);
    }

    /**
     * Get departamento
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartamento() {
        return $this->departamento;
    }

    /**
     * Set pais
     *
     * @param \BigD\UbicacionBundle\Entity\Pais $pais
     * @return Provincia
     */
    public function setPais(\BigD\UbicacionBundle\Entity\Pais $pais = null) {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \BigD\UbicacionBundle\Entity\Pais 
     */
    public function getPais() {
        return $this->pais;
    }

    /**
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return Provincia
     */
    public function setCreadoPor(\BigD\UsuariosBundle\Entity\Usuario $creadoPor = null) {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    /**
     * Get creadoPor
     *
     * @return \BigD\UsuariosBundle\Entity\Usuario 
     */
    public function getCreadoPor() {
        return $this->creadoPor;
    }

    /**
     * Set actualizadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $actualizadoPor
     * @return Provincia
     */
    public function setActualizadoPor(\BigD\UsuariosBundle\Entity\Usuario $actualizadoPor = null) {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Get actualizadoPor
     *
     * @return \BigD\UsuariosBundle\Entity\Usuario 
     */
    public function getActualizadoPor() {
        return $this->actualizadoPor;
    }

}
