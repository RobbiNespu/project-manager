<?php

namespace ProjectManager\Customers\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use SIOFramework\Common\Model\Model;

/**
 * Class Customer
 * @package ProjectManager\Customers\Model
 *
 * @ORM\Entity
 * @ORM\Table(name="pm_customer")
 */
class Customer extends Model{

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
    private $nickname;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @ORM\Column(type="string")
     */
    private $state;


    /**
     * @ORM\OneToMany(targetEntity="ProjectManager\Projects\Model\Project",
     *      mappedBy="customer",
     *      cascade={"remove"})
     */
    private $projects;

    /**
     * Customer constructor.
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
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

    public function getNickname()
    {
        return $this->nickname;
    }
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getState()
    {
        return $this->state;
    }
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param mixed $projects
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;
    }


}