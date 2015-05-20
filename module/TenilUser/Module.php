<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace TenilUser;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use TenilUser\Auth\Adapter as AuthAdapter;

use Zend\Authentication\AuthenticationService;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {

        return array(
            'factories' => array(
                'TenilUser\Mail\Transport' => function($sm) {
                    // Recupera as informações do global.php
                    $config = $sm->get('Config');
                    // Recupera as informações de mail do global.php
                    $options = new SmtpOptions($config['mail']);

                    $transport = new SmtpTransport();
                    $transport->setOptions($options);
                    return $transport;
                },
                'TenilUser\Service\User' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $transport = $sm->get('TenilUser\Mail\Transport');
                    $view = $sm->get('view');
                    return new Service\User($em, $transport, $view);
                },
                'TenilUser\Service\Perfil' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    return new Service\Perfil($em);
                },
                /**
                 * Esse serviço pode ser desativado
                 */
                'TenilUser\Auth\Adapter' => function($sm) {
                    return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
                },
                /**
                 * Esse serviço pode ser desativado
                 */
                'TenilUser\Service\Auth' => function($sm) {
                    return new Service\Auth;
                },
                'Zend\Authentication\AuthenticationService' => function($sm){
                    return $sm->get('doctrine.authenticationservice.orm_default');
                },
                'TenilUser\Form\Perfil' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $repositoryTratamento = $em->getRepository('TenilUser\Entity\TipoTratamento');
                    $tratamento = $repositoryTratamento->fetchTratamento();
                    
                    $repositoryTipoFone = $em->getRepository('TenilUser\Entity\TipoFone');
                    $tipoFone = $repositoryTipoFone->fetchTipoFone();
                    
                    return new Form\Perfil('perfil', NULL, $tratamento, $tipoFone);
                },
            )
        );
    }

    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'FormElementErrors' => 'TenilUser\Form\View\Helper\FormElementErrors',
                //'UserIdentity' => new View\Helper\UserIdentity(),
                'UserIdentity' => 'TenilUser\View\Helper\UserIdentity',
            //'Session' => new View\Helper\Session(), //Elton Minetto
            ),
        );
    }

}
