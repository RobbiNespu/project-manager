<?php

namespace ProjectManager\Projects\Model;

use Doctrine\ORM\Mapping as ORM;
use SIOFramework\Common\Model\Model;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Product
 * @package ProjectManager\Projects\Model
 *
 * @ORM\Entity
 * @ORM\Table(name="pm_product")
 */
class Product extends Model{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @ORM\Column(type="integer")
     */
    private $estimatedHours;

    /**
     * @ORM\Column(type="boolean")
     */
    private $paid;

    /**
     * @ORM\ManyToOne(targetEntity="ProjectManager\Projects\Model\Project", inversedBy="products")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;
    
    /**
     * @ORM\OneToMany(targetEntity="ProjectManager\Projects\Model\Allocation",
     *      mappedBy="product",
     *      cascade={"persist","remove"})
     * @ORM\OrderBy({"dateWorked" = "DESC"})
     */
    private $allocations;


    public function __construct()
    {
    	$this->allocations = new ArrayCollection();
    }
    
    public function getTotalHoursWorked()
    {
    	$total = 0;
    	foreach($this->allocations as $allocation)
    	{
    		$total += $allocation->getValue();
    	}
    	
    	return $total;
    }
    
    
    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getValue()
    {
        return $this->value;
    }
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getEstimatedhours()
    {
        return $this->estimatedHours;
    }
    public function setEstimatedhours($estimatedHours)
    {
        $this->estimatedHours = $estimatedHours;
    }

    /**
     * @return mixed
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * @param mixed $paid
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    }


    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }
    
    /**
     * @return ArrayCollection
     */
	public function getAllocations() {
		return $this->allocations;
	}
	
	/**
	 * @param ArrayCollection $allocations
	 */
	public function setAllocations(ArrayCollection $allocations) {
		$this->allocations = $allocations;
		return $this;
	}
	

    
    


}