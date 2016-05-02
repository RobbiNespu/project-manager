<?php

namespace ProjectManager\Dashboard\Controller;

use SIOFramework\Acl\Controller\SecuredController;
use SIOFramework\Common\Controller\DefaultController;


class DashboardController extends SecuredController
{
    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('ADMIN');
    }


    public function index()
    {
        $this->render('default/index.twig');
    }
}