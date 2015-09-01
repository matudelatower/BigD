<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 15/7/15
 * Time: 21:06
 */

namespace BigD\CampaniasBundle\Entity;


use BigD\UtilBundle\lib\DateTools;
use Doctrine\ORM\EntityRepository;

class AgrupadorPreguntaRepository extends EntityRepository
{
    public function getAgrupadoresPorEncuestaId($idEncuesta, $filtros = null)
    {

        $db = $this->getEntityManager()->getConnection();

        $sql = "select agru.id as agrupador_id,agru.multiple
                  from  campania_encuesta_agrupador_pregunta agru
                  WHERE agru.campania_encuesta_id=$idEncuesta
                  ORDER BY agru.id ASC
                  ";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();

    }

    public function getCantidadPreguntasPorAgrupadorId($idAgrupador)
    {

        $db = $this->getEntityManager()->getConnection();

        $query = "select count(pre.id)as cantidad
                from campania_encuesta_preguntas pre
                where pre.campania_encuesta_agrupador_pregunta_id=".$idAgrupador;

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();

    }

    public function getPreguntasMultiplesPorAgrupadorId($agrupadorId)
    {
        $db = $this->getEntityManager()->getConnection();
        $query = "select pre.texto_pregunta,pre.id as pregunta_id
                    from campania_encuesta_agrupador_pregunta agru
                    inner join campania_encuesta_preguntas pre  on agru.id=pre.campania_encuesta_agrupador_pregunta_id
                    where agru.id=$agrupadorId
                    order by pre.id";
        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function esAgrupadorMultiple($idAgrupador, $idResultadoCabecera)
    {

        $db = $this->getEntityManager()->getConnection();

        $query = "select agru.multiple

                from campania_encuesta_agrupador_pregunta agru
                inner join campania_encuesta_preguntas pre on agru.id=pre.campania_encuesta_agrupador_pregunta_id
                inner join campania_encuesta_pregunta_resultado_respuesta med
                on med.campania_encuesta_pregunta_id=pre.id

                inner join campania_encuesta_resultado_respuesta res
                on res.id=med.campania_encuesta_resultado_respuesta_id

                inner join campania_encuesta_resultado_cabecera cab
                on res.campania_encuesta_resultado_cabecera_id=cab.id
                where cab.id=$idResultadoCabecera and agru.id=$idAgrupador
                order by res.id limit 1";

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();

    }


}