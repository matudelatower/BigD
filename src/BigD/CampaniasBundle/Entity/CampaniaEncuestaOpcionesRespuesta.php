<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaniaEncuestaOpcionesRespuesta
 *
 * @ORM\Table(name="campania_encuesta_opciones_respuesta")
 * @ORM\Entity
 */
class CampaniaEncuestaOpcionesRespuesta
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
     * @var boolean
     *
     * @ORM\Column(name="obligatorio", type="boolean")
     */
    private $obligatorio;

    /**
     * @var string
     *
     * @ORM\Column(name="textoOpcion", type="string", length=255)
     */
    private $textoOpcion;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;


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
     * Set obligatorio
     *
     * @param boolean $obligatorio
     * @return CampaniaEncuestaOpcionesRespuesta
     */
    public function setObligatorio($obligatorio)
    {
        $this->obligatorio = $obligatorio;

        return $this;
    }

    /**
     * Get obligatorio
     *
     * @return boolean 
     */
    public function getObligatorio()
    {
        return $this->obligatorio;
    }

    /**
     * Set textoOpcion
     *
     * @param string $textoOpcion
     * @return CampaniaEncuestaOpcionesRespuesta
     */
    public function setTextoOpcion($textoOpcion)
    {
        $this->textoOpcion = $textoOpcion;

        return $this;
    }

    /**
     * Get textoOpcion
     *
     * @return string 
     */
    public function getTextoOpcion()
    {
        return $this->textoOpcion;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return CampaniaEncuestaOpcionesRespuesta
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
