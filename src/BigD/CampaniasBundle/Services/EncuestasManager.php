<?php

/**
 * Created by PhpStorm.
 * User: matias
 * Date: 13/7/15
 * Time: 17:44
 */

namespace BigD\CampaniasBundle\Services;

class EncuestasManager {

    private $container;
    private $em;

    public function __construct($container) {
        $this->container = $container;
        $this->em = $container->get('doctrine')->getManager();
    }

    public function getPreguntasPorIdEncuesta($id) {
        $em = $this->em;
        $preguntas = $em->getRepository('CampaniasBundle:Encuesta')->getPreguntasPorIdEncuesta($id);

        return $preguntas;
    }

    public function getPreguntasRespuestaPorIdEncuesta($id) {
        $em = $this->em;
        $preguntas = $em->getRepository('CampaniasBundle:Encuesta')->getPreguntasRespuestaPorIdEncuesta($id);

        return $preguntas;
    }

    public function getAEncuestas($id, $filtros = null) {
        ini_set('display_errors', true);
        set_time_limit(0);
        ini_set("memory_limit", "-1");
        $em = $this->em;

        $cabecera = array();
        $orden = 0;
        $arrayOrden = array();
        $cantidadPorAgrupador = array();
        $tabla = array();

        //Traigo los agrupadores
        $agrupadores = $em->getRepository('CampaniasBundle:AgrupadorPregunta')->getAgrupadoresPorEncuestaId($id, $filtros);

        foreach ($agrupadores as $agrupador) {
            if (!$agrupador['multiple']) {
                $preguntas = $em->getRepository('CampaniasBundle:Preguntas')->getPreguntasPorAgrupadorId(
                        $agrupador['agrupador_id']
                );
                foreach ($preguntas as $pregunta) {
                    $cabecera[] = $pregunta['texto_pregunta'];
                    $arrayOrden[$pregunta['pregunta_id']] = $orden;
                    $orden++;
                }
                $cantidadPorAgrupador[] = array("id" => $agrupador['agrupador_id'], "cantidad" => 1);
            } else {

                $cantidadAgrupador = $em->getRepository('CampaniasBundle:Encuesta')->getMaxCamposEncuestaPorAgrupadorId(
                        $agrupador['agrupador_id']
                );

                //traigo las preguntas de este agrupador y las creo la cantidad de $cantidadAgrupador
                $preguntasPorAgrupador = $em->getRepository(
                                'CampaniasBundle:AgrupadorPregunta'
                        )->getPreguntasMultiplesPorAgrupadorId(
                        $agrupador['agrupador_id']
                );

                $cabeceraAgrupador = array();
                foreach ($preguntasPorAgrupador as $preguntaPorAgrupador) {
                    $cabeceraAgrupador[] = $preguntaPorAgrupador['texto_pregunta'];
                    $arrayOrden[$preguntaPorAgrupador['pregunta_id']] = $orden;
                    $orden++;
                }
                $contadorPreguntasReales = 1;
                $cantidadAgrupador = $cantidadAgrupador[0]['max'];
                for ($i = 0; $i < $cantidadAgrupador; $i++) {
                    foreach ($cabeceraAgrupador as $pregunta) {
                        $cabecera[] = $pregunta;
                        $contadorPreguntasReales++;
                        if ($contadorPreguntasReales >= $cantidadAgrupador) {
                            $orden++;
                        }
                    }
                }
                $cantidadPorAgrupador[] = array("id" => $agrupador['agrupador_id'], "cantidad" => $cantidadAgrupador);
            }
        }

        $cabecera[] = "Fecha creado";
        $fila1 = ksort($arrayOrden);

        $encuestasResultado = $em->getRepository('CampaniasBundle:ResultadoCabecera')->getResultadoCabeceraPorEncuesta(
                $id
        );

        foreach ($encuestasResultado as $encuestaResultado) {
            //consulto cuantas preguntas tiene la encuesta para saber si es la encuesta con error de 52 o la de 53
            $cantidadPreguntasEncuesta = $em->getRepository(
                            'CampaniasBundle:Preguntas'
                    )->getCantidadPreguntasPorAgrupadorIdParaPosadasPremia($encuestaResultado['resultado_cabecera_id']);

            $fila = array();

            foreach ($cantidadPorAgrupador as $aAgrupador) {
                //consulto cantidad de preguntas que tiene el agrupador
                $cantidadPreguntasAgrupador = $em->getRepository(
                                'CampaniasBundle:AgrupadorPregunta'
                        )->getCantidadPreguntasPorAgrupadorId(
                                $aAgrupador['id']
                        )[0];

                //consulto si el agrupador es multiple
                $multiple = $em->getRepository(
                                'CampaniasBundle:AgrupadorPregunta'
                        )->esAgrupadorMultiple(
                        $aAgrupador['id'], $encuestaResultado['resultado_cabecera_id']
                );

                $respuestasAgrupador = $em->getRepository(
                                'CampaniasBundle:ResultadoRespuesta'
                        )->getRespuestasPorAgrupadorId(
                        $aAgrupador['id'], $encuestaResultado['resultado_cabecera_id']
                );

                if ($multiple[0]['multiple']) {
                    $contadorPreguntasAgrupador = 0;
                    foreach ($respuestasAgrupador as $respuestaAgrupador) {

                        if ($contadorPreguntasAgrupador < $cantidadPreguntasAgrupador['cantidad']) {
                            //mientras sea el primer modulo de este agrupador puedo sacar als posiciones por id
                            $ordenCorrecto = $arrayOrden[$respuestaAgrupador['pregunta_id']];
                            $fila[$ordenCorrecto] = $respuestaAgrupador['textorespuesta'];
                            $contadorPreguntasAgrupador++;
                            $ordenCorrectoMultiple = $ordenCorrecto;
                            //guardo la ultima posicion de orden_correcto en orden_correcto_multiple para despues
                            //sacar las posiciones sumando
                        } else {
                            //cuando ya no puedo sacar el orden por array_orden lo saco sumando posiciones
                            $ordenCorrectoMultiple++;
                            $fila[$ordenCorrectoMultiple] = ($respuestaAgrupador['textorespuesta']);
                            $contadorPreguntasAgrupador++;
                        }
                    }
                    $faltante = ($cantidadPreguntasAgrupador['cantidad'] * $aAgrupador['cantidad']) - $contadorPreguntasAgrupador;
                    if ($faltante > 0) {
                        //cuando el hay lugar para mas modulos de este agrupador y la encuesta no tiene datos, los
                        //completo con  ""
                        for ($m = 0; $m < $faltante; $m++) {
                            $ordenCorrectoMultiple++;
                            $fila[$ordenCorrectoMultiple] = "";
                        }
                    }
                } else {
                    foreach ($respuestasAgrupador as $respuestaAgrupador) {
                        $ordenCorrecto = $arrayOrden[$respuestaAgrupador['pregunta_id']];
                        if ($cantidadPreguntasEncuesta[0]['count'] == 52 && $respuestaAgrupador['pregunta_id'] == 34) {
                            //si es la encuesta de 52 preguntas y es el id de pregunta 34, osea un id menos del id que falta, lo
                            //relleno con blanco
                            $fila[$ordenCorrecto] = $respuestaAgrupador['textorespuesta'];
                            $ordenCorrecto++;
                            $fila[$ordenCorrecto] = "";
                        } else {

                            $fila[$ordenCorrecto] = $respuestaAgrupador['textorespuesta'];
                        }
                    }
                }
            }

            $fechaCreado = $em->getRepository('CampaniasBundle:ResultadoCabecera')->findOneById($encuestaResultado['resultado_cabecera_id']);
            $fila[] = $fechaCreado->getFecha()->format('d/m/Y');
            $fila1 = ksort($fila);
            $tabla[] = $fila;
        }

        return array(
            'cabecera' => $cabecera,
            'tabla' => $tabla,
        );
    }

}
