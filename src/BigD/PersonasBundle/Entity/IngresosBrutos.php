<?php

namespace BigD\PersonasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IngresosBrutos
 *
 * @ORM\Table(name="ingresos_brutos")
 * @ORM\Entity
 */
class IngresosBrutos {

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
     * @ORM\Column(name="cuit", type="string", length=255)
     */
    private $cuit;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

    /**
     * @var string
     *
     * @ORM\Column(name="enero", type="string", length=255)
     */
    private $enero;

    /**
     * @var string
     *
     * @ORM\Column(name="febrero", type="string", length=255)
     */
    private $febrero;

    /**
     * @var string
     *
     * @ORM\Column(name="marzo", type="string", length=255)
     */
    private $marzo;

    /**
     * @var string
     *
     * @ORM\Column(name="abril", type="string", length=255)
     */
    private $abril;

    /**
     * @var string
     *
     * @ORM\Column(name="mayo", type="string", length=255)
     */
    private $mayo;

    /**
     * @var string
     *
     * @ORM\Column(name="junio", type="string", length=255)
     */
    private $junio;

    /**
     * @var string
     *
     * @ORM\Column(name="julio", type="string", length=255)
     */
    private $julio;

    /**
     * @var string
     *
     * @ORM\Column(name="agosto", type="string", length=255)
     */
    private $agosto;

    /**
     * @var string
     *
     * @ORM\Column(name="septiembre", type="string", length=255)
     */
    private $septiembre;

    /**
     * @var string
     *
     * @ORM\Column(name="octubre", type="string", length=255)
     */
    private $octubre;

    /**
     * @var string
     *
     * @ORM\Column(name="noviembre", type="string", length=255)
     */
    private $noviembre;

    /**
     * @var string
     *
     * @ORM\Column(name="diciembre", type="string", length=255)
     */
    private $diciembre;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="string", length=255)
     */
    private $total;


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
     * Set cuit
     *
     * @param string $cuit
     * @return IngresosBrutos
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;

        return $this;
    }

    /**
     * Get cuit
     *
     * @return string 
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    /**
     * Set anio
     *
     * @param integer $anio
     * @return IngresosBrutos
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return integer 
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set enero
     *
     * @param string $enero
     * @return IngresosBrutos
     */
    public function setEnero($enero)
    {
        $this->enero = $enero;

        return $this;
    }

    /**
     * Get enero
     *
     * @return string 
     */
    public function getEnero()
    {
        return $this->enero;
    }

    /**
     * Set febrero
     *
     * @param string $febrero
     * @return IngresosBrutos
     */
    public function setFebrero($febrero)
    {
        $this->febrero = $febrero;

        return $this;
    }

    /**
     * Get febrero
     *
     * @return string 
     */
    public function getFebrero()
    {
        return $this->febrero;
    }

    /**
     * Set marzo
     *
     * @param string $marzo
     * @return IngresosBrutos
     */
    public function setMarzo($marzo)
    {
        $this->marzo = $marzo;

        return $this;
    }

    /**
     * Get marzo
     *
     * @return string 
     */
    public function getMarzo()
    {
        return $this->marzo;
    }

    /**
     * Set abril
     *
     * @param string $abril
     * @return IngresosBrutos
     */
    public function setAbril($abril)
    {
        $this->abril = $abril;

        return $this;
    }

    /**
     * Get abril
     *
     * @return string 
     */
    public function getAbril()
    {
        return $this->abril;
    }

    /**
     * Set mayo
     *
     * @param string $mayo
     * @return IngresosBrutos
     */
    public function setMayo($mayo)
    {
        $this->mayo = $mayo;

        return $this;
    }

    /**
     * Get mayo
     *
     * @return string 
     */
    public function getMayo()
    {
        return $this->mayo;
    }

    /**
     * Set junio
     *
     * @param string $junio
     * @return IngresosBrutos
     */
    public function setJunio($junio)
    {
        $this->junio = $junio;

        return $this;
    }

    /**
     * Get junio
     *
     * @return string 
     */
    public function getJunio()
    {
        return $this->junio;
    }

    /**
     * Set julio
     *
     * @param string $julio
     * @return IngresosBrutos
     */
    public function setJulio($julio)
    {
        $this->julio = $julio;

        return $this;
    }

    /**
     * Get julio
     *
     * @return string 
     */
    public function getJulio()
    {
        return $this->julio;
    }

    /**
     * Set agosto
     *
     * @param string $agosto
     * @return IngresosBrutos
     */
    public function setAgosto($agosto)
    {
        $this->agosto = $agosto;

        return $this;
    }

    /**
     * Get agosto
     *
     * @return string 
     */
    public function getAgosto()
    {
        return $this->agosto;
    }

    /**
     * Set septiembre
     *
     * @param string $septiembre
     * @return IngresosBrutos
     */
    public function setSeptiembre($septiembre)
    {
        $this->septiembre = $septiembre;

        return $this;
    }

    /**
     * Get septiembre
     *
     * @return string 
     */
    public function getSeptiembre()
    {
        return $this->septiembre;
    }

    /**
     * Set octubre
     *
     * @param string $octubre
     * @return IngresosBrutos
     */
    public function setOctubre($octubre)
    {
        $this->octubre = $octubre;

        return $this;
    }

    /**
     * Get octubre
     *
     * @return string 
     */
    public function getOctubre()
    {
        return $this->octubre;
    }

    /**
     * Set noviembre
     *
     * @param string $noviembre
     * @return IngresosBrutos
     */
    public function setNoviembre($noviembre)
    {
        $this->noviembre = $noviembre;

        return $this;
    }

    /**
     * Get noviembre
     *
     * @return string 
     */
    public function getNoviembre()
    {
        return $this->noviembre;
    }

    /**
     * Set diciembre
     *
     * @param string $diciembre
     * @return IngresosBrutos
     */
    public function setDiciembre($diciembre)
    {
        $this->diciembre = $diciembre;

        return $this;
    }

    /**
     * Get diciembre
     *
     * @return string 
     */
    public function getDiciembre()
    {
        return $this->diciembre;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return IngresosBrutos
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }
}
