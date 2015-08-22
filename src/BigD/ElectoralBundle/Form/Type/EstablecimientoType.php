<?php

namespace BigD\ElectoralBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstablecimientoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('descripcion')
            ->add('direccion')
            ->add('localidad','jqueryautocomplete',array(
                'class'=>'UbicacionBundle:Localidad',
                'property' => 'descripcion',
                'search_method' => 'getByLike'
            ) )

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\ElectoralBundle\Entity\Establecimiento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bigd_electoralbundle_establecimiento';
    }
}
