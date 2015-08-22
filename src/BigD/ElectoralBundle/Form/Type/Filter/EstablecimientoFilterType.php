<?php

namespace BigD\ElectoralBundle\Form\Type\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstablecimientoFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'codigo',
                'text',
                array(
                    'required' => false,
                )
            )
            ->add(
                'descripcion',
                'text',
                array(
                    'required' => false,
                )
            )
//            ->add('direccion')
//            ->add('localidad','jqueryautocomplete',array(
//                'class'=>'UbicacionBundle:Localidad',
//                'property' => 'descripcion',
//                'search_method' => 'getByLike'
//            ) )

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'csrf_protection' => false,
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bigd_electoralbundle_establecimiento_filter_type';
    }
}
