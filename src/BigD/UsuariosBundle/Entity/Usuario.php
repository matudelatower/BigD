<?php

namespace BigD\UsuariosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UsuarioRepository")
 * @ORM\Table(name="fos_user")
 */
class Usuario extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct() {
        parent::__construct();
        // your own logic
    }
    
    /**
     * @ORM\OneToMany(targetEntity="PerfilUsuario", mappedBy="usuario",cascade={"persist"})
     * 
     */
    private $perfiles;

   
    /**
     * Add perfiles
     *
     * @param \BigD\UsuariosBundle\Entity\PerfilUsuario $perfiles
     * @return Usuario
     */
    public function addPerfile(\BigD\UsuariosBundle\Entity\PerfilUsuario $perfiles)
    {
        $this->perfiles[] = $perfiles;

        return $this;
    }

    /**
     * Remove perfiles
     *
     * @param \BigD\UsuariosBundle\Entity\PerfilUsuario $perfiles
     */
    public function removePerfile(\BigD\UsuariosBundle\Entity\PerfilUsuario $perfiles)
    {
        $this->perfiles->removeElement($perfiles);
    }

    /**
     * Get perfiles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPerfiles()
    {
        return $this->perfiles;
    }
}
