<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 2/11/15
 * Time: 7:40 PM
 */

namespace BigD\CampaniasBundle\Entity;


use Doctrine\ORM\EntityRepository;

class PreguntaResultadoRespuestaRepository  extends EntityRepository
{


    public function getRespuesta($pregunta, $cabecera)
    {
        $qb= $this->createQueryBuilder('prr');
        $qb->join('prr.preguntas', 'preg')
            ->join('prr.resultadoRespuesta', 'rr')
            ->join('rr.resultadoCabecera', 'cab')
            ->where('preg = :pregunta')
            ->andWhere('cab = :cabecera');
        $qb->setParameter('pregunta',$pregunta);
        $qb->setParameter('cabecera',$cabecera);

        return $qb->getQuery()->getResult();
    }
}