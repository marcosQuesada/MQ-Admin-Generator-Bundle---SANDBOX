<?php

namespace Acme\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\AdminBundle\Form\AdminFormBuilder;

class CoreController extends Controller
{
    
    public function dashboardAction()
    {
        $entityNames = array();
        $adminPool = $this->container->get('acme_admin.admin_pool');
        foreach($adminPool->getClassEntities() AS $entityClass){      
            
            $classParts = explode("\\",$entityClass);
            $entity['route'] = implode('_',$classParts)."_list";
            $entity['name'] = array_pop($classParts);
            
            $entityNames[] = $entity;
        }

        return $this->render('AcmeAdminBundle:Core:index.html.twig', 
                array(  'name' => 'OnDashboard',
                        'mappedEntitiesName' => $entityNames));
    }
    
}    