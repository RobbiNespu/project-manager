<?php

namespace ProjectManager\Reports\Controller;

use ProjectManager\Customers\Model\Customer;
use ProjectManager\Projects\Model\Product;
use ProjectManager\Projects\Model\Project;
use ProjectManager\Widgets\Controller\MorrisDonutController;
use SIOFramework\Acl\Controller\SecuredController;
use SIOFramework\Common\Factory\StandardFactory;
use Slim\Slim;


class ReportsController extends SecuredController
{
    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('ADMIN');
    }

    /**
     * @var MorrisDonutController
     */
    protected $projectProducts;

    /**
     * @var MorrisDonutController
     */
    protected $projectSales;

    /**
     * @var MorrisDonutController
     */
    protected $projectPaidTotal;

    /**
     * @var MorrisDonutController
     */
    protected $projectByCustomers;


    public function __construct(Slim $app)
    {
        parent::__construct($app);

        $this->projectProducts = new MorrisDonutController($app,'ProjectProducts',array());
        $this->projectSales = new MorrisDonutController($app,'ProjectSales',array());
        $this->projectPaidTotal = new MorrisDonutController($app,'ProjectPaidTotal',array());
        $this->projectByCustomers = new MorrisDonutController($app,'ProjectByCustomers',array());

        $this->addWidget($this->projectProducts);
        $this->addWidget($this->projectSales);
        $this->addWidget($this->projectPaidTotal);
        $this->addWidget($this->projectByCustomers);
    }


    public function projectReport()
    {
        $dbFactory = new StandardFactory($this->app);
        $projects = $dbFactory->selectAll('ProjectManager\Projects\Model\Project');
        $customers = $dbFactory->selectAll('ProjectManager\Customers\Model\Customer');

        // Products
        $this->projectProducts->setElementName('products');

        // Sales
        $this->projectSales->setElementName('sales');
        $this->projectSales->setFormatter('$ ');
        $this->projectSales->setColors('["#FF0000","#AC333F","#8F0000","#6C2123"]');

        // Paid Total
        $this->projectPaidTotal->setElementName('paid');
        $this->projectPaidTotal->setFormatter('$ ');
        $this->projectPaidTotal->setColors('["#00FF00","#33AC3F","#008F00","#216C23"]');

        // Projects by customer
        $this->projectByCustomers->setElementName('customers');
        $this->projectByCustomers->setColors('["#00CCFF","#33AFAC","#006D8F","#21606C"]');


        foreach ($projects as $proj) {
            /**
             * @var $proj Project
             */
            $productsCount = 0;
            $salesCount = 0;
            $paidCount = 0;

            foreach ($proj->getProducts() as $prod) {
                /**
                 * @var $prod Product
                 */
                $productsCount++;
                $salesCount += $prod->getValue();

                if ($prod->getPaid())
                    $paidCount += $prod->getValue();
            }

            $this->projectProducts->addGraphData($proj->getName(), $productsCount);
            $this->projectSales->addGraphData($proj->getName(), $salesCount);
            $this->projectPaidTotal->addGraphData($proj->getName(), $paidCount);
        }

        foreach ($customers as $cust)
        {
            /**
             * @var $cust Customer
             */
            $this->projectByCustomers->addGraphData($cust->getNickname(),$cust->getProjects()->count());
        }

        $this->processWidgets();

        $this->render('reports/project/index.twig',$this->data);
    }

}