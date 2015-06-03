<?php

namespace TenilUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use TenilUser\Form\Login as LoginForm;
use Zend\Authentication\Result;

/**
 * Description of AuthController
 *
 * @author Roberto
 */
class AuthController extends AbstractActionController
{
/*
    public function loginBkpAction()
    {

        $form = new LoginForm;
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();

                $auth = new AuthenticationService;
                $storage = new SessionStorage();
                $auth->setStorage($storage);

                $authAdapter = $this->getServiceLocator()->get('TenilUser\Auth\Adapter');

                $authAdapter->setUsername($data['email']);
                $authAdapter->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    //
                    //  $user = $auth->getIdentity();
                    //  $user = $user['user'];
                    //  $storage->write($user, null);
                    //
                    //

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
*/
    public function logoutAction()
    {
        $auth = new AuthenticationService;
        //$auth->setStorage(new SessionStorage());
        $auth->clearIdentity();
        //$this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Logout efetuado com sucesso.');
        return $this->redirect()->toRoute('home');
    }


    public function loginAction()
    {
        $form = new LoginForm;
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();

                $login = $this->getServiceLocator()->get('TenilUser\Service\Auth');
                $result = $login->authenticate(array('username' => $data['email'], 'password' => $data['password']));

                if ($result->isValid()) {
                    return $this->redirect()->toRoute('home');
                } else {
                    foreach($result->getMessages() as $message) {
                        $this->flashmessenger()->setNamespace('Tenil')->addErrorMessage($message);
                    }
                }
            } else {
                foreach ($form->getMessages() as $message) {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                }
            }
        }

        $view = new ViewModel(array('form' => $form));
        return $view;
    }

/*
    public function loginBkp3Action()
    {
        $form = new LoginForm;
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();

                $login = $this->getServiceLocator()->get('TenilUser\Service\Auth');
                $result = $login->authenticate(array('username' => $data['email'], 'password' => $data['password']));

                if ($result->isValid()) {
                    return $this->redirect()->toRoute('home');
                } else {
                    foreach($result->getMessages() as $message) {
                        $this->flashmessenger()->setNamespace('Tenil')->addErrorMessage($message);
                    }
                }
            } else {
                foreach ($form->getMessages() as $message) {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                }
            }
        }

        $view = new ViewModel(array('form' => $form));
        return $view;
    }
*/
/*
    public function loginBkp2Action()
    {

        $form = new LoginForm;
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();

                $login = $this->getServiceLocator()->get('TenilUser\Service\Auth');
                $result = $login->authenticate(array('username' => $data['email'], 'password' => $data['password']));

                if ($result->isValid()) {
                    return $this->redirect()->toRoute('home');
                }
            } else {
                foreach ($form->getMessages() as $message) {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage($message);
                }
            }
        }

        $view = new ViewModel(array('form' => $form));
        return $view;
    }
*/
}
