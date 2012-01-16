<?php

namespace Acme\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        $adminLocation = $this->container->get('acme_admin.admin_pool');
        
        ladybug_dump($adminLocation);
        
        
        return $this->render('AcmeBaseBundle:Default:index.html.twig', array('name' => $name));
    }
}
