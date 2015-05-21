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
class CampaniaEncuestaPreguntas
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

    /** @ORM\ManyToOne(targetEntity="CampaniaEncuestaAgrupadorPregunta")
     *  @ORM\JoinColumn(name="campania_encuesta_agrupador_pregunta_id", referencedColumnName="id")
     */
    private $campaniaEncuestaAgrupadorPregunta;
    
    /** @ORM\ManyToOne(targetEntity="CampaniaEncuestaTipoPregunta")
     *  @ORM\JoinColumn(name="campania_encuesta_tipo_pregunta_id", referencedColumnName="id")
     */
    private $campaniaEncuestaTipoPregunta;
    
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
     * Set textoPregunta
     *
     * @param string $textoPregunta
     * @return CampaniaEncuentaPreguntas
     */
    public function setTextoPregunta($textoPregunta)
    {
        $this->textoPregunta = $textoPregunta;

        return $this;
    }

    /**
     * Get textoPregunta
     *
     * @return string 
     */
    public function getTextoPregunta()
    {
        return $this->textoPregunta;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return CampaniaEncuentaPreguntas
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
     * @return CampaniaEncuentaPreguntas
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
     * @return CampaniaEncuentaPreguntas
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
     * @return CampaniaEncuentaPreguntas
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
     * Set campaniaEncuestaAgrupadorPregunta
     *
     * @param \BigD\CampaniasBundle\Entity\CampaniaEncuestaAgrupadorPregunta $campaniaEncuestaAgrupadorPregunta
     * @return CampaniaEncuentaPreguntas
     */
    public function setCampaniaEncuestaAgrupadorPregunta(\BigD\CampaniasBundle\Entity\CampaniaEncuestaAgrupadorPregunta $campaniaEncuestaAgrupadorPregunta = null)
    {
        $this->campaniaEncuestaAgrupadorPregunta = $campaniaEncuestaAgrupadorPregunta;

        return $this;
    }

    /**
     * Get campaniaEncuestaAgrupadorPregunta
     *
     * @return \BigD\CampaniasBundle\Entity\CampaniaEncuestaAgrupadorPregunta 
     */
    public function getCampaniaEncuestaAgrupadorPregunta()
    {
        return $this->campaniaEncuestaAgrupadorPregunta;
    }

    /**
     * Set campaniaEncuestaTipoPregunta
     *
     * @param \BigD\CampaniasBundle\Entity\CampaniaEncuestaTipoPregunta $campaniaEncuestaTipoPregunta
     * @return CampaniaEncuentaPreguntas
     */
    public function setCampaniaEncuestaTipoPregunta(\BigD\CampaniasBundle\Entity\CampaniaEncuestaTipoPregunta $campaniaEncuestaTipoPregunta = null)
    {
        $this->campaniaEncuestaTipoPregunta = $campaniaEncuestaTipoPregunta;

        return $this;
    }

    /**
     * Get campaniaEncuestaTipoPregunta
     *
     * @return \BigD\CampaniasBundle\Entity\CampaniaEncuestaTipoPregunta 
     */
    public function getCampaniaEncuestaTipoPregunta()
    {
        return $this->campaniaEncuestaTipoPregunta;
    }
}
