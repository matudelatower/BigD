<?php

namespace BigD\PersonasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(                    
                    'attr' => array(
                        'placeholder' => 'nombre',                        
                    )
                ))
                ->add('otroNombre')
                ->add('apellido')
                ->add('otroApellido')
                ->add('calle')
                ->add('altura')
                ->add('coordenada')
                ->add('pais', 'entity', array(
                    'class'=>'UbicacionBundle:Pais',                    
                    'mapped' => false
                ))
                ->add('localidad')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\PersonasBundle\Entity\Persona'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_personasbundle_persona';
    }

}
