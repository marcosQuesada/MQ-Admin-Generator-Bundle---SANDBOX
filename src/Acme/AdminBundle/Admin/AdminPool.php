<?php

/*
 * Admin Pool creates ArryCollection of hooked managed entity services
 * EVO 2: Segregates all entity methods to Admin Class
 */
namespace Acme\AdminBundle\Admin;
use Acme\AdminBundle\Grid\GridBuilder;
use Acme\AdminBundle\Form\AdminFormBuilder;

class AdminPool
{
    private $services;
    protected $entity;
    protected $entityClass;
    protected $entityName;
    protected $entityRoutes;
    protected $entityManager;
    protected $metadataFactory;
    protected $allMetadata;    
    
    

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->services = array();
        $this->metadataFactory = $this->entityManager->getMetadataFactory();
        $this->allMetadata = $this->entityManager->getMetadataFactory()->getAllMetadata();     
    }

    public function getEntityRepository(){
        return $this->entityRepository;
    }

    public function addTransport(  $services)
    {
        $this->services[] = $services;
    }
    
    public function getEntityManager(){
        return $this->entityManager;
    }
    public function getEntities(){
        return $this->services;
    }
    
    /**
     * Return Entity Class from services
     * hooked on acme_admin.admin_pool
     * @return type array Class Strings
     */
    public function getClassEntities(){
       $classes = array();
       foreach($this->services AS $item){
            $item =$item->getClass();
            $classes[] = $item[0];                   
       }
       
       return $classes;
    }        

    /**
     * All Entities Metadata from EntityManager MetadataFactory
     * @return type array Class Strings
     */    
    public function getAllClassEntities(){
        $names = array();
        
        foreach ($this->allMetadata AS $mapper){
            $names[] = $mapper->getName();
        }        
        return $names;
    }
      
    /**
     *
     * @param string $class
     * @return ClassMetadata from Class
     */
    public function getEntityMapperFromClass($class){
        return $this->metadataFactory->getMetadataFor($class);
    }
    
    public function getMetadatas(){
        return $this->allMetadata;
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

    public function setEntityFromClass($entityClass){
        $this->entity = $this->getEntityMapperFromClass($entityClass);        
    }

}