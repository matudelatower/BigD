<?php

namespace BigD\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PermisoPerfilType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('permiso', 'entity', array(
                    'class' => 'UsuariosBundle:Permiso',
                    'property' => 'nombre',
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\UsuariosBundle\Entity\PermisoPerfil'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_usuariosbundle_permisoperfil';
    }

}
