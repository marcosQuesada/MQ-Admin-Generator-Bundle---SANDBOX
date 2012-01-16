<?php
namespace Base\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Base\TestBundle\Entity\Attribute;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Base\TestBundle\Repository\AttributeCollectionRepository")
 * @ORM\Table(name="attribute_collection")
 *
 */
class AttributeCollection{
    
   /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * 
     * @ORM\ManyToMany(targetEntity="Attribute")
     * @ORM\JoinTable(name="attribute_collection_attribute",
     *      joinColumns={@ORM\JoinColumn(name="attributeCollection_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="attribute_id", referencedColumnName="id")}
     *      )
     */
    protected $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();

    }
    
    public function __toString()
    {
        return $this->getName();
    }
    


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

    /**
     * Add attributes
     *
     * @param Base\TestBundle\Entity\Attribute $attributes
     */
    public function addAttribute(\Base\TestBundle\Entity\Attribute $attributes)
    {
        $this->attributes[] = $attributes;
    }

    /**
     * Get attributes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    /**
     * Set attributes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }    
}