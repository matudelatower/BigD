<?php

namespace BigD\CampaniasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncuestasParameterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $options["data"]->get();
        $arrayOptions = array();
        foreach ($data as $k => $value) {
            $arrayOptions = array(
                "label" => $value["label"],
                "required" => $value["required"],
            );
            if ($value["type"] == 'choice') {
//                $arrayOptions['choices'] = $value["choices"][1];
//                $choicesI = array();
//                $choicesV = array();
//                foreach ($value['choices'] as $indice => $valor) {
//                    $choicesI[] = $indice;
//                    $choicesV[] = $valor;
//                }

                $arrayOptions['choice_list'] = new ChoiceList(
                    $value['choices'],
                    $value['choices']
                );
            }
            $builder->add($k, $value["type"], $arrayOptions);
//            $builder->add($k, $value["type"], array(
//                "label" => $value["label"],
//                "required"=>$value["required"],
//            ));

        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'BigD\CampaniasBundle\Form\Model\EncuestasParameter'
            )
        );
    }

    public function getName()
    {
        return 'campanias_bundle_encuestas_parameter_type';
    }
}