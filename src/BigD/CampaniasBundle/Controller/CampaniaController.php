<?php

namespace BigD\CampaniasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BigD\CampaniasBundle\Entity\Campania;
use BigD\CampaniasBundle\Form\CampaniaType;

/**
 * Campania controller.
 *
 */
class CampaniaController extends Controller
{

    /**
     * Lists all Campania entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampaniasBundle:Campania')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, 
                $this->get('request')->query->get('page', 1)/* page number */, 
                10/* limit per page */
        );
        return $this->render('CampaniasBundle:Campania:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Campania entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Campania();
        $form = $this->createForm(new CampaniaType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();            
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Campania Creada correctamente.'
            );
            
            return $this->redirect($this->generateUrl('campanias_edit', array('id' => $entity->getId())));
        }

        return $this->render('CampaniasBundle:Campania:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Campania entity.
     *
     * @param Campania $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Campania $entity)
    {
        $form = $this->createForm(new CampaniaType(), $entity, array(
            'action' => $this->generateUrl('campanias_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Campania entity.
     *
     */
    public function newAction()
    {
        $entity = new Campania();        
        $form   = $this->createForm(new CampaniaType(), $entity);

        return $this->render('CampaniasBundle:Campania:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Campania entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:Campania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campania entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CampaniasBundle:Campania:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Campania entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:Campania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campania entity.');
        }
        
        $editForm = $this->createForm(new CampaniaType(), $entity);
        

        return $this->render('CampaniasBundle:Campania:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a Campania entity.
    *
    * @param Campania $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Campania $entity)
    {
        $form = $this->createForm(new CampaniaType(), $entity, array(
            'action' => $this->generateUrl('campanias_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Campania entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:Campania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campania entity.');
        }

        
        $editForm =  $this->createForm(new CampaniaType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Campania Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('campanias_edit', array('id' => $id)));
        }

        return $this->render('CampaniasBundle:Campania:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }
    /**
     * Deletes a Campania entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampaniasBundle:Campania')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Campania entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('campanias'));
    }

    /**
     * Creates a form to delete a Campania entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('campanias_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
