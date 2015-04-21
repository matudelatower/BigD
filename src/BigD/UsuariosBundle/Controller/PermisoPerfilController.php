<?php

namespace BigD\UsuariosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BigD\UsuariosBundle\Entity\PermisoPerfil;
use BigD\UsuariosBundle\Form\PermisoPerfilType;

/**
 * PermisoPerfil controller.
 *
 */
class PermisoPerfilController extends Controller {

    /**
     * Lists all PermisoPerfil entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UsuariosBundle:PermisoPerfil')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );
        return $this->render('UsuariosBundle:PermisoPerfil:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new PermisoPerfil entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new PermisoPerfil();
        $form = $this->createForm(new PermisoPerfilType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Permiso Perfil Creado correctamente.'
            );

            return $this->redirect($this->generateUrl('permisos_perfil_edit', array('id' => $entity->getId())));
        }

        return $this->render('UsuariosBundle:PermisoPerfil:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PermisoPerfil entity.
     *
     * @param PermisoPerfil $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PermisoPerfil $entity) {
        $form = $this->createForm(new PermisoPerfilType(), $entity, array(
            'action' => $this->generateUrl('permisos_perfil_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PermisoPerfil entity.
     *
     */
    public function newAction() {
        $entity = new PermisoPerfil();
        $form = $this->createForm(new PermisoPerfilType(), $entity);

        return $this->render('UsuariosBundle:PermisoPerfil:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PermisoPerfil entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:PermisoPerfil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PermisoPerfil entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UsuariosBundle:PermisoPerfil:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PermisoPerfil entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:PermisoPerfil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PermisoPerfil entity.');
        }

        $editForm = $this->createForm(new PermisoPerfilType(), $entity);


        return $this->render('UsuariosBundle:PermisoPerfil:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a PermisoPerfil entity.
     *
     * @param PermisoPerfil $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PermisoPerfil $entity) {
        $form = $this->createForm(new PermisoPerfilType(), $entity, array(
            'action' => $this->generateUrl('permisos_perfil_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing PermisoPerfil entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:PermisoPerfil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PermisoPerfil entity.');
        }


        $editForm = $this->createForm(new PermisoPerfilType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'PermisoPerfil Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('permisos_perfil_edit', array('id' => $id)));
        }

        return $this->render('UsuariosBundle:PermisoPerfil:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a PermisoPerfil entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UsuariosBundle:PermisoPerfil')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PermisoPerfil entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('permisos_perfil'));
    }

    /**
     * Creates a form to delete a PermisoPerfil entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('permisos_perfil_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
