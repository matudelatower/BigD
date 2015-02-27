<?php

namespace BigD\PersonasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Domicilio
 *
 * @ORM\Table(name="domicilios")
 * @ORM\Entity
 */
class Domicilio {

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
     * @ORM\Column(name="calle", type="string", length=255, nullable=true)
     */
    private $calle;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="partida", type="string", length=255, nullable=true)
     */
    private $partida;

    /**
     * @var string
     *
     * @ORM\Column(name="seccion", type="string", length=255, nullable=true)
     */
    private $seccion;

    /**
     * @var string
     *
     * @ORM\Column(name="chacra", type="string", length=255, nullable=true)
     */
    private $chacra;

    /**
     * @var string
     *
     * @ORM\Column(name="manzana", type="string", length=255, nullable=true)
     */
    private $manzana;

    /**
     * @var string
     *
     * @ORM\Column(name="lote", type="string", length=255, nullable=true)
     */
    private $lote;

    /**
     * @var string
     *
     * @ORM\Column(name="parcela", type="string", length=255, nullable=true)
     */
    private $parcela;

    /**
     * @var string
     *
     * @ORM\Column(name="coordenada", type="string", length=255, nullable=true)
     */
    private $coordenada;

    /**
     * @var string
     *
     * @ORM\Column(name="edificio", type="string", length=255, nullable=true)
     */
    private $edificio;

    /**
     * @var string
     *
     * @ORM\Column(name="piso", type="string", length=255, nullable=true)
     */
    private $piso;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=255, nullable=true)
     */
    private $departamento;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

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

    /** @ORM\ManyToOne(targetEntity="BigD\UbicacionBundle\Entity\Localidad")
     *  @ORM\JoinColumn(name="localidad_id", referencedColumnName="id")
     */
    private $localidad;

    /** @ORM\ManyToOne(targetEntity="TipoDomicilio")
     *  @ORM\JoinColumn(name="tipo_domicilio_id", referencedColumnName="id")
     */
    private $tipoDomicilio;

    /** @ORM\ManyToOne(targetEntity="FuenteDatos")
     *  @ORM\JoinColumn(name="fuente_datos_id", referencedColumnName="id")
     */
    private $fuenteDatos;

    /** @ORM\ManyToOne(targetEntity="Persona", inversedBy="domicilio")
     *  @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     */
    private $persona;

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
     * Set calle
     *
     * @param string $calle
     * @return Domicilio
     */
    public function setCalle($calle) {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle() {
        return $this->calle;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return Domicilio
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set partida
     *
     * @param string $partida
     * @return Domicilio
     */
    public function setPartida($partida) {
        $this->partida = $partida;

        return $this;
    }

    /**
     * Get partida
     *
     * @return string 
     */
    public function getPartida() {
        return $this->partida;
    }

    /**
     * Set seccion
     *
     * @param string $seccion
     * @return Domicilio
     */
    public function setSeccion($seccion) {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get seccion
     *
     * @return string 
     */
    public function getSeccion() {
        return $this->seccion;
    }

    /**
     * Set chacra
     *
     * @param string $chacra
     * @return Domicilio
     */
    public function setChacra($chacra) {
        $this->chacra = $chacra;

        return $this;
    }

    /**
     * Get chacra
     *
     * @return string 
     */
    public function getChacra() {
        return $this->chacra;
    }

    /**
     * Set manzana
     *
     * @param string $manzana
     * @return Domicilio
     */
    public function setManzana($manzana) {
        $this->manzana = $manzana;

        return $this;
    }

    /**
     * Get manzana
     *
     * @return string 
     */
    public function getManzana() {
        return $this->manzana;
    }

    /**
     * Set lote
     *
     * @param string $lote
     * @return Domicilio
     */
    public function setLote($lote) {
        $this->lote = $lote;

        return $this;
    }

    /**
     * Get lote
     *
     * @return string 
     */
    public function getLote() {
        return $this->lote;
    }

    /**
     * Set parcela
     *
     * @param string $parcela
     * @return Domicilio
     */
    public function setParcela($parcela) {
        $this->parcela = $parcela;

        return $this;
    }

    /**
     * Get parcela
     *
     * @return string 
     */
    public function getParcela() {
        return $this->parcela;
    }

    /**
     * Set coordenada
     *
     * @param string $coordenada
     * @return Domicilio
     */
    public function setCoordenada($coordenada) {
        $this->coordenada = $coordenada;

        return $this;
    }

    /**
     * Get coordenada
     *
     * @return string 
     */
    public function getCoordenada() {
        return $this->coordenada;
    }

    /**
     * Set edificio
     *
     * @param string $edificio
     * @return Domicilio
     */
    public function setEdificio($edificio) {
        $this->edificio = $edificio;

        return $this;
    }

    /**
     * Get edificio
     *
     * @return string 
     */
    public function getEdificio() {
        return $this->edificio;
    }

    /**
     * Set piso
     *
     * @param string $piso
     * @return Domicilio
     */
    public function setPiso($piso) {
        $this->piso = $piso;

        return $this;
    }

    /**
     * Get piso
     *
     * @return string 
     */
    public function getPiso() {
        return $this->piso;
    }

    /**
     * Set departamento
     *
     * @param string $departamento
     * @return Domicilio
     */
    public function setDepartamento($departamento) {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return string 
     */
    public function getDepartamento() {
        return $this->departamento;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Domicilio
     */
    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones() {
        return $this->observaciones;
    }

    /**
     * Set principal
     *
     * @param boolean $principal
     * @return Domicilio
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
     * @return Domicilio
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
     * @return Domicilio
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
     * @return Domicilio
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
     * Set localidad
     *
     * @param \BigD\UbicacionBundle\Entity\Localidad $localidad
     * @return Domicilio
     */
    public function setLocalidad(\BigD\UbicacionBundle\Entity\Localidad $localidad = null) {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return \BigD\UbicacionBundle\Entity\Localidad 
     */
    public function getLocalidad() {
        return $this->localidad;
    }

    /**
     * Set tipoDomicilio
     *
     * @param \BigD\PersonasBundle\Entity\TipoDomicilio $tipoDomicilio
     * @return Domicilio
     */
    public function setTipoDomicilio(\BigD\PersonasBundle\Entity\TipoDomicilio $tipoDomicilio = null) {
        $this->tipoDomicilio = $tipoDomicilio;

        return $this;
    }

    /**
     * Get tipoDomicilio
     *
     * @return \BigD\PersonasBundle\Entity\TipoDomicilio 
     */
    public function getTipoDomicilio() {
        return $this->tipoDomicilio;
    }

    /**
     * Set fuenteDatos
     *
     * @param \BigD\PersonasBundle\Entity\FuenteDatos $fuenteDatos
     * @return Domicilio
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
     * Set persona
     *
     * @param \BigD\PersonasBundle\Entity\Persona $persona
     * @return Domicilio
     */
    public function setPersona(\BigD\PersonasBundle\Entity\Persona $persona = null) {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \BigD\PersonasBundle\Entity\Persona 
     */
    public function getPersona() {
        return $this->persona;
    }

    /**
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return Domicilio
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
     * @return Domicilio
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
