<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 14/7/15
 * Time: 18:44
 */

namespace BigD\CampaniasBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ResultadoRespuestaRepository extends EntityRepository
{

    public function getMaximoRespuestaPorId($id)
    {
        $db = $this->getEntityManager()->getConnection();
        $query = "SELECT
                     count(campania_encuesta_resultado_respuesta.id) AS cantidad_respuesta,
                     campania_encuesta_resultado_cabecera.nrocuestionario AS campania_encuesta_resultado_cabecera_nrocuestionario
                FROM
                     public.campania_encuesta_preguntas campania_encuesta_preguntas RIGHT OUTER JOIN public.campania_encuesta_pregunta_resultado_respuesta campania_encuesta_pregunta_resultado_respuesta ON campania_encuesta_preguntas.id = campania_encuesta_pregunta_resultado_respuesta.campania_encuesta_pregunta_id
                     RIGHT OUTER JOIN public.campania_encuesta_resultado_respuesta campania_encuesta_resultado_respuesta ON campania_encuesta_pregunta_resultado_respuesta.campania_encuesta_resultado_respuesta_id = campania_encuesta_resultado_respuesta.id
                     INNER JOIN public.campania_encuesta_resultado_cabecera campania_encuesta_resultado_cabecera ON campania_encuesta_resultado_respuesta.campania_encuesta_resultado_cabecera_id = campania_encuesta_resultado_cabecera.id
                WHERE
                     campania_encuesta_preguntas.id = $id
                GROUP BY
                     campania_encuesta_resultado_cabecera.nrocuestionario
                ORDER BY cantidad_respuesta DESC";

        $stmt = $db->prepare($query);
        $stmt->execute();
        $cantidad = $stmt->fetchAll()[0]['cantidad_respuesta'];

        return $cantidad;
    }

    public function getRespuestasPorPreguntaId($idPregunta)
    {
        $db = $this->getEntityManager()->getConnection();


        $query = "SELECT
             campania_encuesta_resultado_respuesta.textorespuesta AS texto_respuesta
        FROM
             campania_encuesta_resultado_respuesta campania_encuesta_resultado_respuesta
             INNER JOIN campania_encuesta_pregunta_resultado_respuesta campania_encuesta_pregunta_resultado_respuesta ON campania_encuesta_resultado_respuesta.id = campania_encuesta_pregunta_resultado_respuesta.campania_encuesta_resultado_respuesta_id
        WHERE
             campania_encuesta_pregunta_resultado_respuesta.campania_encuesta_pregunta_id = ".$idPregunta;

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getRespuestasPorAgrupadorId($idAgrupador, $idResultadoCabecera)
    {
        $db = $this->getEntityManager()->getConnection();


        $query = "select agru.id,pre.texto_pregunta,res.textorespuesta, res.campania_encuesta_opcion_respuesta_id as id_opcion_respuesta,
                  agru.multiple,pre.id as pregunta_id,
                  res_resp.slug

                from campania_encuesta_agrupador_pregunta agru
                inner join campania_encuesta_preguntas pre on agru.id=pre.campania_encuesta_agrupador_pregunta_id
                inner join campania_encuesta_pregunta_resultado_respuesta med
                on med.campania_encuesta_pregunta_id=pre.id

                inner join campania_encuesta_resultado_respuesta res
                on res.id=med.campania_encuesta_resultado_respuesta_id

                inner join campania_encuesta_resultado_cabecera cab
                on res.campania_encuesta_resultado_cabecera_id=cab.id

                left join campania_encuesta_opciones_respuesta res_resp
		        on res.campania_encuesta_opcion_respuesta_id = res_resp.id

                where cab.id=$idResultadoCabecera and agru.id=$idAgrupador
                order by res.id";

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}