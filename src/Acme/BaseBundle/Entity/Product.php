<?php

namespace Acme\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\BaseBundle\Entity\Product
 */
class Product
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;
    

    /**
     * @var string $name
     */
    private $test;    


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}