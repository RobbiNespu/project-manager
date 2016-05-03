<?php

namespace ProjectManager\Customers\Controller;

use SIOFramework\Acl\Controller\SecuredController;
use SIOFramework\Acl\Model\SystemRole;
use SIOFramework\Acl\Model\SystemUser;
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


    // Customer User actions

    public function listCustomerUsers()
    {
        $dbFactory = new StandardFactory($this->app);
        $list = $dbFactory->selectAll('ProjectManager\Customers\Model\Customer');
        $this->data['list'] = $list;

        $this->render('customers/customer/loginlist.twig',$this->data);
    }

    public function createCustomerUser()
    {
        $dbFactory = new StandardFactory($this->app);

        $customers = $dbFactory->selectAll('ProjectManager\Customers\Model\Customer');

        if($this->app->request->isPost())
        {
            $customer = $dbFactory->get('ProjectManager\Customers\Model\Customer',$this->data['customer']);
            if(! $customer instanceof Customer)
                throw new \Exception('Invalid Customer');

            $user = new SystemUser();

            $customerRole = $dbFactory->selectOne('SIOFramework\Acl\Model\SystemRole',array('value'=>'CUSTOMER'));

            if(! $customerRole instanceof SystemRole)
                throw new \ErrorException('Not a role');

            $user->addRole($customerRole);
            $user->setUsername($this->data['username']);
            $user->setPassword($this->data['password']);
            $user->setStatus('A');

            $dbFactory->persist($user);

            $customer->setUser($user);
            $dbFactory->persist($customer);

            $this->app->redirect($this->app->urlFor('Customers-User-List'));

            return;
        }

        $this->data['customers'] = $customers;

        $this->render('customers/customer/adduser.twig',$this->data);
    }

    public function deleteCustomerUser($id)
    {
        $dbFactory = new StandardFactory($this->app);
        $obj = $dbFactory->get('ProjectManager\Customers\Model\Customer',$id);

        if(!($obj instanceof Customer) || !($obj->getUser() instanceof SystemUser))
        {
            $this->app->redirect($this->app->urlFor('Customers-User-List').'?error=true');
            return;
        }

        try {
            // Removing roles
            $customerUser = $obj->getUser();
            $customerUser->getRoles()->clear();

            // Removing user from Customer
            $obj->setUser(null);

            $dbFactory->persist($obj);
            $dbFactory->persist($customerUser);

            $dbFactory->remove($customerUser);
        }
        catch(\Exception $ex)
        {
            echo $ex->getMessage();
            exit;

            $this->app->redirect($this->app->urlFor('Customers-User-List').'?error=true');
            return;
        }

        $this->app->redirect($this->app->urlFor('Customers-User-List').'?success=true');
    }

}