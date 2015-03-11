<?php

namespace BigD\PersonasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonaFilterType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(
                    'required' => false,
                ))
                ->add('apellido', 'text', array(
                    'required' => false,
                ))
                ->add('numeroDocumento', 'text', array(
                    'required' => false,
                ))
                ->add('sexo', 'choice', array(
                    'empty_value' => 'Todos',
                    'choices' => array(
                        'M' => 'Masculino',
                        'F' => 'Femenino'
                    ),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => false,
                ))
                ->add('personaConDomicilioPrincipal', 'choice', array(
                    'empty_value' => 'Todos',
                    'choices' => array(
                        'S' => 'SI',
                        'N' => 'NO'
                    ),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => false,
                ))
        ;


        
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_personasbundle_persona_filter_type';
    }

}
