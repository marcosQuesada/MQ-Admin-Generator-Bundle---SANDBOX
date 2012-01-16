<?php

namespace Acme\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\BaseBundle\Entity\AttributeCollection;
use Acme\BaseBundle\Form\AttributeCollectionType;

/**
 * AttributeCollection controller.
 *
 */
class AttributeCollectionController extends Controller
{
    /**
     * Lists all AttributeCollection entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('AcmeBaseBundle:AttributeCollection')->findAll();

        return $this->render('AcmeBaseBundle:AttributeCollection:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a AttributeCollection entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeBaseBundle:AttributeCollection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AttributeCollection entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeBaseBundle:AttributeCollection:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new AttributeCollection entity.
     *
     */
    public function newAction()
    {
        $entity = new AttributeCollection();
        $form   = $this->createForm(new AttributeCollectionType(), $entity);

        return $this->render('AcmeBaseBundle:AttributeCollection:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new AttributeCollection entity.
     *
     */
    public function createAction()
    {
        $entity  = new AttributeCollection();
        $request = $this->getRequest();
        $form    = $this->createForm(new AttributeCollectionType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attributecollection_show', array('id' => $entity->getId())));
            
        }

        return $this->render('AcmeBaseBundle:AttributeCollection:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing AttributeCollection entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeBaseBundle:AttributeCollection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AttributeCollection entity.');
        }

        $editForm = $this->createForm(new AttributeCollectionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeBaseBundle:AttributeCollection:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing AttributeCollection entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeBaseBundle:AttributeCollection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AttributeCollection entity.');
        }

        $editForm   = $this->createForm(new AttributeCollectionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attributecollection_edit', array('id' => $id)));
        }

        return $this->render('AcmeBaseBundle:AttributeCollection:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AttributeCollection entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('AcmeBaseBundle:AttributeCollection')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AttributeCollection entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('attributecollection'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
