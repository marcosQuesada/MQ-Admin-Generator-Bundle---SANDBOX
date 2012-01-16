<?php

namespace Acme\TestBundle\Routing;
 
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
        $actions = array('show','list','create','edit','delete');
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add this loader twice');
        }
        
        //$sonataServiceAdminPool = $this->container->get('sonata.admin.pool');
        //$groups = $sonataServiceAdminPool->getDashboardGroups();
        $routes = new RouteCollection();
        
        //foreach ($groups AS $key=>$group){
            foreach ($actions AS $action){
                
                //$pattern = $key."/".$action."/{name}";7
                $pattern = "/".$action."/{name}";
                $defaults = array(
                    '_controller' => 'AcmeTestBundle:Default:extraRoute',
                );

                $route = new Route($pattern, $defaults);
                //$ruta = 'extraRoute_'.$key.'_'.$action;
                $ruta = 'extraRoute_'.$action;
                $routes->add($ruta, $route);
                
            }
       // }

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