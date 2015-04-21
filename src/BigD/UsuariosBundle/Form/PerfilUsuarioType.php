<?php

namespace BigD\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PerfilUsuarioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//            ->add('activo')
//            ->add('creado')
//            ->add('actualizado')
//            ->add('usuario')
                ->add('perfil', 'entity', array(
                    'class' => 'UsuariosBundle:Perfil',
                    'property' => 'nombre',
                ))
//            ->add('creadoPor')
//            ->add('actualizadoPor')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\UsuariosBundle\Entity\PerfilUsuario'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_usuariosbundle_perfilusuario';
    }

}
