<?php

namespace BigD\PersonasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BigD\PersonasBundle\Entity\PersonaEtiqueta;
use BigD\PersonasBundle\Form\PersonaEtiquetaType;

/**
 * PersonaEtiqueta controller.
 *
 * @Route("/persona_etiqueta")
 */
class PersonaEtiquetaController extends Controller
{

    /**
     * Lists all PersonaEtiqueta entities.
     *
     * @Route("/", name="persona_etiqueta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PersonasBundle:PersonaEtiqueta')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PersonaEtiqueta entity.
     *
     * @Route("/", name="persona_etiqueta_create")
     * @Method("POST")
     * @Template("PersonasBundle:PersonaEtiqueta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PersonaEtiqueta();
        $form = $this->createForm(new PersonaEtiquetaType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'PersonaEtiqueta Creado correctamente.'
            );
            
            return $this->redirect($this->generateUrl('persona_etiqueta_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PersonaEtiqueta entity.
     *
     * @param PersonaEtiqueta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PersonaEtiqueta $entity)
    {
        $form = $this->createForm(new PersonaEtiquetaType(), $entity, array(
            'action' => $this->generateUrl('persona_etiqueta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PersonaEtiqueta entity.
     *
     * @Route("/new", name="persona_etiqueta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PersonaEtiqueta();        
        $form   = $this->createForm(new PersonaEtiquetaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PersonaEtiqueta entity.
     *
     * @Route("/{id}", name="persona_etiqueta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PersonasBundle:PersonaEtiqueta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PersonaEtiqueta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PersonaEtiqueta entity.
     *
     * @Route("/{id}/edit", name="persona_etiqueta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PersonasBundle:PersonaEtiqueta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PersonaEtiqueta entity.');
        }
        
        $editForm = $this->createForm(new PersonaEtiquetaType(), $entity);
        

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        );
    }

    /**
    * Creates a form to edit a PersonaEtiqueta entity.
    *
    * @param PersonaEtiqueta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PersonaEtiqueta $entity)
    {
        $form = $this->createForm(new PersonaEtiquetaType(), $entity, array(
            'action' => $this->generateUrl('persona_etiqueta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PersonaEtiqueta entity.
     *
     * @Route("/{id}", name="persona_etiqueta_update")
     * @Method("PUT")
     * @Template("PersonasBundle:PersonaEtiqueta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PersonasBundle:PersonaEtiqueta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PersonaEtiqueta entity.');
        }

        
        $editForm =  $this->createForm(new PersonaEtiquetaType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'PersonaEtiqueta Actualizado correctamente.'
            );

            return $this->redirect($this->generateUrl('persona_etiqueta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        );
    }
    /**
     * Deletes a PersonaEtiqueta entity.
     *
     * @Route("/{id}", name="persona_etiqueta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PersonasBundle:PersonaEtiqueta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PersonaEtiqueta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('persona_etiqueta'));
    }

    /**
     * Creates a form to delete a PersonaEtiqueta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('persona_etiqueta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
