<?php

namespace Acme\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Acme\AdminBundle\Form\AdminFormBuilder;

class CoreController extends Controller
{
    
    public function dashboardAction()
    {
        $entityNames = $this->getEntitys();
        return $this->render('AcmeAdminBundle:Core:index.html.twig', 
                array(  'name' => 'OnDashboard',
                        'mappedEntitiesName' => $entityNames));
    }
    
    public function sidebarAction(){
        $entityNames = $this->getEntitys();
        return $this->render('AcmeAdminBundle:Core:sidebar.html.twig', 
                array( 'mappedEntitiesName' => $entityNames));
    }
    
    public function getEntitys(){
        $entityNames = array();
        $adminPool = $this->container->get('acme_admin.admin_pool');
        foreach($adminPool->getClassEntities() AS $entityClass){      
            
            $classParts = explode("\\",$entityClass);
            $entity['route'] = implode('_',$classParts)."_list";
            $entity['name'] = array_pop($classParts);
            
            $entityNames[] = $entity;
        }
        return $entityNames;
    }
    
}    