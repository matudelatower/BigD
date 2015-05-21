<?php

namespace BigD\CampaniasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BigD\CampaniasBundle\Entity\CampaniaEncuestaOpcionesRespuesta;
use BigD\CampaniasBundle\Form\CampaniaEncuestaOpcionesRespuestaType;

/**
 * CampaniaEncuestaOpcionesRespuesta controller.
 *
 */
class CampaniaEncuestaOpcionesRespuestaController extends Controller
{

    /**
     * Lists all CampaniaEncuestaOpcionesRespuesta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, 
                $this->get('request')->query->get('page', 1)/* page number */, 
                10/* limit per page */
        );
        return $this->render('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new CampaniaEncuestaOpcionesRespuesta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CampaniaEncuestaOpcionesRespuesta();
        $form = $this->createForm(new CampaniaEncuestaOpcionesRespuestaType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'CampaniaEncuestaOpcionesRespuesta Creado correctamente.'
            );
            
            return $this->redirect($this->generateUrl('opciones_respuestas_edit', array('id' => $entity->getId())));
        }

        return $this->render('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CampaniaEncuestaOpcionesRespuesta entity.
     *
     * @param CampaniaEncuestaOpcionesRespuesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CampaniaEncuestaOpcionesRespuesta $entity)
    {
        $form = $this->createForm(new CampaniaEncuestaOpcionesRespuestaType(), $entity, array(
            'action' => $this->generateUrl('opciones_respuestas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CampaniaEncuestaOpcionesRespuesta entity.
     *
     */
    public function newAction()
    {
        $entity = new CampaniaEncuestaOpcionesRespuesta();        
        $form   = $this->createForm(new CampaniaEncuestaOpcionesRespuestaType(), $entity);

        return $this->render('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CampaniaEncuestaOpcionesRespuesta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampaniaEncuestaOpcionesRespuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CampaniaEncuestaOpcionesRespuesta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampaniaEncuestaOpcionesRespuesta entity.');
        }
        
        $editForm = $this->createForm(new CampaniaEncuestaOpcionesRespuestaType(), $entity);
        

        return $this->render('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a CampaniaEncuestaOpcionesRespuesta entity.
    *
    * @param CampaniaEncuestaOpcionesRespuesta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CampaniaEncuestaOpcionesRespuesta $entity)
    {
        $form = $this->createForm(new CampaniaEncuestaOpcionesRespuestaType(), $entity, array(
            'action' => $this->generateUrl('opciones_respuestas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CampaniaEncuestaOpcionesRespuesta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampaniaEncuestaOpcionesRespuesta entity.');
        }

        
        $editForm =  $this->createForm(new CampaniaEncuestaOpcionesRespuestaType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'CampaniaEncuestaOpcionesRespuesta Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('opciones_respuestas_edit', array('id' => $id)));
        }

        return $this->render('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }
    /**
     * Deletes a CampaniaEncuestaOpcionesRespuesta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampaniasBundle:CampaniaEncuestaOpcionesRespuesta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CampaniaEncuestaOpcionesRespuesta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('opciones_respuestas'));
    }

    /**
     * Creates a form to delete a CampaniaEncuestaOpcionesRespuesta entity by id.
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
