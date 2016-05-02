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

        $this->donutWidget = new MorrisDonutController($app, 'MorrisDonut', $this->data);
        $this->donutWidget->setElementName('IagoIsabel');
        $this->addWidget($this->donutWidget);
    }

    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('ADMIN');
    }


    public function index()
    {
        $this->donutWidget->addGraphData('Iago',40);
        $this->donutWidget->addGraphData('Isabel',60);

        $this->render('dashboard/index.twig');
    }
}