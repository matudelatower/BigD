<?php

namespace BigD\CampaniasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgrupadorPreguntaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('descripcion')
                ->add('multiple')
                ->add('slug')
                ->add('preguntas', "collection", array(
                    'type' => new PreguntasType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true,
                    'prototype_name'=>"__pregunta__",
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\CampaniasBundle\Entity\AgrupadorPregunta'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_campaniasbundle_agrupadorpregunta';
    }

}
