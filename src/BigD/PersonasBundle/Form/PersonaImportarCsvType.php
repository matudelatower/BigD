<?php

namespace BigD\PersonasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PersonaImportarCsvType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $assert = new Assert\File(array(
//            'maxSize' => '5120k',
            'mimeTypes' => array(
                'text/csv',
                'application/vnd.ms-excel'
            ),
            'mimeTypesMessage' => 'Por favor seleccione un archivo csv',
                ));

        $builder->add('fuenteDatos', 'entity', array(
                    'class' => 'PersonasBundle:FuenteDatos',
                    'property' => 'descripcion',
                ))
                ->add('etiqueta', 'entity', array(
                    'class' => 'PersonasBundle:Etiqueta',
                    'property' => 'nombre',
                ))
                ->add('archivo', 'file', array(
                    'constraints' => array($assert),
                    'attr' => array('accept' => 'text/csv, application/vnd.ms-excel')
                        )
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'bigd_personasbundle_persona_importar_csv_type';
    }

}
