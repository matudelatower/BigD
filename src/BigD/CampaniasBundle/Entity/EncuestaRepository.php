<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 13/7/15
 * Time: 18:01
 */

namespace BigD\CampaniasBundle\Entity;


use Doctrine\ORM\EntityRepository;

class EncuestaRepository extends EntityRepository
{
    public function getPreguntasPorIdEncuesta($id)
    {
        $db = $this->getEntityManager()->getConnection();
        $query = "SELECT
     campania_encuesta_resultado_respuesta.textorespuesta AS textorespuesta,
     campania_encuesta_preguntas.texto_pregunta AS texto_pregunta,
     campania_encuesta_preguntas.id AS preguntas_id,
     campania_encuesta_resultado_cabecera.id AS resultado_cabecera_id
FROM
     public.campania_encuesta_resultado_respuesta campania_encuesta_resultado_respuesta LEFT OUTER JOIN public.campania_encuesta_pregunta_resultado_respuesta campania_encuesta_pregunta_resultado_respuesta ON campania_encuesta_resultado_respuesta.id = campania_encuesta_pregunta_resultado_respuesta.campania_encuesta_resultado_respuesta_id
     LEFT OUTER JOIN public.campania_encuesta_preguntas campania_encuesta_preguntas ON campania_encuesta_pregunta_resultado_respuesta.campania_encuesta_pregunta_id = campania_encuesta_preguntas.id
     INNER JOIN public.campania_encuesta_agrupador_pregunta campania_encuesta_agrupador_pregunta ON campania_encuesta_preguntas.campania_encuesta_agrupador_pregunta_id = campania_encuesta_agrupador_pregunta.id
     INNER JOIN public.campania_encuesta_resultado_cabecera campania_encuesta_resultado_cabecera ON campania_encuesta_resultado_respuesta.campania_encuesta_resultado_cabecera_id = campania_encuesta_resultado_cabecera.id
WHERE
     campania_encuesta_agrupador_pregunta.campania_encuesta_id = 1
ORDER BY
     campania_encuesta_resultado_cabecera.id ASC";

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getPreguntasRespuestaPorIdEncuesta($id)
    {
        $db = $this->getEntityManager()->getConnection();
        $query = "select
                        pre.id AS pregunta_id,
                        pre.texto_pregunta AS texto_pregunta,
                        res.textorespuesta AS texto_respuesta
                from campania_encuesta_preguntas pre
                inner join campania_encuesta_pregunta_resultado_respuesta med
                on med.campania_encuesta_pregunta_id=pre.id

                inner join campania_encuesta_resultado_respuesta res
                on res.id=med.campania_encuesta_resultado_respuesta_id

                inner join campania_encuesta_resultado_cabecera cab
                on res.campania_encuesta_resultado_cabecera_id=cab.id

                inner join campania_encuesta_agrupador_pregunta apre
                on apre.id=pre.campania_encuesta_agrupador_pregunta_id

                inner join campania_encuesta enc
                on enc.id= apre.campania_encuesta_id

                where enc.id=$id
                order by res.id";

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

//    public function getPreguntasPorAgrupadorId($id)
//    {
//        $db = $this->getEntityManager()->getConnection();
//        $query = "select pre.texto_pregunta,campania_encuesta_agrupador_pregunta_id
//                   from   campania_encuesta_preguntas pre
//                   where pre.campania_encuesta_agrupador_pregunta_id=$id
//                   order by campania_encuesta_agrupador_pregunta_id asc";
//
//        $stmt = $db->prepare($query);
//        $stmt->execute();
//
//        return $stmt->fetchAll();
//    }

    public function getMaxCamposEncuestaPorAgrupadorId($idAgrupador)
    {

        $db = $this->getEntityManager()->getConnection();
        $query = "select max(conteo)
               from(select pre.id pregunta,cab.id cabecera,count(med.id) as conteo
                   from  campania_encuesta enc
                   inner join campania_encuesta_agrupador_pregunta agru on enc.id=agru.campania_encuesta_id
                   inner join campania_encuesta_preguntas pre  on agru.id=pre.campania_encuesta_agrupador_pregunta_id
                   inner join campania_encuesta_pregunta_resultado_respuesta med on pre.id=med.campania_encuesta_pregunta_id
                   inner join campania_encuesta_resultado_respuesta res on res.id=med.campania_encuesta_resultado_respuesta_id
                   inner join campania_encuesta_resultado_cabecera cab on cab.id=res.campania_encuesta_resultado_cabecera_id
                   where agru.id=$idAgrupador
                   group by cab.id,pre.id) as conteo";
        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();

    }
}