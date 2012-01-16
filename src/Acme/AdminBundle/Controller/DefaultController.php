<?php

namespace Acme\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\AdminBundle\Form\AdminFormBuilder;

class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        $adminEntity = $this->container->get('acme_admin.admin_entity');
        $adminEntity->setEntityFromClass("Acme\BaseBundle\Entity\Producto");        
        
        ladybug_dump($adminEntity);
        
        $class = "Acme\BaseBundle\Entity\Location";
        $route = str_replace("\\", "_",$class);
        echo $route."<br>";
        
        $part = explode('\\',$class);
        $mapper = $this->container->get('acme_admin.admin_pool');
        ladybug_dump($mapper->getEntityManager()->getRepository('\Acme\BaseBundle\Entity\Location'));
        
        
        $adminPool = $this->container->get('acme_admin.admin_pool');
        $metadatas = $adminPool->getMetadatas();
        $adminPool->setEntityFromClass("Acme\BaseBundle\Entity\AttributeCollection");        
        ladybug_dump($adminPool);
        foreach ($metadatas As $data){
            ladybug_dump($data);
            ladybug_dump($mapper->getEntityFields());
            ladybug_dump($data->getReflectionProperties());
        }        die();
 //       ladybug_dump($mapper->getAllClassEntities());
//        
//        $em = $this->getDoctrine()->getEntityManager();
//        ladybug_dump($em);
////        ladybug_dump($em->getMetadataFactory()->getAllMetadata());
////        
//        $metadataFactory = $em->getMetadataFactory();
//        ladybug_dump($metadataFactory->getMetadataFor("Acme\BaseBundle\Entity\Location"));
//        //$entities = $em->getRepository('SFBCNWebsiteBundle:SFNew')->findAll();
//        
        $adminPool = $this->container->get('acme_admin.admin_pool');
        $adminPool->setEntityFromClass("Acme\BaseBundle\Entity\AttributeCollection");
        $entityName = $adminPool->getEntityName();
        $entityFields = $adminPool->getEntityFields();
        ladybug_dump($entityName);
        ladybug_dump($entityFields);
        foreach ($entityFields AS $field){
            ladybug_dump($field['fieldName']);
        }
        $formType = new AdminFormBuilder($entityFields);
        $entity = new \Acme\BaseBundle\Entity\Location();
        ladybug_dump($entity);
        $newEntity = "\\".$adminPool->getEntityClass();
        $test = new $newEntity();
        ladybug_dump($adminPool->getEntity());
        
        $entityClass = $adminPool->getEntityClass();
        echo "BaseRoute:".$adminPool->getEntityBaseRoute();
        ladybug_dump($adminPool->getEntityBaseRoute());

        $form   = $this->createForm($formType, $entity);        
//        
//        
//        foreach($adminPool->getClassEntities() AS $entityClass){
//            
//            $adminPool->setEntityFromClass($entityClass);
//            $entityName = $adminPool->getEntityName();
//            $entityFields = $adminPool->getEntityFields();
//            ladybug_dump($entityName);
//            ladybug_dump($entityFields);
//            $form = new AdminFormBuilder($entityFields);
//            ladybug_dump($form);
//        }
//        
        
        return $this->render('AcmeAdminBundle:Default:index.html.twig', 
                    array('name' => $name,
                          'form' => $form->createView()
                        )
                );
    }
    
    
    public function extraRouteAction($name)
    {
        
        $container = $this->container->get('admin.pool');
        ladybug_dump($container->getGroups());
        echo "FROM EXTRA";
//        echo "Entity: ".$entity;
        echo "ID:".$name;

        return $this->render('BaseTestBundle:Default:index.html.twig', array('name' => $name));
    }    
}
