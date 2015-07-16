<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 15/7/15
 * Time: 21:06
 */

namespace BigD\CampaniasBundle\Entity;


use Doctrine\ORM\EntityRepository;

class AgrupadorPreguntaRepository extends EntityRepository
{
    public function getAgrupadoresPorEncuestaId($idEncuesta)
    {

        $db = $this->getEntityManager()->getConnection();

        $query = "select agru.id as agrupador_id,agru.multiple
from  campania_encuesta_agrupador_pregunta agru
WHERE agru.campania_encuesta_id=$idEncuesta
order by agru.id asc";

        $stmt = $db->prepare($query);
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

}