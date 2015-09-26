<?php

namespace BigD\CampaniasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResultadoRespuestaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('textoRespuesta')
//            ->add('creado')
//            ->add('actualizado')
            ->add('opcionesRespuesta')
            ->add('resultadoCabecera')
//            ->add('creadoPor')
//            ->add('actualizadoPor')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\CampaniasBundle\Entity\ResultadoRespuesta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bigd_campaniasbundle_resultadorespuesta';
    }
}
