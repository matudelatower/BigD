<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaniaEncuestaRespuestas
 *
 * @ORM\Table(name="campania_encuesta_respuestas")
 * @ORM\Entity
 */
class CampaniaEncuestaRespuestas
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
     * @ORM\Column(name="textoRespuesta", type="string", length=255)
     */
    private $textoRespuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;
    
    /** @ORM\ManyToOne(targetEntity="CampaniaEncuestaPreguntas")
     *  @ORM\JoinColumn(name="campania_encuesta_preguntas_id", referencedColumnName="id")
     */
    private $campaniaEncuestaPreguntas;

    /** @ORM\OneToOne(targetEntity="CampaniaEncuestaOpciones")
     *  @ORM\JoinColumn(name="campania_encuesta_opciones_id", referencedColumnName="id")
     */
    private $campaniaEncuestaOpciones;
    
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
     * @return CampaniaEncuestaRespuestas
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
     * Set slug
     *
     * @param string $slug
     * @return CampaniaEncuestaRespuestas
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
