<?php

namespace BigD\CampaniasBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ResultadoCabeceraRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResultadoCabeceraRepository extends EntityRepository
{

    public function getResultadoCabeceraPorEncuesta($idEncuesta)
    {
        $db = $this->getEntityManager()->getConnection();

        $query = "SELECT DISTINCT
                 campania_encuesta_resultado_cabecera.id AS resultado_cabecera_id
            FROM
                 campania_encuesta_agrupador_pregunta campania_encuesta_agrupador_pregunta INNER JOIN campania_encuesta_preguntas campania_encuesta_preguntas ON campania_encuesta_agrupador_pregunta.id = campania_encuesta_preguntas.campania_encuesta_agrupador_pregunta_id
                 INNER JOIN campania_encuesta_pregunta_resultado_respuesta campania_encuesta_pregunta_resultado_respuesta ON campania_encuesta_preguntas.id = campania_encuesta_pregunta_resultado_respuesta.campania_encuesta_pregunta_id
                 INNER JOIN campania_encuesta_resultado_respuesta campania_encuesta_resultado_respuesta ON campania_encuesta_pregunta_resultado_respuesta.campania_encuesta_resultado_respuesta_id = campania_encuesta_resultado_respuesta.id
                 INNER JOIN campania_encuesta_resultado_cabecera campania_encuesta_resultado_cabecera ON campania_encuesta_resultado_respuesta.campania_encuesta_resultado_cabecera_id = campania_encuesta_resultado_cabecera.id
            WHERE
                 campania_encuesta_agrupador_pregunta.campania_encuesta_id =$idEncuesta
            ORDER BY campania_encuesta_resultado_cabecera.id
                 ";

        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}