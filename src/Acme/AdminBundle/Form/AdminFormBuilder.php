<?php

Namespace Acme\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AdminFormBuilder extends AbstractType
{    
    protected $fields;

    /**
     * Receive array Form fields from Adapter
     * @param type $fields 
     */
    public function __construct($fields){

        $this->fields = $fields;
    }
    
    /**
     * Form builder, dinamically add entity fields from entity 
     * Metadata 
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        //adapter from reflection Class
        foreach ($this->fields AS $key=>$field){
            $builder->add($key); 
//            if ($field['type'] === 'datetime'){
//                //$builder->add($key,'date');
//            }else{
//                $builder->add($key); 
//            }
        }     

        // SI es DateTime:  ->add('start_date','date')
        // 
        //adapter from getFieldNames
//        foreach ($this->fields AS $field){
//                if ($field['fieldName'] != 'id'){
//                    $builder->add($field['fieldName']);                    
//                }
//        }        
        
    }

    public function getName()
    {
        return 'acme_adminbundle_entityform';
    }
    
    
}