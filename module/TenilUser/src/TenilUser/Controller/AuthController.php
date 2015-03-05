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
                $data = $form->getData();

                $auth = new AuthenticationService;
                $storage = new SessionStorage("Tenil");

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

                    return $this->redirect()->toRoute('home');
                }
            } else {
                foreach ($form->getMessages() as $message) {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                }
            }
        }

        $view = new ViewModel(array('form' => $form));
        //$this->layout('layout/login');
        return $view;
    }

    public function logoutAction() {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("Tenil"));
        $auth->clearIdentity();
        //$this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Logout efetuado com sucesso.');
        return $this->redirect()->toRoute('home');
    }

}
