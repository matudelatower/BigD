<?php

namespace BigD\PersonasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EtiquetaType extends AbstractType {

    private $esFiltro;

    public function __construct($esFiltro = false) {
        $this->esFiltro = $esFiltro;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        if ($this->esFiltro) {
            $builder
                    ->add('nombre', 'entity', array(
                        'class' => 'PersonasBundle:Etiqueta',
                        'property' => 'nombre',
                    ))
            ;
        } else {
            $builder
                    ->add('nombre')
                    ->add('color')

            ;
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\PersonasBundle\Entity\Etiqueta'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_personasbundle_etiqueta';
    }

}
