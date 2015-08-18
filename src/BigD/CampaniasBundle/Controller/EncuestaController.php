<?php

namespace BigD\CampaniasBundle\Controller;

use BigD\CampaniasBundle\Entity\Encuesta;
use BigD\CampaniasBundle\Form\EncuestaFilterType;
use BigD\CampaniasBundle\Form\EncuestaType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Encuesta controller.
 *
 */
class EncuestaController extends Controller
{

    /**
     * Lists all Encuesta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampaniasBundle:Encuesta')->findAll();

        $form = $this->createForm(new EncuestaFilterType());


        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1)/* page number */,
            10/* limit per page */
        );

        return $this->render(
            'CampaniasBundle:Encuesta:index.html.twig',
            array(
                'entities' => $entities,
                'filter_form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a new Encuesta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Encuesta();
        $form = $this->createForm(new EncuestaType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Encuesta Creado correctamente.'
            );

            return $this->redirect($this->generateUrl('campania_encuesta_edit', array('id' => $entity->getId())));
        }

        return $this->render(
            'CampaniasBundle:Encuesta:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a Encuesta entity.
     *
     * @param Encuesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Encuesta $entity)
    {
        $form = $this->createForm(
            new EncuestaType(),
            $entity,
            array(
                'action' => $this->generateUrl('campania_encuesta_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Encuesta entity.
     *
     */
    public function newAction()
    {
        $entity = new Encuesta();
        $form = $this->createForm(new EncuestaType(), $entity);

        return $this->render(
            'CampaniasBundle:Encuesta:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a Encuesta entity.
     *
     */
    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:Encuesta')->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('No se encontro la encuesta.');
        }

        /* @var $managerEncuestas \BigD\CampaniasBundle\Services\EncuestasManager */
        $managerEncuestas = $this->get('manager.encuestas');

        $encuestas = $managerEncuestas->getAEncuestas($id);

        $paginator = $this->get('knp_paginator');
        $encuestas['tabla'] = $paginator->paginate(
            $encuestas['tabla'],
            $this->get('request')->query->get('page', 1)/* page number */,
            10/* limit per page */
        );


        return $this->render(
            'CampaniasBundle:Encuesta:show.html.twig',
            array(
                'entity' => $entity,
                'encuestas' => $encuestas,


            )
        );
    }

    /**
     * Displays a form to edit an existing Encuesta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:Encuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encuesta entity.');
        }

        $editForm = $this->createForm(new EncuestaType(), $entity);


        return $this->render(
            'CampaniasBundle:Encuesta:edit.html.twig',
            array(
                'entity' => $entity,
                'form' => $editForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a Encuesta entity.
     *
     * @param Encuesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Encuesta $entity)
    {
        $form = $this->createForm(
            new EncuestaType(),
            $entity,
            array(
                'action' => $this->generateUrl('campania_encuesta_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Encuesta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /* @var $entity Encuesta */
        $entity = $em->getRepository('CampaniasBundle:Encuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encuesta entity.');
        }


        $agrupadoresOriginales = new ArrayCollection();
        $preguntasOriginales = new ArrayCollection();

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($entity->getAgrupador() as $agrupador) {
            $agrupadoresOriginales->add($agrupador);
            // Create an ArrayCollection of the current Tag objects in the database
            foreach ($agrupador->getPreguntas() as $pregunta) {
                $preguntasOriginales->add($pregunta);
            }
        }

        $editForm = $this->createForm(new EncuestaType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            //Borro las preguntas y/o los agrupadores
            foreach ($agrupadoresOriginales as $agrupador) {
                if (false === $entity->getAgrupador()->contains($agrupador)) {

                    $em->remove($agrupador);
                }
            }

            /* creo una coleccion con lo que viene el form para comparar despues
             * con las preguntas
             */
            $aCPreguntas = new ArrayCollection();
            foreach ($editForm->getData()->getAgrupador() as $agrupador) {
                foreach ($agrupador->getPreguntas() as $pregunta) {
                    $aCPreguntas->add($pregunta);
                }
            }

            /**
             * si hay alguna pregunta candidata para ser borrada la remueve
             */
            foreach ($preguntasOriginales as $pregunta) {
                if (!$aCPreguntas->contains($pregunta) && null !== $pregunta->getId()) {
                    $em->remove($pregunta);
                }
            }

            //se hacen las asociaciones de los agrupadores y las preguntas
            foreach ($entity->getAgrupador() as $oAgrupador) {
                $oAgrupador->setEncuesta($entity);
                foreach ($oAgrupador->getPreguntas() as $oPregunta) {
                    $oPregunta->setAgrupadorPregunta($oAgrupador);
                    foreach ($oPregunta->getOpcionRespuesta() as $opcionRespuesta) {
                        $opcionRespuesta->setPreguntas($oPregunta);
                    }
                }
            }

            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Encuesta Actualizada correctamente.'
            );

            return $this->redirect($this->generateUrl('campania_encuesta_edit', array('id' => $id)));
        }

        return $this->render(
            'CampaniasBundle:Encuesta:edit.html.twig',
            array(
                'entity' => $entity,
                'form' => $editForm->createView(),
            )
        );
    }

    /**
     * Deletes a Encuesta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampaniasBundle:Encuesta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Encuesta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('campania_encuesta'));
    }

    /**
     * Creates a form to delete a Encuesta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('campania_encuesta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    public function exportarResultadoEncuestaAction($id, Request $request)
    {

//        $filtros = $request->get('bigd_campaniasbundle_campaniaencuesta_filter_type');

        $form = $this->createForm(new EncuestaFilterType());
        $form->handleRequest($request);
        if ($request->isMethod("post")) {
            if ($form->isValid()) {
                $filtros = $form->getData();
            }
        }


        $filename = "resultados_encuestas.xls";


        /* @var $exportExcel \BigD\UtilBundle\Services\ExcelTool */
        $exportExcel = $this->get('excel.tool');
        $exportExcel->setTitle('Resultado Encuestas');
        $exportExcel->setDescripcion('Listado de encuestas exportadas');

        /* @var $managerEncuestas \BigD\CampaniasBundle\Services\EncuestasManager */
        $managerEncuestas = $this->get('manager.encuestas');

        $encuestas = $managerEncuestas->getAEncuestas($id, $filtros);


        $response = $exportExcel->buildSheetResultadosEncuesta($encuestas);

        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename='.$filename.'');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;
    }

}
