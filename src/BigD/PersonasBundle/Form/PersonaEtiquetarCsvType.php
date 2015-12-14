<?php

namespace BigD\PersonasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonaEtiquetarCsvType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('etiquetas', 'bootstrapcollection', array(
            'type' => new EtiquetaCsvType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => true
        ))
        ->add('archivo', 'file');//TODO agregar asert para controlar csv
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
        return 'bigd_personasbundle_persona_etiquetar_csv_type';
    }

}
