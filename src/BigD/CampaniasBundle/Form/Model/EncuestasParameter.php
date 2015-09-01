<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 25/8/15
 * Time: 19:22
 */

namespace BigD\CampaniasBundle\Form\Model;


class EncuestasParameter
{
    protected $data;

    public function __construct($parameters, $edit = false)
    {
        if ($edit == false) {
            foreach ($parameters as $k => $value) {
                /* @var $value \BigD\CampaniasBundle\Entity\Preguntas */
                $name = $value->getId();

                $this->data[$name] = array(
                    "type" => $value->getTipoPregunta()->getMuestraOpciones() ? 'choice' : 'text',
                    "label" => $value->getTextoPregunta(),
                    "value" => "",
                    "required" => $value->getRequerido() ? true : false,
                );
                if ($value->getTipoPregunta()->getMuestraOpciones()) {
                    foreach ($value->getOpcionRespuesta()->toArray() as $opcion) {
                        $this->data[$name]['choices'][$opcion->getId()] = $opcion->getTextoOpcion();
                    }

//                    $this->data[$name]['choices']=$value->getOpcionRespuesta()->toArray();
                }
//                if ($value->getRequerido()) {
//                    $this->data[$name] = array(
//                        "label" => $value->getTextoPregunta(),
//                        "value" => "",
//                        "required" => $value->getRequerido()
//                    );
//                } else {
//                    $this->data[$name] = array("label" => $value->getTextoPregunta(), "value" => "");
//                }

                $this->{$name} = "";
            }
        } else {
            foreach ($parameters as $k => $value) {
                $name = $value->getParameterid();
                $pvalue = $value->getValue();
                $this->data[$name] = array("label" => $value->getTextoPregunta(), "value" => $pvalue);
                $this->{$name} = $pvalue;
            }
        }
    }

    public function get()
    {
        return $this->data;
    }
}