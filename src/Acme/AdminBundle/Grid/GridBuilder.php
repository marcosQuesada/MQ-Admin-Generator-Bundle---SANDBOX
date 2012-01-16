<?php

Namespace Acme\AdminBundle\Grid;

Class GridBuilder{
    
    protected $entityFields;
    
    public function __construct($entityFields,$entity){
        
        $this->entityFields = $entityFields;
        $this->entity = $entity;
        
    }
    
    public function getGrid(){
        
        $html = '';
        foreach ($this->entityFields As $field){
            $html.='<td>'.$field.'</td>';
        }
        
        return $html;
        
    }
    
}