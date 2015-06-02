<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * OpcionesRespuesta
 *
 * @ORM\Table(name="campania_encuesta_opciones_respuesta")
 * @ORM\Entity
 */
class OpcionesRespuesta {

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
     * @ORM\Column(name="texto_opcion", type="string", length=255)
     */
    private $textoOpcion;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

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

    /** @ORM\ManyToOne(targetEntity="Preguntas", inversedBy="opcionRespuesta")
     *  @ORM\JoinColumn(name="campania_encuesta_preguntas_id", referencedColumnName="id")
     */
    private $preguntas;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set textoOpcion
     *
     * @param string $textoOpcion
     * @return OpcionesRespuesta
     */
    public function setTextoOpcion($textoOpcion) {
        $this->textoOpcion = $textoOpcion;

        return $this;
    }

    /**
     * Get textoOpcion
     *
     * @return string 
     */
    public function getTextoOpcion() {
        return $this->textoOpcion;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return OpcionesRespuesta
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return OpcionesRespuesta
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
     * @return OpcionesRespuesta
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
     * @return OpcionesRespuesta
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
     * @return OpcionesRespuesta
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
     * Set preguntas
     *
     * @param \BigD\CampaniasBundle\Entity\Preguntas $preguntas
     * @return OpcionesRespuesta
     */
    public function setPreguntas(\BigD\CampaniasBundle\Entity\Preguntas $preguntas = null) {
        $this->preguntas = $preguntas;

        return $this;
    }

    /**
     * Get preguntas
     *
     * @return \BigD\CampaniasBundle\Entity\Preguntas 
     */
    public function getPreguntas() {
        return $this->preguntas;
    }

}
