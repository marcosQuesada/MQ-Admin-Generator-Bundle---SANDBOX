<?php

/*
 * Admin Pool creates ArryCollection of hooked managed entity services
 * EVO 2: Segregates all entity methods to Admin Class
 */
namespace Acme\AdminBundle\Admin;
use Acme\AdminBundle\Grid\GridBuilder;
use Acme\AdminBundle\Form\AdminFormBuilder;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;

class AdminEntity
{
    protected $entity;
    protected $entityClass;
    protected $entityName;
    protected $entityRoutes;
    protected $entityManager;
    protected $entityRepository;
    protected $entityFields;   //#TODO: Unificar Repository&Fields!!!
    protected $entityFieldNames;
    protected $entityReflectionClass;
    //en MtoM FieldNames pierde el atributo .
    //ReflectionClass tiene siempre todos las Reflection de las Entitys
    protected $entityMapperFields;//recibe ReflectionClass + FieldNames
    
    protected $metadataFactory;
    protected $allMetadata;    
    protected $request;
    protected $router;
    protected $baseRoute;
    protected $container;
    protected $entityShowFields;

    public function __construct( $container,
                                 $entityManager, 
                                 $request,
                                 $router)
    {
        $this->entityManager = $entityManager;
        $this->request = $request;
        $this->router = $router;
        $this->container = $container;
        $this->metadataFactory = $this->entityManager->getMetadataFactory();
        $this->allMetadata = $this->entityManager->getMetadataFactory()->getAllMetadata();  
        $route = $this->request->get('_route');

        //Check de seguridad
        //si no implementa el class Route NO debe ser implementado el entity        
        $routeParts = explode('_',$route);
        if (count($routeParts) > 4){
            $this->baseRoute = $this->getBaseRoute($route);

            $this->entityClass = $this->fromRouteToClass($route);        
            $this->entity = $this->getEntityMapperFromClass($this->entityClass);        
            $this->entityRepository =  $this->entityManager->getRepository('\\'.$this->getEntityClass());                   
            $this->entityRoutes = $this->getEntityRoutes();   
            $this->entityFields = $this->getEntityFields(); /// TODO: ! REFACTOR 
            $this->entityReflectionClass = $this->entity->getReflectionProperties();
            $this->entityName = $this->getEntityName();  
            
            $this->entityMapperFields = $this->createEntityFieldMapper();
            $this->entityShowFields = $this->processEntityFields();
        }
        $entityMapperFields = $this->entityMapperFields;
        //ladybug_dump($entityMapperFields);


    }
    
    /**
     * Reordenar array key por array Asociativo
     * @return type 
     */
    public function processEntityFields(){
        $fields = array();
        
        foreach($this->entityFields AS $field){
            $fields[$field['fieldName']] = $field;
        }
        return $fields;
    }
    
    public function createEntityFieldMapper(){
        $fieldNames = $this->processEntityFields();
        foreach($this->entityReflectionClass AS $key=>$field){
            if(isset($fieldNames[$key])){
                $fieldNames[$key]['reflectionClass'] = $field;
            }else{
                $fieldNames[$key] = '';
            }   
        }        
        return $fieldNames;
    }
    
    public function getEntityRepository(){
        return $this->entityRepository;
    }

    public function getEntityManager(){
        return $this->entityManager;
    }

    /**
     *
     * @param string $class
     * @return ClassMetadata from Class
     */
    public function getEntityMapperFromClass($class){
        return $this->metadataFactory->getMetadataFor($class);
    }
    
    /**
     *
     * @param ClassMetadata $mappedEntity
     * @return string EntityName
     */
    public function getEntityName(){

        $array = explode('\\',$this->entity->getName());
        return array_pop($array);
    }

    public function getEntityClass(){
        return $this->entity->getName();
        
    }
    
    public function getEntityBaseRoute(){
        return str_replace("\\", "_", $this->getEntityClass());
    }
    
    public function getEntityRoutes(){
        $routes = array();
        $actions = array('new','show','list','create','edit','delete','update');
        foreach ($actions AS $action){
            
            $routes[$action] = $this->getEntityBaseRoute().'_'.$action;
        }
        return $routes;
    }
        
         
    public function getEntity(){
        $entityClass = "\\".$this->getEntityClass();
                
        return new $entityClass();
    }
    
    
    public function getEntityFieldMapping(){
        return $this->entity->getFieldMapping();
    }    
    
    public function getEntityFields(){
        $fields = array();
        $fieldNames = $this->entity->getFieldNames();
        foreach ($fieldNames AS $field){    
            $fields[] = $this->entity->getFieldMapping($field);
        }        
        
        return $fields;
    }
    
    public function setEntityFromClass($entityClass){
        $this->entity = $this->getEntityMapperFromClass($entityClass);        
        $this->entityRepository =  $this->entityManager->getRepository('\\'.$this->getEntityClass());   
      
    }
    
    public function getRepository(){
        return $this->entityRepository;
    }
    
    public function ObjCollectionToArray($entities){
        $arrayCollection = array();
        foreach($entities AS $entity){
            $arrayCollection[] = $this->ObjToArray($entity);
        }
        return $arrayCollection;
    }
    
    public function ObjToArray($entity){
        $arrayObj = array();
        foreach($this->getEntityFields() AS $field){
            $getter = $this->getterFromField($field);
            $arrayObj[$field['fieldName']] = $entity->$getter();
        }     
        return $arrayObj;        
    }
    
    public function getterFromField($field){
        return 'get'.ucfirst($field['fieldName']);
    }
    
    /**
     * Return Form from FormBuilder
     */
    public function getForm(){
        $fields = $this->entityMapperFields;
        array_shift ( $fields);
        //return new AdminFormBuilder($this->entity->getReflectionProperties());
        return new AdminFormBuilder($fields);
        
    }
    
    /**
     * 
     * 
     */
    public function getGrid(){
        
        return new GridBuilder($this->getEntityFields());
    }   
    

    public function cleanRouteParts($route){
        $parts = explode('_',$route );
        array_pop($parts);
        return $parts    ;    
    }
    public function fromRouteToClass($route){
        return implode('\\' ,$this->cleanRouteParts($route));         
    }
    public function getBaseRoute($route){
        return implode('_' ,$this->cleanRouteParts($route));     
    }
    
        
}