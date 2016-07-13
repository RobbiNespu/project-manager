<?php

namespace ProjectManager\Projects\Controller;

use ProjectManager\Projects\Model\Project;
use SIOFramework\Acl\Controller\SecuredController;
use SIOFramework\Common\Factory\StandardFactory;
use ProjectManager\Projects\Model\Product;
use Slim\Slim;


class ProductController extends SecuredController
{

    protected function userHasAccess()
    {
        return $this->loggedUserHasRole('ADMIN');
    }

    protected function selectProject($projectId)
    {
        $dbFactory = new StandardFactory($this->app);

        $project = $dbFactory->get('ProjectManager\Projects\Model\Project',$projectId);

        if(! $project instanceof Project)
            throw new \Exception('Invalid Project');

        return $project;
    }


    public function listProduct($projectId)
    {
        $project = $this->selectProject($projectId);

        $list = $project->getProducts();

        $this->data['list'] = $list;
        $this->data['project'] = $project;

        $this->render('@Projects/product/list.twig',$this->data);
    }

    public function createProduct($projectId)
    {
        $this->data['projectId'] = $projectId;

        $obj = new Product();

        $project = $this->selectProject($projectId);

        if($this->app->request->isPost())
        {
            $dbFactory = new StandardFactory($this->app);

            $project = $this->selectProject($projectId);

            $obj->setProject($project);

            $obj->hydrate($this->data);

            $dbFactory->persist($obj);
            $this->app->redirect($this->app->urlFor('Projects-Products-List',array('projectId'=>$projectId)));

            return;
        }

        $this->data['obj'] = $obj;
        $this->data['project'] = $project;

        $this->render('@Projects/product/edit.twig',$this->data);
    }

    public function editProduct($projectId, $id)
    {
        $dbFactory = new StandardFactory($this->app);
        $obj = $dbFactory->get('ProjectManager\Projects\Model\Product',$id);

        $project = $this->selectProject($projectId);

        if(!($obj instanceof Product))
        {
                $this->app->redirect($this->app->urlFor('Projects-Products-List'));
                return;
        }

        if($this->app->request->isPost())
        {
            $obj->hydrate($this->data);
            $dbFactory->persist($obj);
            $this->app->redirect($this->app->urlFor('Projects-Products-List',array('projectId'=>$projectId)));

            return;
        }

        $this->data['project'] = $project;
        $this->data['obj'] = $obj;

        $this->render('@Projects/product/edit.twig',$this->data);
    }

    public function deleteProduct($projectId, $id)
    {
        $dbFactory = new StandardFactory($this->app);
        $obj = $dbFactory->get('ProjectManager\Projects\Model\Product',$id);

        if(!($obj instanceof Product))
        {
            $this->app->redirect($this->app->urlFor('Projects-Products-List',['projectId'=>$projectId]).'?error=true');
            return;
        }

        try {
            $dbFactory->remove($obj);
        }
        catch(\Exception $ex)
        {
            $this->app->redirect($this->app->urlFor('Projects-Products-List',['projectId'=>$projectId]).'?error=true');
            return;
        }

        $this->app->redirect($this->app->urlFor('Projects-Products-List',['projectId'=>$projectId]).'?success=true');
    }

    public function productsOverview()
    {
        $dbFactory = new StandardFactory($this->app);
        $obj = $dbFactory->selectAll('ProjectManager\Projects\Model\Product');

        $this->data['products'] = $obj;


        $this->render('@Projects/product/overview.twig',$this->data);
    }
    
    public function selectProductsFromProject($projectId)
    {
    	$products = $this->databaseFactory->selectAll('ProjectManager\Projects\Model\Product',
    			['project'=>$projectId],
    			['name'=>'ASC']
    	);
    	
    	if(count($products) <= 0)
    	{
    		$this->app->response->status(404);
    		echo json_encode(NULL);
    		return;
    	}
    	
    	$productData = [];
    	
    	foreach($products as $product)
    	{
    		/**
    		 * @var Product $product
    		 */
    		$productData[] = [
    			'id' => $product->getId(),
    			'name' => $product->getName(),
    		];
    	}
    	
    	echo json_encode($productData, JSON_OBJECT_AS_ARRAY);
    }

}