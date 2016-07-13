<?php

namespace ProjectManager\Projects\Controller;

use SIOFramework\Acl\Controller\SecuredController;
use ProjectManager\Projects\Model\Allocation;

class AllocationController extends SecuredController
{

    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('ADMIN');
    }

    public function allocationOverview()
    {
        $obj = $this->databaseFactory->selectAll('Projects:Allocation',[],['dateWorked'=>'DESC']);

        $this->data['allocations'] = $obj;

        $this->render('@Projects/allocation/overview.twig',$this->data);
    }
    
 	public function editAllocation($allocationId=NULL)
 	{
 		/**
 		 * @var Allocation $allocation
 		 */
 		$allocation = new Allocation();
 		$projectList = $this->databaseFactory->selectAll('Projects:Project',[],['name'=>'ASC']);
 		
 		if($allocationId != NULL)
 		{
 			$allocation = $this->databaseFactory->get('Projects:Allocation', $allocationId);
 		}
 		
 		if($this->app->request->isPost())
 		{
 			try {
 				
 				if(!isset($this->data['productId']) || !is_numeric($this->data['productId']))
 				{
 					throw new \Exception('Invalid product id!');
 				}
 				
 				$product = $this->databaseFactory->get(
 					'Projects:Product',
 					$this->data['productId']
 				);
 				
 				$user = $this->databaseFactory->get(
 					'Acl:SystemUser',
 					$this->getLoggedUserId()
 				);
 				
 				$allocation->hydrate($this->data);
 				if($allocation->getId() == NULL)
 				{
 					$allocation->setUser($user);
 					$allocation->setProduct($product);
 				}
 				
 				$this->databaseFactory->persist($allocation);
 				
 				$this->app->redirect($this->app->urlFor('Projects-Allocation-Overview').'?success=true');
 			}
 			catch(\Exception $ex)
 			{
 				$this->data['error'] = 'Something bad happened!';
 			}
 		}
 		
 		$this->data['allocation'] = $allocation;
 		$this->data['projectList'] = $projectList;
 		
 		$this->render('@Projects/allocation/edit.twig',$this->data);
 	}
    
 	

}