<?php

namespace Acme\AdminBundle\EventListener;
 
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
 
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController;

class MyEntityLoaderListener
{

    protected $container;
 
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
     public function onKernelController( $event)
     {
//           $controller = $event->getController();
//           if (!is_array($controller)) {
//                // not a object but a different kind of callable. Do nothing
//                return;
//            }
//
//            $controllerObject = $controller[0];
//            if ($controllerObject instanceof InitializableControllerInterface) {
//                   $controllerObject->initialize($event->getRequest());
//                   // this method is the one that is part of the interface.
//            }
//            
//            $controllerObject->configure();
     }
     
    public function onCoreController(FilterControllerEvent $event) {
            $route = $event->getRequest()->get('_route');

            $entityClass = $this->fromRouteToClass($route);
            
            $adminPool = $this->container->get('acme_admin.admin_pool');
            //$adminPool->setEntityFromClass($entityClass);
            $controllers = $event->getController();
            $controller = $controllers[0];
            
    }     
    
    public function cleanRouteParts($route){
        $parts = explode('_',$route );
        array_pop($parts);
        return $parts    ;    
    }

    public function fromRouteToClass($route){
        return implode('\\' ,$this->cleanRouteParts($route));         
    }
        
}
?>