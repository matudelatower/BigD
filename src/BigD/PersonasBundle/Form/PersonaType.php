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
                ->add('nombre')
                ->add('apellido')
                ->add('tipoDocumento')
                ->add('numeroDocumento')
                ->add('cuitCuil')
                ->add('fechaNacimiento', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'datepicker',
                        'data-date-format' => 'dd-mm-yyy'
                    ),
                ))
                ->add('sexo')
                ->add('etiquetas', 'bootstrapcollection', array(
                    'type' => new PersonaEtiquetaType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true,
                        )
                )

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
