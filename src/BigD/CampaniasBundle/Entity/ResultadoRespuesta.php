<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ResultadoRespuesta
 *
 * @ORM\Table(name="campania_encuesta_resultado_respuesta")
 * @ORM\Entity(repositoryClass="ResultadoRespuestaRepository")
 */
class ResultadoRespuesta
{
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
     * @ORM\Column(name="texto_respuesta", type="text")
     */
    private $textoRespuesta;

    /** @ORM\ManyToOne(targetEntity="OpcionesRespuesta")
     * @ORM\JoinColumn(name="campania_encuesta_opcion_respuesta_id", referencedColumnName="id", nullable=true)
     */
    private $opcionesRespuesta;

    /** @ORM\ManyToOne(targetEntity="ResultadoCabecera",cascade={"persist"})
     * @ORM\JoinColumn(name="campania_encuesta_resultado_cabecera_id", referencedColumnName="id", nullable=false)
     */
    private $resultadoCabecera;
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
     * @ORM\OneToMany(targetEntity="PreguntaResultadoRespuesta", mappedBy="resultadoRespuesta",cascade={"remove", "persist"})
     *
     */
    private $preguntaResultadoRespuesta;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->preguntaResultadoRespuesta = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set textoRespuesta
     *
     * @param string $textoRespuesta
     * @return ResultadoRespuesta
     */
    public function setTextoRespuesta($textoRespuesta)
    {
        $this->textoRespuesta = $textoRespuesta;

        return $this;
    }

    /**
     * Get textoRespuesta
     *
     * @return string 
     */
    public function getTextoRespuesta()
    {
        return $this->textoRespuesta;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return ResultadoRespuesta
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
     * @return ResultadoRespuesta
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
     * Set opcionesRespuesta
     *
     * @param \BigD\CampaniasBundle\Entity\OpcionesRespuesta $opcionesRespuesta
     * @return ResultadoRespuesta
     */
    public function setOpcionesRespuesta(\BigD\CampaniasBundle\Entity\OpcionesRespuesta $opcionesRespuesta = null)
    {
        $this->opcionesRespuesta = $opcionesRespuesta;

        return $this;
    }

    /**
     * Get opcionesRespuesta
     *
     * @return \BigD\CampaniasBundle\Entity\OpcionesRespuesta 
     */
    public function getOpcionesRespuesta()
    {
        return $this->opcionesRespuesta;
    }

    /**
     * Set resultadoCabecera
     *
     * @param \BigD\CampaniasBundle\Entity\ResultadoCabecera $resultadoCabecera
     * @return ResultadoRespuesta
     */
    public function setResultadoCabecera(\BigD\CampaniasBundle\Entity\ResultadoCabecera $resultadoCabecera)
    {
        $this->resultadoCabecera = $resultadoCabecera;

        return $this;
    }

    /**
     * Get resultadoCabecera
     *
     * @return \BigD\CampaniasBundle\Entity\ResultadoCabecera 
     */
    public function getResultadoCabecera()
    {
        return $this->resultadoCabecera;
    }

    /**
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return ResultadoRespuesta
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
     * @return ResultadoRespuesta
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

    /**
     * Add preguntaResultadoRespuesta
     *
     * @param \BigD\CampaniasBundle\Entity\PreguntaResultadoRespuesta $preguntaResultadoRespuesta
     * @return ResultadoRespuesta
     */
    public function addPreguntaResultadoRespuestum(\BigD\CampaniasBundle\Entity\PreguntaResultadoRespuesta $preguntaResultadoRespuesta)
    {
        $this->preguntaResultadoRespuesta[] = $preguntaResultadoRespuesta;

        return $this;
    }

    /**
     * Remove preguntaResultadoRespuesta
     *
     * @param \BigD\CampaniasBundle\Entity\PreguntaResultadoRespuesta $preguntaResultadoRespuesta
     */
    public function removePreguntaResultadoRespuestum(\BigD\CampaniasBundle\Entity\PreguntaResultadoRespuesta $preguntaResultadoRespuesta)
    {
        $this->preguntaResultadoRespuesta->removeElement($preguntaResultadoRespuesta);
    }

    /**
     * Get preguntaResultadoRespuesta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntaResultadoRespuesta()
    {
        return $this->preguntaResultadoRespuesta;
    }
}
