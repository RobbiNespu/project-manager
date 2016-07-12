<?php

namespace ProjectManager\Users\Controller;

use SIOFramework\Acl\Controller\SecuredController;
use SIOFramework\Acl\Model\SystemUser;
use SIOFramework\Common\Factory\StandardFactory;


class UsersController extends SecuredController
{

    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('ADMIN');
    }

    public function listSystemUsers()
    {
        $dbFactory = new StandardFactory($this->app);
        $systemUsers = $dbFactory->selectAll('SIOFramework\Acl\Model\SystemUser');

        $this->data['systemUsers'] = $systemUsers;

        $resp = $this->twig->loadTemplate('@Users/users.twig');
        echo $resp->render($this->data);
    }

    public function createUser()
    {
        if($this->app->request->isPost())
        {
            $systemUser = new SystemUser();
            $systemUser->hydrate($this->app->request->post());

            try
            {
                $dbFactory = new StandardFactory($this->app);
                $dbFactory->persist($systemUser);
            }
            catch(\Exception $ex)
            {
                // DO Nothing
            }
        }

        $this->app->redirect($this->app->urlFor('admin-users-list'));
    }

    public function disableUser($userId)
    {
        try
        {
            $dbFactory = new StandardFactory($this->app);
            $user = $dbFactory->get('SIOFramework\Acl\Model\SystemUser',$userId);

            $user->setStatus('X');
            $dbFactory->persist($user);
        }
        catch(\Exception $ex)
        {
            // DO Nothing
        }

        $this->app->redirect($this->app->urlFor('admin-users-list'));
    }

    public function enableUser($userId)
    {
        try
        {
            $dbFactory = new StandardFactory($this->app);
            $user = $dbFactory->get('SIOFramework\Acl\Model\SystemUser',$userId);

            $user->setStatus('A');
            $dbFactory->persist($user);
        }
        catch(\Exception $ex)
        {
        }

        $this->app->redirect($this->app->urlFor('admin-users-list'));
    }

    public function userRoles($userId)
    {
        $dbFactory = new StandardFactory($this->app);
        $user = $dbFactory->get('SIOFramework\Acl\Model\SystemUser',$userId);
        $roles = $dbFactory->selectAll('SIOFramework\Acl\Model\SystemRole',array(),array('name'=>'asc'));

        $this->data['systemUser'] = $user;
        $this->data['systemRoles'] = $roles;

        $resp = $this->twig->loadTemplate('@Users/roles.twig');
        echo $resp->render($this->data);

    }

    public function addRole()
    {
        /**
         * @var $user SystemUser
         */
        $dbFactory = new StandardFactory($this->app);
        $user = $dbFactory->get('SIOFramework\Acl\Model\SystemUser', $this->data['userId']);

        $role = $dbFactory->get('SIOFramework\Acl\Model\SystemRole', $this->data['role']);

        if (!$user->getRoles()->contains($role))
        {
            $user->addRole($role);
            $dbFactory->persist($user);
        }

        $this->app->redirect(
            $this->app->urlFor('admin-users-roles',
                array('userId'=>$user->getId())
            )
        );

    }

    public function removeRole($userId,$roleId)
    {
        try
        {
            $dbFactory = new StandardFactory($this->app);
            $user = $dbFactory->get('SIOFramework\Acl\Model\SystemUser',$userId);

            $user->removeRole($roleId);
            $dbFactory->persist($user);
        }
        catch(\Exception $ex)
        {
            // DO Nothing
        }

        $this->app->redirect(
            $this->app->urlFor('admin-users-roles',
                array('userId'=>$user->getId())
            )
        );
    }
}