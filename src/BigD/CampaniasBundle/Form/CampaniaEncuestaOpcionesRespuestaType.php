<?php

namespace BigD\CampaniasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampaniaEncuestaOpcionesRespuestaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('obligatorio')
            ->add('textoOpcion')
            ->add('slug')
            ->add('campaniaEncuestaPreguntas')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\CampaniasBundle\Entity\CampaniaEncuestaOpcionesRespuesta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bigd_campaniasbundle_campaniaencuestaopcionesrespuesta';
    }
}
