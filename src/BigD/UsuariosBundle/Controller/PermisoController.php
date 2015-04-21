<?php

namespace BigD\UsuariosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BigD\UsuariosBundle\Entity\Permiso;
use BigD\UsuariosBundle\Form\PermisoType;

/**
 * Permiso controller.
 *
 */
class PermisoController extends Controller
{

    /**
     * Lists all Permiso entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UsuariosBundle:Permiso')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, 
                $this->get('request')->query->get('page', 1)/* page number */, 
                10/* limit per page */
        );
        return $this->render('UsuariosBundle:Permiso:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Permiso entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Permiso();
        $form = $this->createForm(new PermisoType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Permiso Creado correctamente.'
            );
            
            return $this->redirect($this->generateUrl('permisos_edit', array('id' => $entity->getId())));
        }

        return $this->render('UsuariosBundle:Permiso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Permiso entity.
     *
     * @param Permiso $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Permiso $entity)
    {
        $form = $this->createForm(new PermisoType(), $entity, array(
            'action' => $this->generateUrl('permisos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Permiso entity.
     *
     */
    public function newAction()
    {
        $entity = new Permiso();        
        $form   = $this->createForm(new PermisoType(), $entity);

        return $this->render('UsuariosBundle:Permiso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Permiso entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:Permiso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Permiso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UsuariosBundle:Permiso:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Permiso entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:Permiso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Permiso entity.');
        }
        
        $editForm = $this->createForm(new PermisoType(), $entity);
        

        return $this->render('UsuariosBundle:Permiso:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }

    /**
    * Creates a form to edit a Permiso entity.
    *
    * @param Permiso $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Permiso $entity)
    {
        $form = $this->createForm(new PermisoType(), $entity, array(
            'action' => $this->generateUrl('permisos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Permiso entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:Permiso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Permiso entity.');
        }

        
        $editForm =  $this->createForm(new PermisoType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Permiso Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('permisos_edit', array('id' => $id)));
        }

        return $this->render('UsuariosBundle:Permiso:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
    }
    /**
     * Deletes a Permiso entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UsuariosBundle:Permiso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Permiso entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('permisos'));
    }

    /**
     * Creates a form to delete a Permiso entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('permisos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
