<?php

namespace BigD\PersonasBundle\Controller;

use BigD\PersonasBundle\Entity\Persona;
use BigD\PersonasBundle\Form\PersonaFilterType;
use BigD\PersonasBundle\Form\PersonaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Persona controller.
 *
 */
class PersonaController extends Controller {

    /**
     * Lists all Persona entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(new PersonaFilterType());

        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $entities = $em->getRepository('PersonasBundle:Persona')->getAcPersonas($data);
            }
        } else {
            $entities = $em->getRepository('PersonasBundle:Persona')->getAcPersonas();
        }


        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $entities, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('PersonasBundle:Persona:index.html.twig', array(
                    'entities' => $entities,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Persona entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Persona();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Persona Creada correctamente.'
            );

            return $this->redirect($this->generateUrl('persona_show', array('id' => $entity->getId())));
        }

        return $this->render('PersonasBundle:Persona:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Persona entity.
     *
     * @param Persona $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Persona $entity) {
        $form = $this->createForm(new PersonaType(), $entity);

        return $form;
    }

    /**
     * Displays a form to create a new Persona entity.
     *
     */
    public function newAction() {
        $entity = new Persona();
        $form = $this->createCreateForm($entity);

        return $this->render('PersonasBundle:Persona:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Persona entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PersonasBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }
        $parametro = array(
            "nombre" => $entity->getNombre(),
            "apellido" => $entity->getApellido(),
        );
        foreach ($entity->getDomicilio() as $domicilio) {
            if ($domicilio->getPrincipal()) {
                $parametro['calle'] = $domicilio->getCalle();
                $parametro['numero'] = $domicilio->getNumero();
                $parametro['ciudad'] = $domicilio->getLocalidad()->getDescripcion();
                $parametro['provincia'] = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getDescripcion();
                $parametro['pais'] = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getPais()->getDescripcion();
            }
        }

        return $this->render('PersonasBundle:Persona:show.html.twig', array(
                    'entity' => $entity,
                    'parametro' => $parametro
        ));
    }

    /**
     * Displays a form to edit an existing Persona entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PersonasBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $editForm = $this->createEditForm($entity);


        return $this->render('PersonasBundle:Persona:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Persona entity.
     *
     * @param Persona $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Persona $entity) {
        $form = $this->createForm(new PersonaType(), $entity);

        return $form;
    }

    /**
     * Edits an existing Persona entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PersonasBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Persona Actualizada correctamente.'
            );

            return $this->redirect($this->generateUrl('persona_edit', array('id' => $id)));
        }

        return $this->render('PersonasBundle:Persona:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Persona entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PersonasBundle:Persona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Persona entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('persona'));
    }

    /**
     * Creates a form to delete a Persona entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('persona_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    public function showReporteDireccionesAction(Request $request) {


        $idPersonas = $request->get('personas');

        $em = $this->getDoctrine()->getManager();

        $json = array();

        foreach ($idPersonas as $id) {

            $entity = $em->getRepository('PersonasBundle:Persona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Persona entity.');
            }
            $parametro = array(
                "nombre" => $entity->getNombre(),
                "apellido" => $entity->getApellido(),
            );
            foreach ($entity->getDomicilio() as $domicilio) {
                if ($domicilio->getPrincipal()) {
                    $parametro['calle'] = $domicilio->getCalle();
                    $parametro['numero'] = $domicilio->getNumero();
                    $parametro['ciudad'] = $domicilio->getLocalidad()->getDescripcion();
                    $parametro['provincia'] = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getDescripcion();
                    $parametro['pais'] = $domicilio->getLocalidad()->getDepartamento()->getProvincia()->getPais()->getDescripcion();
                }
            }
            $json[] = $parametro;
        }

        return $this->render('PersonasBundle:Persona:showReporteDirecciones.html.twig', array(                    
                    'arrayPersonas' => json_encode($json)
        ));
    }

}
