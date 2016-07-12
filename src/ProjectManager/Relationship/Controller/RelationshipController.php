<?php

namespace ProjectManager\Relationship\Controller;

use ProjectManager\Customers\Model\Customer;
use ProjectManager\Projects\Model\Product;
use ProjectManager\Projects\Model\Project;
use SIOFramework\Acl\Controller\SecuredController;
use SIOFramework\Common\Factory\StandardFactory;


class RelationshipController extends SecuredController
{
    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('CUSTOMER');
    }

    /**
     * Retrives the Customer
     * @return Customer
     */
    protected function getLoggedCustomer()
    {
        $userId = $this->getLoggedUserId();

        $dbFactory = new StandardFactory($this->app);
        $user = $dbFactory->get('SIOFramework\Acl\Model\SystemUser',$userId);

        $customer = $dbFactory->selectOne('ProjectManager\Customers\Model\Customer',array('user'=>$user));

        if(! $customer instanceof Customer)
            throw new \ErrorException('Invalid customer user');

        return $customer;
    }

    /**
     * Gets the project by ID
     *
     * @param $projectId
     * @return Project
     * @throws \Exception
     */
    protected function selectProject($projectId)
    {
        $dbFactory = new StandardFactory($this->app);

        $project = $dbFactory->get('ProjectManager\Projects\Model\Project',$projectId);

        if(! $project instanceof Project)
            throw new \Exception('Invalid Project');

        return $project;
    }


    public function dashboard()
    {
        $this->render('@Relationship/dashboard.twig',$this->data);
    }

    public function listProjects()
    {
        $this->data['list'] = $this->getLoggedCustomer()->getProjects();

        $this->render('@Relationship/project_list.twig',$this->data);
    }

    public function listProducts($projectId)
    {
        $project = $this->selectProject($projectId);

        if(!$this->getLoggedCustomer()->getProjects()->contains($project))
            throw new \ErrorException('Invalid Project');

        $list = $project->getProducts();

        $this->data['list'] = $list;
        $this->data['project'] = $project;

        $this->render('@Relationship/product_list.twig',$this->data);
    }
}