<?php

namespace BigD\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('enabled')
                ->add('perfiles', 'bootstrapcollection', array(
                    'type' => new PerfilUsuarioType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true,
                        )
                )
//                ->add('roles', 'choice', array(
//                    'choices' => array(
//                        'ROLE_CLIENT' => 'CLIENT',
//                        'ROLE_EMPLOYEE' => 'EMPLOYEE',
//                        'ROLE_ADMIN' => 'ADMIN',
//                        'ROLE_SUPER_ADMIN' => 'SUPER ADMIN',
//                    ),
//                    'label' => 'Roles',
//                    'expanded' => true,
//                    'multiple' => true, //                
//                ))

        ;
    }

    public function getParent() {
        return 'fos_user_registration';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\UsuariosBundle\Entity\Usuario',
            'translation_domain' => 'FOSUserBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_usuariosbundle_usuario';
    }

}
