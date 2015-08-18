<?php

namespace BigD\CampaniasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncuestaFilterType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

                ->add('nombre','text',array(
                    'required'=>false,
                ))
                ->add('descripcion','text',array(
                    'required'=>false,
                ))
                ->add('slug','text',array(
                    'required'=>false,
                ))
            ->add('fechaDesde', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array(
                    'class' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyy'
                ),
                'required'=>false

            ))
            ->add('fechaHasta', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array(
                    'class' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyy'
                ),
                'required'=>false

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
        return 'bigd_campaniasbundle_campaniaencuesta_filter_type';
    }

}
