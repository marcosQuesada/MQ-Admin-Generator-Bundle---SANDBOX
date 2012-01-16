<?php

/*
 * Based on Admin Sonata Class
 * EVO 2: Service implements all entity methods
 */

namespace Acme\AdminBundle\Admin;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Acl\Model\DomainObjectInterface;

abstract class Admin     
{

    protected $class;

    public function __construct($class)
    {        
        $this->class  = $class;    
    }
    
    
    public function getClass(){

        return $this->class;
        
    }

}
