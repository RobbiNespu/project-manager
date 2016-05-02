<?php

namespace ProjectManager\Projects\Model;

use Doctrine\ORM\Mapping as ORM;
use SIOFramework\Common\Model\Model;

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
     * @ORM\ManyToOne(targetEntity="ProjectManager\Projects\Model\Project", inversedBy="products")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;


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



}