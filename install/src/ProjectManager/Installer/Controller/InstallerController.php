<?php

namespace ProjectManager\Installer\Controller;

use SIOFramework\Common\Controller\DefaultController;
use SIOFramework\Common\Factory\StandardFactory;
use SIOFramework\Common\Factory\DatabaseFactoryInterface;
use SIOFramework\Acl\Model\SystemRole;
use SIOFramework\Acl\Model\SystemUser;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use ProjectManager\Customers\Model\Customer;
use ProjectManager\Projects\Model\Project;
use ProjectManager\Projects\Model\Product;
use ProjectManager\Projects\Model\Allocation;


class InstallerController extends DefaultController
{
	protected function installDatabase()
	{
		if( !isset($this->data['conf_db_host']) ||
			!isset($this->data['conf_db_name']) ||
			!isset($this->data['conf_db_user']) ||
			!isset($this->data['conf_db_password']))
		{
			throw new \Exception('Database settings error!');
		}
		
		$dir = $this->app->container->get('main_dir') . 'conf/';
		$fileName = $dir.'database.php';
		
		$file = fopen($fileName,'w');
		
		$template = $this->twig->loadTemplate('@Installer/conf/database.php.twig');
		
		fwrite($file, $template->render($this->data));
		
		fclose($file);
		
		$app = $this->app;
		require $fileName;
	}
	
	protected function loadMainModules()
	{
		$dir = $this->app->container->get('main_dir') . 'conf';
		
		$this->app->container->singleton('modules', function() use ($dir) {
			// Modules Manager (Loads the modules of our application and MUST BE THE FIRST)
			return require_once $dir . '/modules.php';
		});
		
	}
	
	protected function generateSchema()
	{	
		$cliConfig = ConsoleRunner::createHelperSet($this->app->container->get('orm'));
		
		$cli = new Application('Doctrine Command Line Interface', '1.0');
		$cli->setCatchExceptions(false);
		$cli->setHelperSet($cliConfig);
		$cli->setAutoExit(FALSE);
		$cli->addCommands([new \Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand()]);
		
		$commands = [
				'command' => 'orm:schema-tool:update',
				'--force' => TRUE
		];
		
		$exitCode = $cli->run(new ArrayInput($commands));
		
		if($exitCode != 0)
		{
			throw new \Exception('Unnable to create tables');
		}
	}
	
	protected function installAdmin(DatabaseFactoryInterface $dbFactory)
	{
		$adminRole = new SystemRole();
		$adminRole->setName('Administrator');
		$adminRole->setValue('ADMIN');
		
		$dbFactory->persist($adminRole);
		
		$adminUser = new SystemUser();
		$adminUser->setUsername($this->data['admin_user']);
		$adminUser->setPassword($this->data['admin_password']);
		$adminUser->setStatus('A');
		$adminUser->addRole($adminRole);
		
		$dbFactory->persist($adminUser);
	}
	
	protected function installExampleData(DatabaseFactoryInterface $dbFactory)
	{
		$adminUser = $dbFactory->selectOne('Acl:SystemUser', ['username'=>$this->data['admin_user']]);
		
		// Sample customer
		$customer = new Customer();
		$customer->setEmail('hank@moody.com');
		$customer->setName('Hank Moody');
		$customer->setNickname('Moody');
		$customer->setPhone('');
		$customer->setState('CA');
		
		$dbFactory->persist($customer);
		
		// Sample Project
		$project = new Project();
		$project->setName('Freelancer Project Manager');
		$project->setShortDescription('A system to manage personal freelancer projects.');
		$project->setStartingDate('01/09/2015');
		
		$project->setCustomer($customer);
		
		$dbFactory->persist($project);
		
		// Products
		$productA = new Product();
		
		$productA->setName('Interface Design');
		$productA->setDescription('The system interface.');
		$productA->setPaid(TRUE);
		$productA->setEstimatedhours(20);
		$productA->setValue(1200.00);
		$productA->setProject($project);
		
		$productB = new Product();
		
		$productB->setName('System Development');
		$productB->setDescription('The system business rules and implementation.');
		$productB->setPaid(FALSE);
		$productB->setEstimatedhours(160);
		$productB->setValue(8320.00);
		$productB->setProject($project);
		
		$dbFactory->persist($productA);
		$dbFactory->persist($productB);
		
		// Some Allocations
		$allocationA = new Allocation();
		
		$allocationA->setDateWorked('06/21/2016');
		$allocationA->setDescription('Layout conception');
		$allocationA->setProduct($productA);
		$allocationA->setUser($adminUser);
		$allocationA->setValue(10);
		
		$allocationB = new Allocation();
		
		$allocationB->setDateWorked('06/22/2016');
		$allocationB->setDescription('Layout implementation');
		$allocationB->setProduct($productA);
		$allocationB->setUser($adminUser);
		$allocationB->setValue(10);
		
		$allocationC = new Allocation();
		
		$allocationC->setDateWorked('06/30/2016');
		$allocationC->setDescription('Project Creation');
		$allocationC->setProduct($productB);
		$allocationC->setUser($adminUser);
		$allocationC->setValue(4);
		
		$dbFactory->persist($allocationA);
		$dbFactory->persist($allocationB);
		$dbFactory->persist($allocationC);
		
	}
	
	
    public function quickstart()
    {
        $this->render('@Installer/installer/quickstart.twig');
    }
    
    public function install()
    {
    	try {
    		// Creating file on the ProjectManager root conf
    		$fileName = $this->installDatabase();
    		
    		// Loading the ProjectManager root folder modules
    		$this->loadMainModules();
    		
    		// Generating the database tables
    		$this->generateSchema();
    		
    		// Persisting the Admin User
    		$doctrineFactory = new StandardFactory($this->app);
    		$this->installAdmin($doctrineFactory);
    		
    		// Install example data if requested
    		if(isset($this->data['install_data']) && $this->data['install_data'] == 1)
    		{
    			$this->installExampleData($doctrineFactory);
    		}
    		
    	}
    	catch(\Exception $ex)
    	{
    		throw $ex;
    	}
    	
    	$this->render('@Installer/installer/success.twig');
    }
  
}