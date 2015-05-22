<?php

namespace BigD\CampaniasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BigD\CampaniasBundle\Entity\OpcionesRespuesta;
use BigD\CampaniasBundle\Form\OpcionesRespuestaType;

/**
 * OpcionesRespuesta controller.
 *
 */
class OpcionesRespuestaController extends Controller
{

    /**
     * Lists all OpcionesRespuesta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampaniasBundle:OpcionesRespuesta')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, 
                $this->get('request')->query->get('page', 1)/* page number */, 
                10/* limit per page */
        );
        return $this->render('CampaniasBundle:OpcionesRespuesta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new OpcionesRespuesta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new OpcionesRespuesta();
        $form = $this->createForm(new OpcionesRespuestaType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'OpcionesRespuesta Creado correctamente.'
            );
            
            return $this->redirect($this->generateUrl('opciones_respuestas_edit', array('id' => $entity->getId())));
        }

        return $this->render('CampaniasBundle:OpcionesRespuesta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a OpcionesRespuesta entity.
     *
     * @param OpcionesRespuesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OpcionesRespuesta $entity)
    {
        $form = $this->createForm(new OpcionesRespuestaType(), $entity, array(
            'action' => $this->generateUrl('opciones_respuestas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new OpcionesRespuesta entity.
     *
     */
    public function newAction()
    {
        $entity = new OpcionesRespuesta();        
        $form   = $this->createForm(new OpcionesRespuestaType(), $entity);

        return $this->render('CampaniasBundle:OpcionesRespuesta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a OpcionesRespuesta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:OpcionesRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpcionesRespuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CampaniasBundle:OpcionesRespuesta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing OpcionesRespuesta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:OpcionesRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpcionesRespuesta entity.');
        }
        
        $editForm = $this->createForm(new OpcionesRespuestaType(), $entity);
        

        return $this->render('CampaniasBundle:OpcionesRespuesta:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a OpcionesRespuesta entity.
    *
    * @param OpcionesRespuesta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OpcionesRespuesta $entity)
    {
        $form = $this->createForm(new OpcionesRespuestaType(), $entity, array(
            'action' => $this->generateUrl('opciones_respuestas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing OpcionesRespuesta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:OpcionesRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpcionesRespuesta entity.');
        }

        
        $editForm =  $this->createForm(new OpcionesRespuestaType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'OpcionesRespuesta Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('opciones_respuestas_edit', array('id' => $id)));
        }

        return $this->render('CampaniasBundle:OpcionesRespuesta:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }
    /**
     * Deletes a OpcionesRespuesta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampaniasBundle:OpcionesRespuesta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OpcionesRespuesta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('opciones_respuestas'));
    }

    /**
     * Creates a form to delete a OpcionesRespuesta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('opciones_respuestas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
