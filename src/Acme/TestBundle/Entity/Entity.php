<?php

namespace Acme\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="entity")
 * @ORM\Entity(repositoryClass="Acme\TestBundle\Repository\EntityRepository") 
 */
class Entity{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */    
    protected $id;
    /**
     * @ORM\Column(type="string", length="7", name="zip_code")
     */
    protected $address;

  
}