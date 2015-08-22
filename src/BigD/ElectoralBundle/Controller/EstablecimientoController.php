<?php

namespace BigD\ElectoralBundle\Controller;

use BigD\ElectoralBundle\Form\Type\Filter\EstablecimientoFilterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BigD\ElectoralBundle\Entity\Establecimiento;
use BigD\ElectoralBundle\Form\Type\EstablecimientoType;


/**
 * Establecimiento controller.
 *
 */
class EstablecimientoController extends Controller
{

    /**
     * Lists all Establecimiento entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new EstablecimientoFilterType());

        if ($request->isMethod("post")) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $entities = $em->getRepository('ElectoralBundle:Establecimiento')->getAcEstablecimientos($data);
            }
        } else {
            $entities = $em->getRepository('ElectoralBundle:Establecimiento')->getAcEstablecimientos();
        }


        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1)/* page number */,
            10/* limit per page */
        );

        return $this->render(
            'ElectoralBundle:Establecimiento:index.html.twig',
            array(
                'entities' => $entities,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Creates a new Establecimiento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Establecimiento();
        $form = $this->createForm(new EstablecimientoType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Establecimiento Creado correctamente.'
            );

            return $this->redirect($this->generateUrl('establecimientos_edit', array('id' => $entity->getId())));
        }

        return $this->render(
            'ElectoralBundle:Establecimiento:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a Establecimiento entity.
     *
     * @param Establecimiento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Establecimiento $entity)
    {
        $form = $this->createForm(
            new EstablecimientoType(),
            $entity,
            array(
                'action' => $this->generateUrl('establecimientos_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Establecimiento entity.
     *
     */
    public function newAction()
    {
        $entity = new Establecimiento();
        $form = $this->createForm(new EstablecimientoType(), $entity);

        return $this->render(
            'ElectoralBundle:Establecimiento:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a Establecimiento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElectoralBundle:Establecimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Establecimiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ElectoralBundle:Establecimiento:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing Establecimiento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElectoralBundle:Establecimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Establecimiento entity.');
        }

        $editForm = $this->createForm(new EstablecimientoType(), $entity);


        return $this->render(
            'ElectoralBundle:Establecimiento:edit.html.twig',
            array(
                'entity' => $entity,
                'form' => $editForm->createView(),

            )
        );
    }

    /**
     * Creates a form to edit a Establecimiento entity.
     *
     * @param Establecimiento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Establecimiento $entity)
    {
        $form = $this->createForm(
            new EstablecimientoType(),
            $entity,
            array(
                'action' => $this->generateUrl('establecimientos_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Establecimiento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ElectoralBundle:Establecimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Establecimiento entity.');
        }


        $editForm = $this->createForm(new EstablecimientoType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Establecimiento Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('establecimientos_edit', array('id' => $id)));
        }

        return $this->render(
            'ElectoralBundle:Establecimiento:edit.html.twig',
            array(
                'entity' => $entity,
                'form' => $editForm->createView(),

            )
        );
    }

    /**
     * Deletes a Establecimiento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ElectoralBundle:Establecimiento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Establecimiento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('establecimientos'));
    }

    /**
     * Creates a form to delete a Establecimiento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('establecimientos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    public function showReporteDireccionesAction(Request $request)
    {
        $idEstablecimientos = $request->get('establecimientos');

        $em = $this->getDoctrine()->getManager();

        $json = array();
        if ($idEstablecimientos) {
            foreach ($idEstablecimientos as $id) {

                $entity = $em->getRepository('ElectoralBundle:Establecimiento')->find($id);

                if (!$entity) {
                    throw $this->createNotFoundException('No se encuentra el establecimiento.');
                }
                $parametro = array(
                    "nombre" => $entity->getDescripcion(),

                );
                $parametro['direccion'] = $entity->getDireccion();
                $parametro['ciudad'] = $entity->getLocalidad()->getDescripcion();
                $parametro['provincia'] = $entity->getLocalidad()->getDepartamento()->getProvincia()->getDescripcion();
                $parametro['pais'] = $entity->getLocalidad()->getDepartamento()->getProvincia()->getPais(
                )->getDescripcion();

                $json[] = $parametro;
            }
        }

        return $this->render(
            'ElectoralBundle:Establecimiento:showReporteDirecciones.html.twig',
            array(
                'arrayEstablecimientos' => json_encode($json)
            )
        );
    }
}
