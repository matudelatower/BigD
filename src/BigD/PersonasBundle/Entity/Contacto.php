<?php

namespace BigD\PersonasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Contacto
 *
 * @ORM\Table(name="contactos")
 * @ORM\Entity
 */
class Contacto {

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
     * @ORM\Column(name="valor", type="string", length=255)
     */
    private $valor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="principal", type="boolean")
     */
    private $principal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validado", type="boolean")
     */
    private $validado;

    /** @ORM\ManyToOne(targetEntity="FuenteDatos")
     *  @ORM\JoinColumn(name="fuente_datos_id", referencedColumnName="id")
     */
    private $fuenteDatos;

    /** @ORM\ManyToOne(targetEntity="TipoContacto")
     *  @ORM\JoinColumn(name="tipo_contacto_id", referencedColumnName="id")
     */
    private $tipoContacto;

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

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set valor
     *
     * @param string $valor
     * @return Contacto
     */
    public function setValor($valor) {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor() {
        return $this->valor;
    }

    /**
     * Set principal
     *
     * @param boolean $principal
     * @return Contacto
     */
    public function setPrincipal($principal) {
        $this->principal = $principal;

        return $this;
    }

    /**
     * Get principal
     *
     * @return boolean 
     */
    public function getPrincipal() {
        return $this->principal;
    }

    /**
     * Set validado
     *
     * @param boolean $validado
     * @return Contacto
     */
    public function setValidado($validado) {
        $this->validado = $validado;

        return $this;
    }

    /**
     * Get validado
     *
     * @return boolean 
     */
    public function getValidado() {
        return $this->validado;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return Contacto
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
     * @return Contacto
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
     * Set fuenteDatos
     *
     * @param \BigD\PersonasBundle\Entity\FuenteDatos $fuenteDatos
     * @return Contacto
     */
    public function setFuenteDatos(\BigD\PersonasBundle\Entity\FuenteDatos $fuenteDatos = null) {
        $this->fuenteDatos = $fuenteDatos;

        return $this;
    }

    /**
     * Get fuenteDatos
     *
     * @return \BigD\PersonasBundle\Entity\FuenteDatos 
     */
    public function getFuenteDatos() {
        return $this->fuenteDatos;
    }

    /**
     * Set tipoContacto
     *
     * @param \BigD\PersonasBundle\Entity\TipoContacto $tipoContacto
     * @return Contacto
     */
    public function setTipoContacto(\BigD\PersonasBundle\Entity\TipoContacto $tipoContacto = null) {
        $this->tipoContacto = $tipoContacto;

        return $this;
    }

    /**
     * Get tipoContacto
     *
     * @return \BigD\PersonasBundle\Entity\TipoContacto 
     */
    public function getTipoContacto() {
        return $this->tipoContacto;
    }

    /**
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return Contacto
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
     * @return Contacto
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
