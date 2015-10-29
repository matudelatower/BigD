<?php

namespace BigD\CampaniasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BigD\CampaniasBundle\Entity\ResultadoCabecera;
use BigD\CampaniasBundle\Form\ResultadoCabeceraType;

/**
 * ResultadoCabecera controller.
 *
 */
class ResultadoCabeceraController extends Controller
{

    /**
     * Lists all ResultadoCabecera entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampaniasBundle:ResultadoCabecera')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, 
                $this->get('request')->query->get('page', 1)/* page number */, 
                10/* limit per page */
        );
        return $this->render('CampaniasBundle:ResultadoCabecera:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ResultadoCabecera entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ResultadoCabecera();
        $form = $this->createForm(new ResultadoCabeceraType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'ResultadoCabecera Creado correctamente.'
            );
            
            return $this->redirect($this->generateUrl('resultado_cabecera_edit', array('id' => $entity->getId())));
        }

        return $this->render('CampaniasBundle:ResultadoCabecera:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ResultadoCabecera entity.
     *
     * @param ResultadoCabecera $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ResultadoCabecera $entity)
    {
        $form = $this->createForm(new ResultadoCabeceraType(), $entity, array(
            'action' => $this->generateUrl('resultado_cabecera_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ResultadoCabecera entity.
     *
     */
    public function newAction()
    {
        $entity = new ResultadoCabecera();        
        $form   = $this->createForm(new ResultadoCabeceraType(), $entity);

        return $this->render('CampaniasBundle:ResultadoCabecera:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ResultadoCabecera entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:ResultadoCabecera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ResultadoCabecera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CampaniasBundle:ResultadoCabecera:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ResultadoCabecera entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:ResultadoCabecera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ResultadoCabecera entity.');
        }
        
        $editForm = $this->createForm(new ResultadoCabeceraType(), $entity);
        

        return $this->render('CampaniasBundle:ResultadoCabecera:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a ResultadoCabecera entity.
    *
    * @param ResultadoCabecera $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ResultadoCabecera $entity)
    {
        $form = $this->createForm(new ResultadoCabeceraType(), $entity, array(
            'action' => $this->generateUrl('resultado_cabecera_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ResultadoCabecera entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:ResultadoCabecera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ResultadoCabecera entity.');
        }

        
        $editForm =  $this->createForm(new ResultadoCabeceraType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'ResultadoCabecera Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('resultado_cabecera_edit', array('id' => $id)));
        }

        return $this->render('CampaniasBundle:ResultadoCabecera:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }
    /**
     * Deletes a ResultadoCabecera entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampaniasBundle:ResultadoCabecera')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ResultadoCabecera entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('resultado_cabecera'));
    }

    /**
     * Creates a form to delete a ResultadoCabecera entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resultado_cabecera_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
