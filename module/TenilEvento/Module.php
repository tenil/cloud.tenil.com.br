<?php
namespace TenilEvento;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'TenilEvento\Service\Boleto' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    return new Service\Boleto($em);
                },
                'TenilEvento\Service\Evento' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    return new Service\Evento($em);
                },
            )
        );
    }
}
