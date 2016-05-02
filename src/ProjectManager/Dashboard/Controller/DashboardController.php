<?php

namespace ProjectManager\Dashboard\Controller;

use ProjectManager\Widgets\Controller\MorrisDonutController;
use SIOFramework\Acl\Controller\SecuredController;
use Slim\Slim;


class DashboardController extends SecuredController
{

    /**
     * @var MorrisDonutController
     */
    protected $donutWidget;

    /**
     * DashboardController constructor.
     */
    public function __construct(Slim $app)
    {
        parent::__construct($app);
    }

    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('ADMIN');
    }

    public function index()
    {
        $this->render('dashboard/index.twig');
    }
}