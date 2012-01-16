<?php

namespace Acme\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\BaseBundle\Entity\Attribute;
use Acme\BaseBundle\Form\AttributeType;

/**
 * Attribute controller.
 *
 */
class AttributeController extends Controller
{
    /**
     * Lists all Attribute entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('AcmeBaseBundle:Attribute')->findAll();

        return $this->render('AcmeBaseBundle:Attribute:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Attribute entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeBaseBundle:Attribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attribute entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeBaseBundle:Attribute:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Attribute entity.
     *
     */
    public function newAction()
    {
        $entity = new Attribute();
        $form   = $this->createForm(new AttributeType(), $entity);

        return $this->render('AcmeBaseBundle:Attribute:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Attribute entity.
     *
     */
    public function createAction()
    {
        $entity  = new Attribute();
        $request = $this->getRequest();
        $form    = $this->createForm(new AttributeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attribute_show', array('id' => $entity->getId())));
            
        }

        return $this->render('AcmeBaseBundle:Attribute:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Attribute entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeBaseBundle:Attribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attribute entity.');
        }

        $editForm = $this->createForm(new AttributeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeBaseBundle:Attribute:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Attribute entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeBaseBundle:Attribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attribute entity.');
        }

        $editForm   = $this->createForm(new AttributeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attribute_edit', array('id' => $id)));
        }

        return $this->render('AcmeBaseBundle:Attribute:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Attribute entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('AcmeBaseBundle:Attribute')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Attribute entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('attribute'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
