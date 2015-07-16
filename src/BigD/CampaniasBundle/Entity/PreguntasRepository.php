<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 14/7/15
 * Time: 15:08
 */

namespace BigD\CampaniasBundle\Entity;


use Doctrine\ORM\EntityRepository;

class PreguntasRepository extends EntityRepository
{

    public function esMultiple($idPregunta)
    {
        $db = $this->getEntityManager()->getConnection();
        $query = "SELECT
                     campania_encuesta_agrupador_pregunta.multiple AS multiple
                FROM
                     public.campania_encuesta_agrupador_pregunta campania_encuesta_agrupador_pregunta
                     INNER JOIN public.campania_encuesta_preguntas campania_encuesta_preguntas ON campania_encuesta_agrupador_pregunta.id = campania_encuesta_preguntas.campania_encuesta_agrupador_pregunta_id
                WHERE
                     campania_encuesta_preguntas.id = ".$idPregunta;

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getPreguntasPorAgrupadorId($idAgrupador)
    {
        $db = $this->getEntityManager()->getConnection();
        $query = "select pre.texto_pregunta
                   from campania_encuesta_agrupador_pregunta agru
                   inner join campania_encuesta_preguntas pre  on agru.id=pre.campania_encuesta_agrupador_pregunta_id
                   where agru.id=$idAgrupador
                   order by pre.id";

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}