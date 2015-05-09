<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 07/05/2015
 * Time: 16:36
 */

namespace TenilUser\Service;

use TenilBase\Service\Service;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use Doctrine\ORM\EntityManager;
use Zend\Authentication\Result;
use Zend\Stdlib\Hydrator;

/**
 * Serviço responsável pela autenticação da aplicação
 *
 * @category TenilUser
 * @package TenilUser
 * @author  Roberto Tenil<roberto.tenil@gmail.com>
 */
class Auth extends Service
{
    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $password;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param $params
     * @return Result
     * @throws \Exception
     */
    public function authenticate($params)
    {
        $this->setUsername($params['username']);
        $this->setPassword($params['password']);

        $authService = $this->getServiceManager()->get('Zend\Authentication\AuthenticationService');

        $adapter = $authService->getAdapter();
        $adapter->setIdentityValue($this->getUsername());
        $adapter->setCredentialValue($this->getPassword());

        $authResult = $authService->authenticate();

        return $authResult;
    }

    public function authenticateBkp($params) {

        $this->setUsername($params['username']);
        $this->setPassword($params['password']);

        $auth = new AuthenticationService;
        $storage = new SessionStorage();
        $auth->setStorage($storage);

        $authAdapter = $this->getServiceManager()->get('TenilUser\Auth\Adapter');

        $authAdapter->setUsername($this->getUsername());
        $authAdapter->setPassword($this->getPassword());

        $result = $auth->authenticate($authAdapter);

        if ($result->isValid()) {

            $storage->write($auth->getIdentity()['user'], null);

        }

        return $result;

    }
    /**
     * @return bool
     */

    public function logout()
    {
        $auth = new AuthenticationService;
        $auth->clearIdentity();
        // return $this->redirect()->toRoute('home');
        return true;
    }

    /**
     * Faz a autenticação dos usuários
     *
     * @param array $params
     * @return array
     * @throws \Exception
     */
    public function authenticateEmineto($params)
    {
        if (!isset($params['username']) || !isset($params['password'])) {
            throw new \Exception("Parâmetros inválidos");
        }

        $password = md5($params['password']);
        $auth = new AuthenticationService();
        $authAdapter = new AuthAdapter($this->dbAdapter);
        $authAdapter
            ->setTableName('users')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password')
            ->setIdentity($params['username'])
            ->setCredential($password);
        $result = $auth->authenticate($authAdapter);

        if (!$result->isValid()) {
            throw new \Exception("Login ou senha inválidos");
        }

        //salva o user na sessão
        $session = $this->getServiceManager()->get('Session');
        $session->offsetSet('user', $authAdapter->getResultRowObject());

        return true;
    }

    /**
     * Faz o logout do sistema
     *
     * @return void
     */
    public function logoutEmineto()
    {
        $auth = new AuthenticationService();
        $session = $this->getServiceManager()->get('Session');
        $session->offsetUnset('user');
        $auth->clearIdentity();
        return true;
    }

}