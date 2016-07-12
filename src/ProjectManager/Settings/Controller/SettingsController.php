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
        $app = $this->app;

        if($app->request->isPost())
        {
            $params = $this->data;

            try
            {
                $userFactory = new StandardFactory($this->app);
                $user = $userFactory->get('SIOFramework\Acl\Model\SystemUser',$this->getLoggedUserId());

                if(!is_object($user) ||
                    $user->getPassword() != sha1($params['oldpassword']) ||
                    $params['newpassword']!=$params['newpasswordconf'])
                {
                    throw new \Exception('Password does not match.');
                }

                if(sizeof($user->getPassword()) < 6)
                {
                    throw new \Exception('Password must be bigger than 6 characters');
                }

                $user->setPassword($params['newpassword']);
                $userFactory->persist($user);

                $this->data['success'] = 'Password changed.';

            }
            catch(\Exception $ex)
            {
                $this->data['error'] = 'Error changing password. '.$ex->getMessage();
            }
        }

        $this->render('@Settings/settings.twig', $this->data);
    }
}