<?php

namespace TenilUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use TenilUser\Form\Login as LoginForm;

/**
 * Description of AuthController
 *
 * @author Roberto
 */
class AuthController extends AbstractActionController {

    public function indexAction() {

        $form = new LoginForm;
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $request->getPost()->toArray();

                $auth = new AuthenticationService;
                $storage = new SessionStorage("TenilUser");

                $auth->setStorage($storage);

                $authAdapter = $this->getServiceLocator()->get("TenilUser\Auth\Adapter");

                $authAdapter->setUsername($data['email']);
                $authAdapter->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    /*
                      $user = $auth->getIdentity();
                      $user = $user['user'];
                      $storage->write($user, null);
                     * 
                     */

                    $storage->write($auth->getIdentity()['user'], null);

                    $this->flashMessenger()->setNamespace('TenilUser')->addSuccessMessage('Usuário logado com sucesso!');

                    
                    return $this->redirect()->toRoute('tenil-user-auth');
                } else {
                    $this->flashMessenger()->setNamespace('TenilUser')->addErrorMessage('Não foi possível efetuar o login!');
                }
            }
        }

        return new ViewModel(array('form' => $form));
    }
    
    public function logoutAction(){
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("TenilUser"));
        $auth->clearIdentity();
        $this->flashMessenger()->setNamespace('TenilUser')->addSuccessMessage('Logout efetuado com sucesso.');
        return $this->redirect()->toRoute('tenil-user-auth');
    }   

}
