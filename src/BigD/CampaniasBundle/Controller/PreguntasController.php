<?php

namespace BigD\CampaniasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BigD\CampaniasBundle\Entity\Preguntas;
use BigD\CampaniasBundle\Form\PreguntasType;

/**
 * Preguntas controller.
 *
 */
class PreguntasController extends Controller
{

    /**
     * Lists all Preguntas entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampaniasBundle:Preguntas')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, 
                $this->get('request')->query->get('page', 1)/* page number */, 
                10/* limit per page */
        );
        return $this->render('CampaniasBundle:Preguntas:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Preguntas entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Preguntas();
        $form = $this->createForm(new PreguntasType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Preguntas Creado correctamente.'
            );
            
            return $this->redirect($this->generateUrl('preguntas_edit', array('id' => $entity->getId())));
        }

        return $this->render('CampaniasBundle:Preguntas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Preguntas entity.
     *
     * @param Preguntas $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Preguntas $entity)
    {
        $form = $this->createForm(new PreguntasType(), $entity, array(
            'action' => $this->generateUrl('preguntas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Preguntas entity.
     *
     */
    public function newAction()
    {
        $entity = new Preguntas();        
        $form   = $this->createForm(new PreguntasType(), $entity);

        return $this->render('CampaniasBundle:Preguntas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Preguntas entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:Preguntas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preguntas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CampaniasBundle:Preguntas:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Preguntas entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:Preguntas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preguntas entity.');
        }
        
        $editForm = $this->createForm(new PreguntasType(), $entity);
        

        return $this->render('CampaniasBundle:Preguntas:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a Preguntas entity.
    *
    * @param Preguntas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Preguntas $entity)
    {
        $form = $this->createForm(new PreguntasType(), $entity, array(
            'action' => $this->generateUrl('preguntas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Preguntas entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:Preguntas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preguntas entity.');
        }

        
        $editForm =  $this->createForm(new PreguntasType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Preguntas Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('preguntas_edit', array('id' => $id)));
        }

        return $this->render('CampaniasBundle:Preguntas:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }
    /**
     * Deletes a Preguntas entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampaniasBundle:Preguntas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Preguntas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('preguntas'));
    }

    /**
     * Creates a form to delete a Preguntas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('preguntas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
