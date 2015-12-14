<?php

namespace BigD\PersonasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Persona
 *
 * @ORM\Table(name="personas")
 * @ORM\Entity(repositoryClass="BigD\PersonasBundle\Entity\PersonaRepository")
 */
class Persona {

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
     * @ORM\Column(name="apellido", type="string", length=255, nullable=true)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_documento", type="string", length=255, nullable=true)
     */
    private $numeroDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="cuit_cuil", type="string", length=255, nullable=true)
     */
    private $cuitCuil;

    /**
     * @var datetime $fechaNacimiento
     *     
     * @ORM\Column(name="fecha_nacimiento", type="datetime", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=255, nullable=true)
     */
    private $sexo;

    /** @ORM\ManyToOne(targetEntity="TipoDocumento")
     *  @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id")
     */
    private $tipoDocumento;

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
     * @ORM\OneToMany(targetEntity="Domicilio", mappedBy="persona")
     */
    private $domicilio;

    /**
     * @ORM\OneToMany(targetEntity="Rodado", mappedBy="persona")
     */
    private $rodado;

    /**
     * @ORM\OneToMany(targetEntity="PersonaEtiqueta", mappedBy="persona", cascade={"persist"})
     */
    private $etiquetas;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Persona
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Persona
     */
    public function setApellido($apellido) {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido() {
        return $this->apellido;
    }

    /**
     * Set numeroDocumento
     *
     * @param string $numeroDocumento
     * @return Persona
     */
    public function setNumeroDocumento($numeroDocumento) {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * Get numeroDocumento
     *
     * @return string 
     */
    public function getNumeroDocumento() {
        return $this->numeroDocumento;
    }

    /**
     * Set cuitCuil
     *
     * @param string $cuitCuil
     * @return Persona
     */
    public function setCuitCuil($cuitCuil) {
        $this->cuitCuil = $cuitCuil;

        return $this;
    }

    /**
     * Get cuitCuil
     *
     * @return string 
     */
    public function getCuitCuil() {
        return $this->cuitCuil;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Persona
     */
    public function setSexo($sexo) {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo() {
        return $this->sexo;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return Persona
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
     * @return Persona
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
     * Set tipoDocumento
     *
     * @param \BigD\PersonasBundle\Entity\TipoDocumento $tipoDocumento
     * @return Persona
     */
    public function setTipoDocumento(\BigD\PersonasBundle\Entity\TipoDocumento $tipoDocumento = null) {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return \BigD\PersonasBundle\Entity\TipoDocumento 
     */
    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    /**
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return Persona
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
     * @return Persona
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

    /**
     * Constructor
     */
    public function __construct() {
        $this->domicilio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etiquetas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add domicilio
     *
     * @param \BigD\PersonasBundle\Entity\Domicilio $domicilio
     * @return Persona
     */
    public function addDomicilio(\BigD\PersonasBundle\Entity\Domicilio $domicilio) {
        $this->domicilio[] = $domicilio;

        return $this;
    }

    /**
     * Remove domicilio
     *
     * @param \BigD\PersonasBundle\Entity\Domicilio $domicilio
     */
    public function removeDomicilio(\BigD\PersonasBundle\Entity\Domicilio $domicilio) {
        $this->domicilio->removeElement($domicilio);
    }

    /**
     * Get domicilio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDomicilio() {
        return $this->domicilio;
    }

    /**
     * Add rodado
     *
     * @param \BigD\PersonasBundle\Entity\Rodado $rodado
     * @return Persona
     */
    public function addRodado(\BigD\PersonasBundle\Entity\Rodado $rodado) {
        $this->rodado[] = $rodado;

        return $this;
    }

    /**
     * Remove rodado
     *
     * @param \BigD\PersonasBundle\Entity\Rodado $rodado
     */
    public function removeRodado(\BigD\PersonasBundle\Entity\Rodado $rodado) {
        $this->rodado->removeElement($rodado);
    }

    /**
     * Get rodado
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRodado() {
        return $this->rodado;
    }

    /**
     * Add personaEtiquetas
     *
     * @param \BigD\PersonasBundle\Entity\personaEtiqueta $personaEtiquetas
     * @return Persona
     */
   


    /**
     * Add etiquetas
     *
     * @param \BigD\PersonasBundle\Entity\personaEtiqueta $etiquetas
     * @return Persona
     */
    public function addEtiqueta(\BigD\PersonasBundle\Entity\personaEtiqueta $etiquetas)
    {
        $this->etiquetas[] = $etiquetas;

        return $this;
    }

    /**
     * Remove etiquetas
     *
     * @param \BigD\PersonasBundle\Entity\personaEtiqueta $etiquetas
     */
    public function removeEtiqueta(\BigD\PersonasBundle\Entity\personaEtiqueta $etiquetas)
    {
        $this->etiquetas->removeElement($etiquetas);
    }

    /**
     * Get etiquetas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtiquetas()
    {
        return $this->etiquetas;
    }
}
