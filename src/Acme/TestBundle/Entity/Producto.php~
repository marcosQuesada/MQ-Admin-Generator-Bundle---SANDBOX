<?php
namespace Base\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Base\TestBundle\Entity\AttributeCollection;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Base\TestBundle\Repository\ProductoRepository")
 * @ORM\Table(name="producto")
 * @ORM\HasLifecycleCallBacks()
 *
 */
class Producto{
    const STATUS_OUTOFSTOCK   = 2;
    const STATUS_ENABLED   = 1;
    const STATUS_DISABLED = 0;
    
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
     * @ORM\Column(type="string", length=100,unique=true, nullable= TRUE)
     * 
     */
    protected $slug;
    
    
     /**
     * @ORM\ManyToOne(targetEntity="AttributeCollection")
     * @ORM\JoinColumn(name="attributecollection_id", referencedColumnName="id")
     */
    protected $type;   

    /**
     * @ORM\Column(type="string", length=100, nullable= TRUE)
     */
    protected $attribute1;
    
    /**
     * @ORM\Column(type="string", length=100, nullable= TRUE)
     */
    protected $attribute2;   
    
    /**
     * @ORM\Column(type="string", length=100, nullable= TRUE)
     */
    protected $attribute3;    
    
    /**
     * @ORM\Column(type="string", length=100, nullable= TRUE)
     */
    protected $attribute4;    
    
    /**
     * @ORM\Column(type="string", length=100, nullable= TRUE)
     */
    protected $attribute5;   
    
    /**
     * @ORM\Column(type="datetime")
     */    
    protected $createdAt;
     
    /**
     * @ORM\Column(type="datetime")
     */     
    protected $updatedAt;
    
    /**
     * @ORM\Column(type="integer")
     */     
    protected $status = self::STATUS_ENABLED;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
        

    }
    
    /**
     * Invoked before the entity is updated.
     *
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
//    
//    /** 
//     * @ORM\PostPersist 
//     */ 
//    public function doOnPostPersist() 
//    { 
//        $this->doExport(); 
//    }     

//    public function preInsert($object)
//    {
//        $object->setCreatedAt(new \DateTime);
//        $object->setUpdatedAt(new \DateTime);
//    }
//    
//    public function preUpdate($object)
//    {
//        $object->setUpdatedAt(new \DateTime);
//    }
    
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
     * Set attribute1
     *
     * @param string $attribute1
     */
    public function setAttribute1($attribute1)
    {
        $this->attribute1 = $attribute1;
    }

    /**
     * Get attribute1
     *
     * @return string 
     */
    public function getAttribute1()
    {
        return $this->attribute1;
    }

    /**
     * Set attribute2
     *
     * @param string $attribute2
     */
    public function setAttribute2($attribute2)
    {
        $this->attribute2 = $attribute2;
    }

    /**
     * Get attribute2
     *
     * @return string 
     */
    public function getAttribute2()
    {
        return $this->attribute2;
    }

    /**
     * Set attribute3
     *
     * @param string $attribute3
     */
    public function setAttribute3($attribute3)
    {
        $this->attribute3 = $attribute3;
    }

    /**
     * Get attribute3
     *
     * @return string 
     */
    public function getAttribute3()
    {
        return $this->attribute3;
    }

    /**
     * Set attribute4
     *
     * @param string $attribute4
     */
    public function setAttribute4($attribute4)
    {
        $this->attribute4 = $attribute4;
    }

    /**
     * Get attribute4
     *
     * @return string 
     */
    public function getAttribute4()
    {
        return $this->attribute4;
    }

    /**
     * Set attribute5
     *
     * @param string $attribute5
     */
    public function setAttribute5($attribute5)
    {
        $this->attribute5 = $attribute5;
    }

    /**
     * Get attribute5
     *
     * @return string 
     */
    public function getAttribute5()
    {
        return $this->attribute5;
    }

    /**
     * Set type
     *
     * @param Base\TestBundle\Entity\AttributeCollection $type
     */
    public function setType(\Base\TestBundle\Entity\AttributeCollection $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return Base\TestBundle\Entity\AttributeCollection 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        //$slug = $this->getName();
        $this->slug = $this->slugify($slug);
       // $this->slug = $slug;
    }
    
    public function slugify($text)
    {

        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);

        // trim and lowercase
        $text = strtolower(trim($text, '-'));

        return $text;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    public static function getStatusList()
    {
        return array(
            self::STATUS_OUTOFSTOCK => 'Out of Stock',
            self::STATUS_DISABLED => 'Disabled',
            self::STATUS_ENABLED   => 'Enabled',
        );
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    
//    public static function loadValidatorMetadata(ClassMetadata $metadata)
//    {
//        $metadata->addPropertyConstraint('user', new NotBlank(array(
//            'message' => 'You must enter your name'
//        )));
//        $metadata->addPropertyConstraint('comment', new NotBlank(array(
//            'message' => 'You must enter a comment'
//        )));
//    }
}