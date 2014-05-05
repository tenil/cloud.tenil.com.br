<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace TenilAcl;

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
                'TenilAcl\Service\Role' => function($sm) {
            return new Service\Role($sm->get('Doctrine\ORM\EntityManager'));
        },
                'TenilAcl\Service\Resource' => function($sm) {
            return new Service\Resource($sm->get('Doctrine\ORM\EntityManager'));
        },
                'TenilAcl\Service\Privilege' => function($sm) {
            return new Service\Privilege($sm->get('Doctrine\ORM\EntityManager'));
        },
                'TenilAcl\Form\Role' => function($sm) {
            $em = $sm->get('Doctrine\ORM\EntityManager');
            $repositorio = $em->getRepository('TenilAcl\Entity\Role');
            $parent = $repositorio->fetchParent();

            return new Form\Role('role', NULL, $parent);
        },
                'TenilAcl\Form\Privilege' => function($sm) {
            $em = $sm->get('Doctrine\ORM\EntityManager');

            $roleRepository = $em->getRepository('TenilAcl\Entity\Role');
            $role = $roleRepository->fetchParent();

            $resourceRepository = $em->getRepository('TenilAcl\Entity\Resource');
            $resource = $resourceRepository->fetchPairs();

            return new Form\Privilege('privilege', NULL, $role, $resource);
        },
            )
        );
    }

}
