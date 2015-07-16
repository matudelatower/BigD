<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 13/7/15
 * Time: 17:44
 */

namespace BigD\CampaniasBundle\Services;


class EncuestasManager
{
    private $container;
    private $em;

    public function __construct($container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine')->getManager();
    }

    public function getPreguntasPorIdEncuesta($id)
    {
        $em = $this->em;
        $preguntas = $em->getRepository('CampaniasBundle:Encuesta')->getPreguntasPorIdEncuesta($id);

        return $preguntas;

    }

    public function getPreguntasRespuestaPorIdEncuesta($id)
    {
        $em = $this->em;
        $preguntas = $em->getRepository('CampaniasBundle:Encuesta')->getPreguntasRespuestaPorIdEncuesta($id);

        return $preguntas;

    }

    public function getAEncuestas($id)
    {
//        ini_set('display_errors', true);
//        set_time_limit(0);
//        ini_set("memory_limit", "-1");
        $em = $this->em;

        $cabecera = array();
        $cantidadPorAgrupador = array();
        $tabla = array();

        $agrupadores = $em->getRepository('CampaniasBundle:AgrupadorPregunta')->getAgrupadoresPorEncuestaId($id);

        foreach ($agrupadores as $agrupador) {
            if (!$agrupador['multiple']) {
                $preguntas = $em->getRepository('CampaniasBundle:Preguntas')->getPreguntasPorAgrupadorId(
                    $agrupador['agrupador_id']
                );
                foreach ($preguntas as $pregunta) {
                    $cabecera[] = utf8_decode($pregunta['texto_pregunta']);
                }
                $cantidadPorAgrupador[] = array("id" => $agrupador['agrupador_id'], "cantidad" => 1);

            } else {

                $cantidadAgrupador = $em->getRepository('CampaniasBundle:Encuesta')->getMaxCamposEncuestaPorAgrupadorId(
                    $agrupador['agrupador_id']
                );

                $preguntasPorAgrupador = $em->getRepository('CampaniasBundle:Preguntas')->getPreguntasPorAgrupadorId(
                    $agrupador['agrupador_id']
                );

                $cabeceraAgrupador = array();
                foreach ($preguntasPorAgrupador as $preguntaPorAgrupador) {
                    $cabeceraAgrupador[] = $preguntaPorAgrupador['texto_pregunta'];
                }
                $cantidadAgrupador = $cantidadAgrupador[0]['max'];
                for ($i = 0; $i < $cantidadAgrupador; $i++) {
                    foreach ($cabeceraAgrupador as $pregunta) {
                        $cabecera[] = $pregunta;
                    }
                }
                $cantidadPorAgrupador[] = array(
                    "id" => $agrupador['agrupador_id'],
                    "cantidad" => $cantidadAgrupador
                );

            }

        }

        $fila = array();

        foreach ($cantidadPorAgrupador as $agrupador) {

            $cantidadPreguntasAgrupador = $em->getRepository(
                'CampaniasBundle:AgrupadorPregunta'
            )->getCantidadPreguntasPorAgrupadorId(
                $agrupador['id']
            )[0];

            $contadorPreguntasAgrupador = 0;

            $respuestasAgrupador = $em->getRepository(
                'CampaniasBundle:ResultadoRespuesta'
            )->getRespuestasPorAgrupadorId(
                $agrupador['id']
            );

            foreach ($respuestasAgrupador as $repuestaAgrupador) {
                $fila[] = $repuestaAgrupador['textorespuesta'];
                $contadorPreguntasAgrupador++;
            }
            $faltante = ($cantidadPreguntasAgrupador['cantidad'] * $agrupador['cantidad']) - $contadorPreguntasAgrupador;
            if ($faltante > 0) {
                for ($m = 0; $m < $faltante; $m++) {
                    $fila[] = "";
                }
            }
            $tabla[] = $fila;
            $fila = array();

        }


        return array(
            'cabecera' => $cabecera,
            'tabla' => $tabla,
        );

    }

}