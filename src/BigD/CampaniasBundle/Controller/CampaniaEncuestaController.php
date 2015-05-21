<?php

namespace BigD\CampaniasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BigD\CampaniasBundle\Entity\CampaniaEncuesta;
use BigD\CampaniasBundle\Form\CampaniaEncuestaType;

/**
 * CampaniaEncuesta controller.
 *
 */
class CampaniaEncuestaController extends Controller
{

    /**
     * Lists all CampaniaEncuesta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampaniasBundle:CampaniaEncuesta')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, 
                $this->get('request')->query->get('page', 1)/* page number */, 
                10/* limit per page */
        );
        return $this->render('CampaniasBundle:CampaniaEncuesta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new CampaniaEncuesta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CampaniaEncuesta();
        $form = $this->createForm(new CampaniaEncuestaType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'CampaniaEncuesta Creado correctamente.'
            );
            
            return $this->redirect($this->generateUrl('campania_encuesta_edit', array('id' => $entity->getId())));
        }

        return $this->render('CampaniasBundle:CampaniaEncuesta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CampaniaEncuesta entity.
     *
     * @param CampaniaEncuesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CampaniaEncuesta $entity)
    {
        $form = $this->createForm(new CampaniaEncuestaType(), $entity, array(
            'action' => $this->generateUrl('campania_encuesta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CampaniaEncuesta entity.
     *
     */
    public function newAction()
    {
        $entity = new CampaniaEncuesta();        
        $form   = $this->createForm(new CampaniaEncuestaType(), $entity);

        return $this->render('CampaniasBundle:CampaniaEncuesta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CampaniaEncuesta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:CampaniaEncuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampaniaEncuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CampaniasBundle:CampaniaEncuesta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CampaniaEncuesta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:CampaniaEncuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampaniaEncuesta entity.');
        }
        
        $editForm = $this->createForm(new CampaniaEncuestaType(), $entity);
        

        return $this->render('CampaniasBundle:CampaniaEncuesta:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a CampaniaEncuesta entity.
    *
    * @param CampaniaEncuesta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CampaniaEncuesta $entity)
    {
        $form = $this->createForm(new CampaniaEncuestaType(), $entity, array(
            'action' => $this->generateUrl('campania_encuesta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CampaniaEncuesta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:CampaniaEncuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampaniaEncuesta entity.');
        }

        
        $editForm =  $this->createForm(new CampaniaEncuestaType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'CampaniaEncuesta Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('campania_encuesta_edit', array('id' => $id)));
        }

        return $this->render('CampaniasBundle:CampaniaEncuesta:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }
    /**
     * Deletes a CampaniaEncuesta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampaniasBundle:CampaniaEncuesta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CampaniaEncuesta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('campania_encuesta'));
    }

    /**
     * Creates a form to delete a CampaniaEncuesta entity by id.
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
            ->getForm()
        ;
    }
}
