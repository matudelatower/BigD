<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ResultadoCabecera
 *
 * @ORM\Table(name="campania_encuesta_resultado_cabecera")
 * @ORM\Entity(repositoryClass="BigD\CampaniasBundle\Entity\ResultadoCabeceraRepository")
 */
class ResultadoCabecera
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
     * @var integer
     *
     * @ORM\Column(name="idExterna", type="integer")
     */
    private $idExterna;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="infoExterna", type="string", length=255)
     */
    private $infoExterna;

    /**
     * @var string
     *
     * @ORM\Column(name="nroCuestionario", type="string", length=255)
     */
    private $nroCuestionario;

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


    public function __toString()
    {
        return $this->nroCuestionario;
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
     * Set idExterna
     *
     * @param integer $idExterna
     * @return ResultadoCabecera
     */
    public function setIdExterna($idExterna)
    {
        $this->idExterna = $idExterna;

        return $this;
    }

    /**
     * Get idExterna
     *
     * @return integer 
     */
    public function getIdExterna()
    {
        return $this->idExterna;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return ResultadoCabecera
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set infoExterna
     *
     * @param string $infoExterna
     * @return ResultadoCabecera
     */
    public function setInfoExterna($infoExterna)
    {
        $this->infoExterna = $infoExterna;

        return $this;
    }

    /**
     * Get infoExterna
     *
     * @return string 
     */
    public function getInfoExterna()
    {
        return $this->infoExterna;
    }

    /**
     * Set nroCuestionario
     *
     * @param string $nroCuestionario
     * @return ResultadoCabecera
     */
    public function setNroCuestionario($nroCuestionario)
    {
        $this->nroCuestionario = $nroCuestionario;

        return $this;
    }

    /**
     * Get nroCuestionario
     *
     * @return string 
     */
    public function getNroCuestionario()
    {
        return $this->nroCuestionario;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return ResultadoCabecera
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
     * @return ResultadoCabecera
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
     * Set creadoPor
     *
     * @param \BigD\UsuariosBundle\Entity\Usuario $creadoPor
     * @return ResultadoCabecera
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
     * @return ResultadoCabecera
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
