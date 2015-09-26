<?php

namespace BigD\CampaniasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreguntaResultadoRespuestaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('preguntas')
            ->add('resultadoRespuesta', 'bootstrapcollection',array(
                'type' => new ResultadoRespuestaType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => true
            ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\CampaniasBundle\Entity\PreguntaResultadoRespuesta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bigd_campaniasbundle_preguntaresultadorespuesta';
    }
}
