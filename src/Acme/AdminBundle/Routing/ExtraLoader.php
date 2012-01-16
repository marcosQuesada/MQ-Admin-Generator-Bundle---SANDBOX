<?php

namespace Acme\AdminBundle\Routing;
 
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;
 
class ExtraLoader implements LoaderInterface
{
    private $loaded = false;
    protected $container;


    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function load($resource, $type = null)
    {
        $actions = array('new','show','list','create','edit','delete','update');
        
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add this loader twice');
        }
        
        $adminPool = $this->container->get('acme_admin.admin_pool');
       
        $routes = new RouteCollection();        
        //Add Dashboard
        $route = new Route('dashboard', array( 
                    '_controller' => 'AcmeAdminBundle:Core:dashboard')
                );
        $routes->add('admin_dashboard', $route); 
        
        foreach ($adminPool->getClassEntities() AS $entityClass){
            $adminPool->setEntityFromClass($entityClass);
           
            foreach ($actions AS $action){   
                $entityName = strtolower($adminPool->getEntityName());
                $pattern = (($action === 'list')|($action === 'new')|($action === 'create'))? 
                            $entityName."/".$action : $entityName."/".$action."/{id}";
                $defaults = array(
                    '_controller' => 'AcmeAdminBundle:CRUD:'.$action,
                );
                $route = new Route($pattern, $defaults);
                $ruta = $adminPool->getEntityBaseRoute().'_'.$action;
                $routes->add($ruta, $route);                
            }
        }

        return $routes;
    }
 
    public function supports($resource, $type = null)
    {
        return 'extra' === $type;
    }
 
    public function getResolver()
    {
    }
 
    public function setResolver(LoaderResolver $resolver)
    {
        // irrelevant to us, since we don't need a resolver
    }
}