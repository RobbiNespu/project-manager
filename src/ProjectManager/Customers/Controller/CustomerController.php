<?php

namespace ProjectManager\Customers\Controller;

use SIOFramework\Acl\Controller\SecuredController;
use SIOFramework\Common\Factory\StandardFactory;
use ProjectManager\Customers\Model\Customer;


class CustomerController extends SecuredController
{
    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('ADMIN');
    }


    public function listCustomer()
    {
        $dbFactory = new StandardFactory($this->app);
        $list = $dbFactory->selectAll('ProjectManager\Customers\Model\Customer');
        $this->data['list'] = $list;

        $this->render('customers/customer/list.twig',$this->data);
    }

    public function createCustomer()
    {
        $obj = new Customer();

        if($this->app->request->isPost())
        {
            $dbFactory = new StandardFactory($this->app);

            $obj->hydrate($this->data);

            $dbFactory->persist($obj);
            $this->app->redirect($this->app->urlFor('Customers-Customer-List'));

            return;
        }

        $this->data['obj'] = $obj;

        $this->render('customers/customer/edit.twig',$this->data);
    }

    public function editCustomer($id)
    {
        $dbFactory = new StandardFactory($this->app);
        $obj = $dbFactory->get('ProjectManager\Customers\Model\Customer',$id);

        if(!($obj instanceof Customer))
        {
                $this->app->redirect($this->app->urlFor('Customers-Customer-List'));
                return;
        }

        if($this->app->request->isPost())
        {
            $obj->hydrate($this->data);
            $dbFactory->persist($obj);
            $this->app->redirect($this->app->urlFor('Customers-Customer-List'));

            return;
        }

        $this->data['obj'] = $obj;

        $this->render('customers/customer/edit.twig',$this->data);
    }

    public function deleteCustomer($id)
    {
        $dbFactory = new StandardFactory($this->app);
        $obj = $dbFactory->get('ProjectManager\Customers\Model\Customer',$id);

        if(!($obj instanceof Customer))
        {
            $this->app->redirect($this->app->urlFor('Customers-Customer-List').'?error=true');
            return;
        }

        try {
            $dbFactory->remove($obj);
        }
        catch(\Exception $ex)
        {
            $this->app->redirect($this->app->urlFor('Customers-Customer-List').'?error=true');
            return;
        }

        $this->app->redirect($this->app->urlFor('Customers-Customer-List').'?success=true');
    }

}