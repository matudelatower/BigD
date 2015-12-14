<?php

namespace BigD\PersonasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonaEtiquetaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('etiqueta', 'entity', array(
                    'class' => 'PersonasBundle:Etiqueta',
                    'property' => 'nombre',
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\PersonasBundle\Entity\PersonaEtiqueta'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_personasbundle_personaetiqueta';
    }

}
