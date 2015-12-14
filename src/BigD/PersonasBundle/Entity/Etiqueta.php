<?php

namespace BigD\PersonasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Etiqueta
 *
 * @ORM\Table(name="etiquetas")
 * @ORM\Entity
 * @UniqueEntity("nombre")
 */
class Etiqueta {

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
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

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
     * @ORM\OneToMany(targetEntity="PersonaEtiqueta", mappedBy="etiqueta", cascade={"persist"})
     */
    private $personaEtiquetas;

    /**
     * Constructor
     */
    public function __construct() {
        $this->personaEtiquetas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Etiqueta
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
     * Set color
     *
     * @param string $color
     * @return Etiqueta
     */
    public function setColor($color) {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return Etiqueta
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
     * @return Etiqueta
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
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return Etiqueta
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
     * @return Etiqueta
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
     * Add personaEtiquetas
     *
     * @param \BigD\PersonasBundle\Entity\personaEtiqueta $personaEtiquetas
     * @return Etiqueta
     */
    public function addPersonaEtiqueta(\BigD\PersonasBundle\Entity\personaEtiqueta $personaEtiquetas) {
        $personaEtiquetas->setEtiqueta($this);
        $this->personaEtiquetas[] = $personaEtiquetas;

        return $this;
    }

    /**
     * Remove personaEtiquetas
     *
     * @param \BigD\PersonasBundle\Entity\personaEtiqueta $personaEtiquetas
     */
    public function removePersonaEtiqueta(\BigD\PersonasBundle\Entity\personaEtiqueta $personaEtiquetas) {
        $this->personaEtiquetas->removeElement($personaEtiquetas);
    }

    /**
     * Get personaEtiquetas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonaEtiquetas() {
        return $this->personaEtiquetas;
    }

    public function __toString() {
        return $this->nombre;
    }

}
