<?php

namespace BigD\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PerfilType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('descripcion')
                ->add('permisos', 'bootstrapcollection', array(
                    'type' => new PermisoPerfilType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true,
                        )
                )


        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\UsuariosBundle\Entity\Perfil'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_usuariosbundle_perfil';
    }

}
