<?php

namespace ProjectManager\Projects\Controller;

use ProjectManager\Customers\Model\Customer;
use SIOFramework\Acl\Controller\SecuredController;
use SIOFramework\Common\Controller\DefaultController;
use SIOFramework\Common\Factory\StandardFactory;
use ProjectManager\Projects\Model\Project;


class ProjectController extends SecuredController
{
    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('ADMIN');
    }

    public function listProject()
    {
        $dbFactory = new StandardFactory($this->app);
        $list = $dbFactory->selectAll('ProjectManager\Projects\Model\Project');
        $this->data['list'] = $list;

        $this->render('@Projects/project/list.twig',$this->data);
    }

    public function createProject()
    {
        $obj = new Project();

        $dbFactory = new StandardFactory($this->app);
        $customers = $dbFactory->selectAll('ProjectManager\Customers\Model\Customer',array(),array('name'=>'asc'));
        $this->data['customers'] = $customers;

        if($this->app->request->isPost())
        {
            $dbFactory = new StandardFactory($this->app);

            $obj->hydrate($this->data);

            $customer = $dbFactory->get('ProjectManager\Customers\Model\Customer',$this->data['customerId']);

            if(! $customer instanceof Customer)
                throw new \Exception('Wrong customer');

            $obj->setCustomer($customer);

            $dbFactory->persist($obj);
            $this->app->redirect($this->app->urlFor('Projects-Project-List'));

            return;
        }

        $this->data['obj'] = $obj;

        $this->render('@Projects/project/edit.twig',$this->data);
    }

    public function editProject($id)
    {
        $dbFactory = new StandardFactory($this->app);
        $obj = $dbFactory->get('ProjectManager\Projects\Model\Project',$id);

        $customers = $dbFactory->selectAll('ProjectManager\Customers\Model\Customer',array(),array('name'=>'asc'));
        $this->data['customers'] = $customers;

        if(!($obj instanceof Project))
        {
                $this->app->redirect($this->app->urlFor('Projects-Project-List'));
                return;
        }

        if($this->app->request->isPost())
        {
            $obj->hydrate($this->data);

            $customer = $dbFactory->get('ProjectManager\Customers\Model\Customer',$this->data['customerId']);

            if(! $customer instanceof Customer)
                throw new \Exception('Wrong customer');

            $obj->setCustomer($customer);

            $dbFactory->persist($obj);
            $this->app->redirect($this->app->urlFor('Projects-Project-List'));

            return;
        }

        $this->data['obj'] = $obj;

        $this->render('@Projects/project/edit.twig',$this->data);
    }

    public function deleteProject($id)
    {
        $dbFactory = new StandardFactory($this->app);
        $obj = $dbFactory->get('ProjectManager\Projects\Model\Project',$id);

        if(!($obj instanceof Project))
        {
            $this->app->redirect($this->app->urlFor('Projects-Project-List').'?error=true');
            return;
        }

        try {
            $dbFactory->remove($obj);
        }
        catch(\Exception $ex)
        {
            $this->app->redirect($this->app->urlFor('Projects-Project-List').'?error=true');
            return;
        }

        $this->app->redirect($this->app->urlFor('Projects-Project-List').'?success=true');
    }

}