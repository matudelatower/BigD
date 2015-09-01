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
        $query = "select pre.texto_pregunta,campania_encuesta_agrupador_pregunta_id,pre.id as pregunta_id
                    from   campania_encuesta_preguntas pre
                    where pre.campania_encuesta_agrupador_pregunta_id=$idAgrupador
                    ORDER BY pre.id ASC
                    ";

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getCantidadPreguntasPorAgrupadorIdParaPosadasPremia($idResultadoCabecera)
    {

        $db = $this->getEntityManager()->getConnection();

        $query = "select count(distinct(pre.id))
                from campania_encuesta_preguntas pre
                inner join campania_encuesta_pregunta_resultado_respuesta med
                on med.campania_encuesta_pregunta_id=pre.id

                inner join campania_encuesta_resultado_respuesta res
                on res.id=med.campania_encuesta_resultado_respuesta_id

                inner join campania_encuesta_resultado_cabecera cab
                on res.campania_encuesta_resultado_cabecera_id=cab.id
                where cab.id=$idResultadoCabecera";

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();

    }

    public function getPreguntasPorEncuesta($encuesta)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->join('p.agrupadorPregunta', 'agp');
        $qb->join('agp.encuesta', 'enc');
        $qb->andWhere('enc.id = :encuestaId');
        $qb->setParameter('encuestaId', $encuesta);

        return $qb->getQuery()->getResult();
    }

}