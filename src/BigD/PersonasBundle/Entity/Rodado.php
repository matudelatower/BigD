<?php

namespace BigD\PersonasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Rodado
 *
 * @ORM\Table(name="rodados")
 * @ORM\Entity
 */
class Rodado {

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
     * @ORM\Column(name="dominio", type="string", length=255)
     */
    private $dominio;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=255, nullable=true)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="anio_modelo", type="string", length=255, nullable=true)
     */
    private $anioModelo;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", scale=2, nullable=true)
     */
    private $precio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_baja", type="datetime", nullable=true)
     */
    private $fechaBaja;

    /** @ORM\ManyToOne(targetEntity="FuenteDatos")
     *  @ORM\JoinColumn(name="fuente_datos_id", referencedColumnName="id")
     */
    private $fuenteDatos;

    /** @ORM\ManyToOne(targetEntity="TipoRodado")
     *  @ORM\JoinColumn(name="tipo_rodado_id", referencedColumnName="id")
     */
    private $tipoRodado;

    /** @ORM\ManyToOne(targetEntity="Persona", inversedBy="rodado")
     *  @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     */
    private $persona;

    /** @ORM\ManyToOne(targetEntity="MarcaRodado")
     *  @ORM\JoinColumn(name="marca_rodado_id", referencedColumnName="id", nullable=true)
     */
    private $marcaRodado;

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
     * Set dominio
     *
     * @param string $dominio
     * @return Rodado
     */
    public function setDominio($dominio) {
        $this->dominio = $dominio;

        return $this;
    }

    /**
     * Get dominio
     *
     * @return string 
     */
    public function getDominio() {
        return $this->dominio;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Rodado
     */
    public function setModelo($modelo) {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo() {
        return $this->modelo;
    }

    /**
     * Set anioModelo
     *
     * @param string $anioModelo
     * @return Rodado
     */
    public function setAnioModelo($anioModelo) {
        $this->anioModelo = $anioModelo;

        return $this;
    }

    /**
     * Get anioModelo
     *
     * @return string 
     */
    public function getAnioModelo() {
        return $this->anioModelo;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return Rodado
     */
    public function setPrecio($precio) {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio() {
        return $this->precio;
    }

    /**
     * Set fechaBaja
     *
     * @param \DateTime $fechaBaja
     * @return Rodado
     */
    public function setFechaBaja($fechaBaja) {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get fechaBaja
     *
     * @return \DateTime 
     */
    public function getFechaBaja() {
        return $this->fechaBaja;
    }


    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return Rodado
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;

        return $this;
    }

    /**
     * Get creado
     *
     * @return \DateTime 
     */
    public function getCreado()
    {
        return $this->creado;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     * @return Rodado
     */
    public function setActualizado($actualizado)
    {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * Get actualizado
     *
     * @return \DateTime 
     */
    public function getActualizado()
    {
        return $this->actualizado;
    }

    /**
     * Set fuenteDatos
     *
     * @param \BigD\PersonasBundle\Entity\FuenteDatos $fuenteDatos
     * @return Rodado
     */
    public function setFuenteDatos(\BigD\PersonasBundle\Entity\FuenteDatos $fuenteDatos = null)
    {
        $this->fuenteDatos = $fuenteDatos;

        return $this;
    }

    /**
     * Get fuenteDatos
     *
     * @return \BigD\PersonasBundle\Entity\FuenteDatos 
     */
    public function getFuenteDatos()
    {
        return $this->fuenteDatos;
    }

    /**
     * Set tipoRodado
     *
     * @param \BigD\PersonasBundle\Entity\TipoRodado $tipoRodado
     * @return Rodado
     */
    public function setTipoRodado(\BigD\PersonasBundle\Entity\TipoRodado $tipoRodado = null)
    {
        $this->tipoRodado = $tipoRodado;

        return $this;
    }

    /**
     * Get tipoRodado
     *
     * @return \BigD\PersonasBundle\Entity\TipoRodado 
     */
    public function getTipoRodado()
    {
        return $this->tipoRodado;
    }

    /**
     * Set persona
     *
     * @param \BigD\PersonasBundle\Entity\Persona $persona
     * @return Rodado
     */
    public function setPersona(\BigD\PersonasBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \BigD\PersonasBundle\Entity\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Set marcaRodado
     *
     * @param \BigD\PersonasBundle\Entity\MarcaRodado $marcaRodado
     * @return Rodado
     */
    public function setMarcaRodado(\BigD\PersonasBundle\Entity\MarcaRodado $marcaRodado = null)
    {
        $this->marcaRodado = $marcaRodado;

        return $this;
    }

    /**
     * Get marcaRodado
     *
     * @return \BigD\PersonasBundle\Entity\MarcaRodado 
     */
    public function getMarcaRodado()
    {
        return $this->marcaRodado;
    }

    /**
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return Rodado
     */
    public function setCreadoPor(\BigD\UsuariosBundle\Entity\Usuario $creadoPor = null)
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    /**
     * Get creadoPor
     *
     * @return \BigD\UsuariosBundle\Entity\Usuario 
     */
    public function getCreadoPor()
    {
        return $this->creadoPor;
    }

    /**
     * Set actualizadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $actualizadoPor
     * @return Rodado
     */
    public function setActualizadoPor(\BigD\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Get actualizadoPor
     *
     * @return \BigD\UsuariosBundle\Entity\Usuario 
     */
    public function getActualizadoPor()
    {
        return $this->actualizadoPor;
    }
}
