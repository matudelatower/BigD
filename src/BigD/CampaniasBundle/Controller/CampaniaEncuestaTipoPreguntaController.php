<?php

namespace BigD\CampaniasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BigD\CampaniasBundle\Entity\CampaniaEncuestaTipoPregunta;
use BigD\CampaniasBundle\Form\CampaniaEncuestaTipoPreguntaType;

/**
 * CampaniaEncuestaTipoPregunta controller.
 *
 */
class CampaniaEncuestaTipoPreguntaController extends Controller
{

    /**
     * Lists all CampaniaEncuestaTipoPregunta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampaniasBundle:CampaniaEncuestaTipoPregunta')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, 
                $this->get('request')->query->get('page', 1)/* page number */, 
                10/* limit per page */
        );
        return $this->render('CampaniasBundle:CampaniaEncuestaTipoPregunta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new CampaniaEncuestaTipoPregunta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CampaniaEncuestaTipoPregunta();
        $form = $this->createForm(new CampaniaEncuestaTipoPreguntaType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'CampaniaEncuestaTipoPregunta Creado correctamente.'
            );
            
            return $this->redirect($this->generateUrl('tipo_pregunta_edit', array('id' => $entity->getId())));
        }

        return $this->render('CampaniasBundle:CampaniaEncuestaTipoPregunta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CampaniaEncuestaTipoPregunta entity.
     *
     * @param CampaniaEncuestaTipoPregunta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CampaniaEncuestaTipoPregunta $entity)
    {
        $form = $this->createForm(new CampaniaEncuestaTipoPreguntaType(), $entity, array(
            'action' => $this->generateUrl('tipo_pregunta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CampaniaEncuestaTipoPregunta entity.
     *
     */
    public function newAction()
    {
        $entity = new CampaniaEncuestaTipoPregunta();        
        $form   = $this->createForm(new CampaniaEncuestaTipoPreguntaType(), $entity);

        return $this->render('CampaniasBundle:CampaniaEncuestaTipoPregunta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CampaniaEncuestaTipoPregunta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:CampaniaEncuestaTipoPregunta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampaniaEncuestaTipoPregunta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CampaniasBundle:CampaniaEncuestaTipoPregunta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CampaniaEncuestaTipoPregunta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:CampaniaEncuestaTipoPregunta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampaniaEncuestaTipoPregunta entity.');
        }
        
        $editForm = $this->createForm(new CampaniaEncuestaTipoPreguntaType(), $entity);
        

        return $this->render('CampaniasBundle:CampaniaEncuestaTipoPregunta:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a CampaniaEncuestaTipoPregunta entity.
    *
    * @param CampaniaEncuestaTipoPregunta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CampaniaEncuestaTipoPregunta $entity)
    {
        $form = $this->createForm(new CampaniaEncuestaTipoPreguntaType(), $entity, array(
            'action' => $this->generateUrl('tipo_pregunta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CampaniaEncuestaTipoPregunta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:CampaniaEncuestaTipoPregunta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampaniaEncuestaTipoPregunta entity.');
        }

        
        $editForm =  $this->createForm(new CampaniaEncuestaTipoPreguntaType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'CampaniaEncuestaTipoPregunta Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('tipo_pregunta_edit', array('id' => $id)));
        }

        return $this->render('CampaniasBundle:CampaniaEncuestaTipoPregunta:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }
    /**
     * Deletes a CampaniaEncuestaTipoPregunta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampaniasBundle:CampaniaEncuestaTipoPregunta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CampaniaEncuestaTipoPregunta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipo_pregunta'));
    }

    /**
     * Creates a form to delete a CampaniaEncuestaTipoPregunta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipo_pregunta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
