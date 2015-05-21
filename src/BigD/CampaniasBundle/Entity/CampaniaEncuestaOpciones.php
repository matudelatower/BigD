<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaniaEncuestaOpciones
 *
 * @ORM\Table(name="campania_encuesta_opciones")
 * @ORM\Entity
 */
class CampaniaEncuestaOpciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="CampaniaEncuestaOpcionesRespuesta")
     *  @ORM\JoinColumn(name="campania_encuesta_opciones_respuesta_id", referencedColumnName="id")
     */
    private $campaniaEncuestaOpcionesRespuesta;
    
    /** @ORM\ManyToOne(targetEntity="CampaniaEncuestaPreguntas")
     *  @ORM\JoinColumn(name="campania_encuesta_preguntas_id", referencedColumnName="id")
     */
    private $campaniaEncuestaPreguntas;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
