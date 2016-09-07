<?php

namespace ProjectManager\Projects\Model;

use Doctrine\ORM\Mapping as ORM;
use SIOFramework\Common\Model\Model;
use SIOFramework\Acl\Model\SystemUser;

/**
 * Class Allocation
 * @package ProjectManager\Projects\Model
 *
 * @ORM\Entity
 * @ORM\Table(name="pm_allocation")
 */
class Allocation extends Model{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $value;
    
    /**
     * @ORM\Column(type="date",name="date_worked") 
     */
    private $dateWorked;

    /**
     * @ORM\ManyToOne(targetEntity="ProjectManager\Projects\Model\Product", inversedBy="allocations")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="SIOFramework\Acl\Model\SystemUser")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}
	
	/**
	 * @return Product
	 */
	public function getProduct() {
		return $this->product;
	}
	
	/**
	 * @param Product $product
	 * @return \ProjectManager\Projects\Model\Allocation
	 */
	public function setProduct(Product $product) {
		$this->product = $product;
		return $this;
	}
	
	/**
	 * @return SystemUser
	 */
	public function getUser() {
		return $this->user;
	}
	
	/**
	 * @param SystemUser $user
	 * @return \ProjectManager\Projects\Model\Allocation
	 */
	public function setUser(SystemUser $user) {
		$this->user = $user;
		return $this;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getDateWorked() {
		return $this->dateWorked;
	}
	
	/**
	 * Format: m/d/Y
	 * 
	 * @param string $dateWorked
	 */
	public function setDateWorked($dateWorked)
	{
		$dateObject = \DateTime::createFromFormat('m/d/Y', $dateWorked);
		
		$this->dateWorked = $dateObject;
		return $this;
	}
	
	
	

}