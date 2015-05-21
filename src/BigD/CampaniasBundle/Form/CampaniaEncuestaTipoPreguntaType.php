<?php

namespace BigD\CampaniasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampaniaEncuestaTipoPreguntaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('slug')
            ->add('creado')
            ->add('actualizado')
            ->add('creadoPor')
            ->add('actualizadoPor')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BigD\CampaniasBundle\Entity\CampaniaEncuestaTipoPregunta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bigd_campaniasbundle_campaniaencuestatipopregunta';
    }
}
