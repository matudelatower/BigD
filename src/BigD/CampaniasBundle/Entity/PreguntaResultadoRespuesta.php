<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PreguntaResultadoRespuesta
 *
 * @ORM\Table(name="campania_encuesta_pregunta_resultado_respuesta")
 * @ORM\Entity(repositoryClass="PreguntaResultadoRespuestaRepository")
 */
class PreguntaResultadoRespuesta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Preguntas", inversedBy="preguntaResultadoRespuesta")
     *  @ORM\JoinColumn(name="campania_encuesta_pregunta_id", referencedColumnName="id", nullable=false)
     */
    private $preguntas;

    /** @ORM\ManyToOne(targetEntity="ResultadoRespuesta", inversedBy="preguntaResultadoRespuesta")
     *  @ORM\JoinColumn(name="campania_encuesta_resultado_respuesta_id", referencedColumnName="id", nullable=false)
     */
    private $resultadoRespuesta;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return PreguntaResultadoRespuesta
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
     * @return PreguntaResultadoRespuesta
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
     * Set preguntas
     *
     * @param \BigD\CampaniasBundle\Entity\Preguntas $preguntas
     * @return PreguntaResultadoRespuesta
     */
    public function setPreguntas(\BigD\CampaniasBundle\Entity\Preguntas $preguntas)
    {
        $this->preguntas = $preguntas;

        return $this;
    }

    /**
     * Get preguntas
     *
     * @return \BigD\CampaniasBundle\Entity\Preguntas 
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }

    /**
     * Set resultadoRespuesta
     *
     * @param \BigD\CampaniasBundle\Entity\ResultadoRespuesta $resultadoRespuesta
     * @return PreguntaResultadoRespuesta
     */
    public function setResultadoRespuesta(\BigD\CampaniasBundle\Entity\ResultadoRespuesta $resultadoRespuesta)
    {
        $this->resultadoRespuesta = $resultadoRespuesta;

        return $this;
    }

    /**
     * Get resultadoRespuesta
     *
     * @return \BigD\CampaniasBundle\Entity\ResultadoRespuesta 
     */
    public function getResultadoRespuesta()
    {
        return $this->resultadoRespuesta;
    }

    /**
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return PreguntaResultadoRespuesta
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
     * @return PreguntaResultadoRespuesta
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
