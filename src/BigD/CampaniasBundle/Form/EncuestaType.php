<?php

namespace BigD\CampaniasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncuestaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('campania', 'jqueryautocomplete', array(
                    'class' => 'CampaniasBundle:Campania',
                    'property' => 'nombre',
                    'search_method' => 'getByLike',
                    'required' => true
                ))
                ->add('nombre')
                ->add('descripcion')
                ->add('slug')
                ->add('agrupador', 'collection', array(
                    'type' => new AgrupadorPreguntaType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true
                        )
                )


        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\CampaniasBundle\Entity\Encuesta'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_campaniasbundle_campaniaencuesta';
    }

}
