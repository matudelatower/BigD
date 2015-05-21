<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaniaEncuentaPreguntas
 *
 * @ORM\Table(name="campania_encuesta_preguntas")
 * @ORM\Entity
 */
class CampaniaEncuentaPreguntas
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
     * @ORM\Column(name="textoPregunta", type="string", length=255)
     */
    private $textoPregunta;

    /** @ORM\ManyToOne(targetEntity="CampaniaEncuestaAgrupadorPregunta")
     *  @ORM\JoinColumn(name="campania_encuesta_agrupador_pregunta_id", referencedColumnName="id")
     */
    private $campaniaEncuestaAgrupadorPregunta;
    
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
}
