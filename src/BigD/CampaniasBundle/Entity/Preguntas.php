<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CampaniaEncuentaPreguntas
 *
 * @ORM\Table(name="campania_encuesta_preguntas")
 * @ORM\Entity
 */
class Preguntas {

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
     * @ORM\Column(name="texto_pregunta", type="string", length=255)
     */
    private $textoPregunta;

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

    /** @ORM\ManyToOne(targetEntity="AgrupadorPregunta", inversedBy="preguntas")
     *  @ORM\JoinColumn(name="campania_encuesta_agrupador_pregunta_id", referencedColumnName="id")
     */
    private $agrupadorPregunta;

    /** @ORM\ManyToOne(targetEntity="TipoPregunta")
     *  @ORM\JoinColumn(name="campania_encuesta_tipo_pregunta_id", referencedColumnName="id", nullable=false)
     */
    private $tipoPregunta;

    /**
     * 
     * @var boolean
     * 
     * @ORM\Column(name="requerido", type="boolean", nullable=true)
     */
    private $requerido;

    /**
     * @ORM\OneToMany(targetEntity="OpcionesRespuesta", mappedBy="preguntas",cascade={"persist"})
     * 
     */
    private $opcionRespuesta;

    /**
     * Constructor
     */
    public function __construct() {
        $this->opcionRespuesta = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set textoPregunta
     *
     * @param string $textoPregunta
     * @return Preguntas
     */
    public function setTextoPregunta($textoPregunta) {
        $this->textoPregunta = $textoPregunta;

        return $this;
    }

    /**
     * Get textoPregunta
     *
     * @return string 
     */
    public function getTextoPregunta() {
        return $this->textoPregunta;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return Preguntas
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
     * @return Preguntas
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
     * Set requerido
     *
     * @param boolean $requerido
     * @return Preguntas
     */
    public function setRequerido($requerido) {
        $this->requerido = $requerido;

        return $this;
    }

    /**
     * Get requerido
     *
     * @return boolean 
     */
    public function getRequerido() {
        return $this->requerido;
    }

    /**
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return Preguntas
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
     * @return Preguntas
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
     * Set agrupadorPregunta
     *
     * @param \BigD\CampaniasBundle\Entity\AgrupadorPregunta $agrupadorPregunta
     * @return Preguntas
     */
    public function setAgrupadorPregunta(\BigD\CampaniasBundle\Entity\AgrupadorPregunta $agrupadorPregunta = null) {
        $this->agrupadorPregunta = $agrupadorPregunta;

        return $this;
    }

    /**
     * Get agrupadorPregunta
     *
     * @return \BigD\CampaniasBundle\Entity\AgrupadorPregunta 
     */
    public function getAgrupadorPregunta() {
        return $this->agrupadorPregunta;
    }

    /**
     * Set tipoPregunta
     *
     * @param \BigD\CampaniasBundle\Entity\TipoPregunta $tipoPregunta
     * @return Preguntas
     */
    public function setTipoPregunta(\BigD\CampaniasBundle\Entity\TipoPregunta $tipoPregunta = null) {
        $this->tipoPregunta = $tipoPregunta;

        return $this;
    }

    /**
     * Get tipoPregunta
     *
     * @return \BigD\CampaniasBundle\Entity\TipoPregunta 
     */
    public function getTipoPregunta() {
        return $this->tipoPregunta;
    }

    /**
     * Add opcionRespuesta
     *
     * @param \BigD\CampaniasBundle\Entity\OpcionesRespuesta $opcionRespuesta
     * @return Preguntas
     */
    public function addOpcionRespuestum(\BigD\CampaniasBundle\Entity\OpcionesRespuesta $opcionRespuesta) {
        $this->opcionRespuesta[] = $opcionRespuesta;

        return $this;
    }

    /**
     * Remove opcionRespuesta
     *
     * @param \BigD\CampaniasBundle\Entity\OpcionesRespuesta $opcionRespuesta
     */
    public function removeOpcionRespuestum(\BigD\CampaniasBundle\Entity\OpcionesRespuesta $opcionRespuesta) {
        $this->opcionRespuesta->removeElement($opcionRespuesta);
    }

    /**
     * Get opcionRespuesta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOpcionRespuesta() {
        return $this->opcionRespuesta;
    }

}
