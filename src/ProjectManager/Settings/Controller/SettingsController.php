<?php

namespace ProjectManager\Settings\Controller;

use SIOFramework\Acl\Controller\SecuredController;
use SIOFramework\Common\Factory\StandardFactory;


class SettingsController extends SecuredController
{
    protected function userHasAccess()
    {
        return is_numeric($this->getLoggedUserId());
    }


    public function changePassword()
    {
        $user = $this->databaseFactory->get('Acl:SystemUser',$this->getLoggedUserId());
        
        if($this->app->request->isPost())
        {
            $params = $this->data;

            try
            {
                if(!is_object($user) ||
                    $user->getPassword() != sha1($params['oldpassword']) ||
                    $params['newpassword']!=$params['newpasswordconf'])
                {
                    throw new \Exception('Password does not match.');
                }
                
                if(strlen($params['newpassword']) < 6)
                {
                    throw new \Exception('Password must be bigger than 6 characters');
                }

                $user->setPassword($params['newpassword']);
                $this->databaseFactory->persist($user);

                $this->data['success'] = 'Password changed.';

            }
            catch(\Exception $ex)
            {
                $this->data['error'] = 'Error changing password. '.$ex->getMessage();
            }
        }
        
        $this->data['user'] = $user;

        $this->render('@Settings/settings.twig', $this->data);
    }
}