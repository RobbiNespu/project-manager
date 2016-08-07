<?php

namespace ProjectManager\Dashboard\Controller;

use ProjectManager\Widgets\Controller\MorrisDonutController;
use SIOFramework\Acl\Controller\SecuredController;
use Slim\Slim;
use ProjectManager\Projects\Model\Product;


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
    	$this->data['products'] = $this->databaseFactory->selectAll('Projects:Product');
    	$this->data['projects'] = $this->databaseFactory->selectAll('Projects:Project');
    	
    	$status = [
    		'paid_total' => 0,
    		'pending_total' => 0,
    		'total_products' => count($this->data['products']),
    		'total_projects' => count($this->data['projects']),
    	];
    	
    	foreach($this->data['products'] as $product)
    	{
    		/**
    		 * @var Product $product
    		 */
    		if($product->getPaid())
    			$status['paid_total'] += $product->getValue();
    		else
    			$status['pending_total'] += $product->getValue();
    	}
    	
    	$this->data['status'] = $status;
    	
        $this->render('@Dashboard/index.twig', $this->data);
    }
}