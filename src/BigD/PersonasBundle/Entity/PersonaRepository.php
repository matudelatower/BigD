<?php

namespace BigD\PersonasBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PersonaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PersonaRepository extends EntityRepository {

    /**
     * Obtiene un ArrayCollection de 1000 personas 
     * 
     * @param array $filters array de filtros
     * @return ArrayCollection un array collection de personas
     */
    public function getAcPersonas($filters = null) {
        $qb = $this->createQueryBuilder('p');

        if ($filters['nombre']) {

            $qb->andWhere('upper(p.nombre) LIKE upper(:nombre)')
                    ->setParameter('nombre', '%' . $filters['nombre'] . '%');
        }
        if ($filters['apellido']) {

            $qb->andWhere('upper(p.apellido) LIKE upper(:apellido)')
                    ->setParameter('apellido', '%' . $filters['apellido'] . '%');
        }
        if ($filters['numeroDocumento']) {

            $qb->andWhere('upper(p.numeroDocumento) LIKE upper(:numeroDocumento)')
                    ->setParameter('numeroDocumento', '%' . $filters['numeroDocumento'] . '%');
        }
        if ($filters['personaConDomicilioPrincipal']) {

            if ($filters['personaConDomicilioPrincipal'] == 'S') {
                $estado = true;
            } elseif ($filters['personaConDomicilioPrincipal'] == 'N') {
                $estado = false;
            }

            $qb->join('p.domicilio', 'dom');
            $qb->andWhere('dom.principal = :principal')
                    ->setParameter('principal', $estado);
        }

        $qb->setMaxResults(1000);

        return $qb->getQuery()->getResult();
    }

    /**
     * Obtiene los datos del padron de ingresos brutos por id de persona
     * 
     * @param Integer $id
     * @return mixed array de resultados sino devuelve FALSE
     */
    public function getDatosIngresosBrutosPorPersonaId($id) {
        $db = $this->getEntityManager()->getConnection();
        $query = "SELECT
                ingresos_brutos.id AS id,
                ingresos_brutos.cuit AS cuit,
                ingresos_brutos.anio AS anio,
                ingresos_brutos.enero AS enero,
                ingresos_brutos.febrero AS febrero,
                ingresos_brutos.marzo AS marzo,
                ingresos_brutos.abril AS abril,
                ingresos_brutos.mayo AS mayo,
                ingresos_brutos.junio AS junio,
                ingresos_brutos.julio AS julio,
                ingresos_brutos.agosto AS agosto,
                ingresos_brutos.septiembre AS septiembre,
                ingresos_brutos.octubre AS octubre,
                ingresos_brutos.noviembre AS noviembre,
                ingresos_brutos.diciembre AS diciembre,
                ingresos_brutos.total AS total
           FROM
                ingresos_brutos ingresos_brutos 
                LEFT OUTER JOIN personas personas ON ingresos_brutos.cuit = personas.cuit_cuil
           WHERE
                personas.id=" . $id;

        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

}
