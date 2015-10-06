<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 25/8/15
 * Time: 19:22
 */

namespace BigD\CampaniasBundle\Form\Model;


use BigD\CampaniasBundle\Form\PreguntasParameterType;

class PreguntasParameter
{
    protected $data;
    protected $subPreguntas;

    public function __construct($parameters, $edit = false)
    {
        if ($edit == false) {
            $this->subPreguntas = array();
            foreach ($parameters as $k => $value) {
                /* @var $value \BigD\CampaniasBundle\Entity\Preguntas */

                if ($value->getAgrupadorPregunta()->getMultiple()) {
                    $fieldName = ucwords(
                        preg_replace(
                            '/[^A-Za-z0-9\-]/',
                            '',
                            str_replace(' ', '', $value->getAgrupadorPregunta()->getNombre())
                        )
                    );
                    $this->subPreguntas[$fieldName][] = $this->buildFieldPregunta($value);
                } else {

                    $name = $value->getId();
                    $widgetType = 'text';
                    if ($value->getTipoPregunta()->getMuestraOpciones()) {
                        $widgetType = 'choice';
                    } elseif ($value->getTipoPregunta()->getSlug() == 'tipo-pregunta-date') {
                        $widgetType = 'date';
                    }
                    $this->data[$name] = array(
                        "widgetType" => $widgetType,
                        "label" => $value->getTextoPregunta(),
                        "value" => "",
                        "required" => $value->getRequerido() ? true : false,
                    );
                    if ($value->getTipoPregunta()->getMuestraOpciones()) {
                        foreach ($value->getOpcionRespuesta()->toArray() as $opcion) {
                            $this->data[$name]['choices'][$opcion->getId()] = $opcion->getTextoOpcion();
                        }

                    }
                    $this->{$name} = "";

                }
            }

            return $this;
        } else {
            foreach ($parameters as $k => $value) {
                $name = $value->getParameterid();
                $pvalue = $value->getValue();
                $this->data[$name] = array("label" => $value->getTextoPregunta(), "value" => $pvalue);
                $this->{$name} = $pvalue;
            }
        }
    }

    public function buildFieldPregunta($pregunta)
    {
        $aPregunta = array();

        $name = $pregunta->getId();
        $widgetType = 'text';
        if ($pregunta->getTipoPregunta()->getMuestraOpciones()) {
            $widgetType = 'choice';
        } elseif ($pregunta->getTipoPregunta()->getSlug() == 'tipo-pregunta-date') {
            $widgetType = 'date';
        }
        $aPregunta[$name] = array(
            "widgetType" => $widgetType,
            "label" => $pregunta->getTextoPregunta(),
            "value" => "",
            "required" => $pregunta->getRequerido() ? true : false,
        );
        if ($pregunta->getTipoPregunta()->getMuestraOpciones()) {
            foreach ($pregunta->getOpcionRespuesta()->toArray() as $opcion) {
                $aPregunta[$name]['choices'][$opcion->getId()] = $opcion->getTextoOpcion();
            }

        }
//        $this->{$name} = "";
//
//        return $this;
        return $aPregunta;
    }

    public function get()
    {
        return $this->data;
    }

    public function getSubPreguntas()
    {
        return $this->subPreguntas;
    }
}