<?php

namespace BigD\CampaniasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreguntasType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('textoPregunta')
//                ->add('agrupadorPregunta')
                ->add('tipoPregunta')
                ->add('requerido')
                ->add('opcionRespuesta', 'bootstrapcollection', array(
                    'type' => new OpcionesRespuestaType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\CampaniasBundle\Entity\Preguntas'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_campaniasbundle_preguntas';
    }

}
