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
                }
            )
        );
    }

    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'FormElementErrors' => 'TenilUser\Form\View\Helper\FormElementErrors'
            ),
        );
    }

}