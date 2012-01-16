<?php

namespace Acme\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CRUDController extends Controller
{

    public function listAction()
    {
        $adminEntity =  $this->container->get('acme_admin.admin_entity');

        $entities = $adminEntity->getEntityRepository()->findAll();
 
        return $this->render('AcmeAdminBundle:CRUD:index.html.twig', array(
            'entityName' => $adminEntity->getEntityName(),
            'entities' => $entities,
            'entityRoutes' => $adminEntity->getEntityRoutes(),
            'entityFields' => $adminEntity->getEntityFields()
        ));

    }


    /**
     * Finds and displays a Test entity.
     *
     */
    public function showAction($id)
    {
        $adminEntity =  $this->container->get('acme_admin.admin_entity');

        $entity = $adminEntity->getEntityRepository()->find($id);
 
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('AcmeAdminBundle:CRUD:show.html.twig', array(
            'entityName' => $adminEntity->getEntityName(),
            'entity' => $entity,
            'entityRoutes' => $adminEntity->getEntityRoutes(),
            'entityFields' => $adminEntity->processEntityFields(),
            'id' => $id,
            'delete_form' => $deleteForm->createView(),
        ));        
    }

    /**
     * Displays a form to create a new Test entity.
     *
     */
    public function newAction()
    {
      //  $this->configure();
        $adminEntity =  $this->container->get('acme_admin.admin_entity');        
        $entity = $adminEntity->getEntity();
        $formType = $adminEntity->getForm();
        $form   = $this->createForm($formType, $entity);         

        return $this->render('AcmeAdminBundle:CRUD:new.html.twig', array(
            'entityName' => $adminEntity->getEntityName(),
            'entity' => $entity,
            'entityRoutes' => $adminEntity->getEntityRoutes(),
            'entityFields' => $adminEntity->getEntityFields(),
            'form'   => $form->createView()
        ));

    }

    /**
     * Creates a new Test entity.
     *
     */
    public function createAction()
    {
       // $this->configure();
        
        $request = $this->getRequest();
        $adminEntity =  $this->container->get('acme_admin.admin_entity');        
        $entity = $adminEntity->getEntity();
        $formType = $adminEntity->getForm();
        $form   = $this->createForm($formType, $entity);         
        $form->bindRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            $routes = $adminEntity->getEntityRoutes();
            return $this->redirect($this->generateUrl($routes['show'], array('id' => $entity->getId())));
            
        }        
        
        return $this->render('AcmeAdminBundle:CRUD:new.html.twig', array(
            'entityName' => $adminEntity->getEntityName(),
            'entity' => $entity,
            'entityRoutes' => $adminEntity->getEntityRoutes(),
            'entityFields' => $adminEntity->getEntityFields(),
            'form'   => $form->createView()
        ));        
    
    }

    /**
     * Displays a form to edit an existing Test entity.
     *
     */
    public function editAction($id)
    {

       // $this->configure();
        $adminEntity =  $this->container->get('acme_admin.admin_entity');    
        $entity = $adminEntity->getEntityRepository()->find($id);
 
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        $formType = $adminEntity->getForm();
        $form   = $this->createForm($formType, $entity);         
        $deleteForm = $this->createDeleteForm($id);
      
        return $this->render('AcmeAdminBundle:CRUD:edit.html.twig', array(
            'entityName' => $adminEntity->getEntityName(),
            'entity' => $entity,
            'entityRoutes' => $adminEntity->getEntityRoutes(),
            'entityFields' => $adminEntity->getEntityFields(),
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),                
        ));          
    }

    /**
     * Edits an existing Test entity.
     *
     */
    public function updateAction($id)
    {
        //$this->configure();
        
        $request = $this->getRequest();
        $adminEntity =  $this->container->get('acme_admin.admin_entity');    
        $entity = $adminEntity->getEntityRepository()->find($id);
        
        $formType = $adminEntity->getForm();
        $deleteForm = $this->createDeleteForm($id);
        
        $form   = $this->createForm($formType, $entity);         
        $form->bindRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            $routes = $adminEntity->getEntityRoutes();
            return $this->redirect($this->generateUrl($routes['list'], array('id' => $entity->getId())));            
        }          

        return $this->render('AcmeAdminBundle:CRUD:edit.html.twig', array(
            'entityName' => $adminEntity->getEntityName(),
            'entity' => $entity,
            'entityRoutes' => $adminEntity->getEntityRoutes(),
            'entityFields' => $adminEntity->getEntityFields(),
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),                
        ));         
    }

    /**
     * Deletes a Test entity.
     *
     */
    public function deleteAction($id)
    {   
       // $this->configure();
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $adminEntity =  $this->container->get('acme_admin.admin_entity');    
            $entity = $adminEntity->getEntityRepository()->find($id);
   
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Test entity.');
            }
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($entity);
            $em->flush();
        }
        $routes = $adminEntity->getEntityRoutes();
        return $this->redirect($this->generateUrl($routes['list']));

    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }    
}
