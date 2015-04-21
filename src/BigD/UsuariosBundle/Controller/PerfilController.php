<?php

namespace BigD\UsuariosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BigD\UsuariosBundle\Entity\Perfil;
use BigD\UsuariosBundle\Form\PerfilType;

/**
 * Perfil controller.
 *
 */
class PerfilController extends Controller {

    /**
     * Lists all Perfil entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UsuariosBundle:Perfil')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );
        return $this->render('UsuariosBundle:Perfil:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Perfil entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Perfil();
        $form = $this->createForm(new PerfilType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $permisos = $entity->getPermisos();


            foreach ($permisos as $permisoPerfil) {
                $permisoPerfil->setPerfil($entity);
            }
//            
//            exit;
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Perfil Creado correctamente.'
            );

            return $this->redirect($this->generateUrl('perfiles_edit', array('id' => $entity->getId())));
        }

        return $this->render('UsuariosBundle:Perfil:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Perfil entity.
     *
     * @param Perfil $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Perfil $entity) {
        $form = $this->createForm(new PerfilType(), $entity, array(
            'action' => $this->generateUrl('perfiles_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Perfil entity.
     *
     */
    public function newAction() {
        $entity = new Perfil();
        $form = $this->createForm(new PerfilType(), $entity);

        return $this->render('UsuariosBundle:Perfil:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Perfil entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:Perfil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perfil entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UsuariosBundle:Perfil:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Perfil entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:Perfil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perfil entity.');
        }

        $editForm = $this->createForm(new PerfilType(), $entity);


        return $this->render('UsuariosBundle:Perfil:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Perfil entity.
     *
     * @param Perfil $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Perfil $entity) {
        $form = $this->createForm(new PerfilType(), $entity, array(
            'action' => $this->generateUrl('perfiles_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Perfil entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariosBundle:Perfil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perfil entity.');
        }


        $editForm = $this->createForm(new PerfilType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $permisos = $entity->getPermisos();


            foreach ($permisos as $permisoPerfil) {
                $permisoPerfil->setPerfil($entity);
            }


            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Perfil Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('perfiles_edit', array('id' => $id)));
        }

        return $this->render('UsuariosBundle:Perfil:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Perfil entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UsuariosBundle:Perfil')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Perfil entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('perfiles'));
    }

    /**
     * Creates a form to delete a Perfil entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('perfiles_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
