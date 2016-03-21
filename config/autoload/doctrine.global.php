<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => '10.128.9.112',
                    'port' => '3306',
                    'user' => 'cb.org.br',
                    'password' => 'RCgcan72tQzdeAtAEq',
                    'dbname' => 'cb.org.br_arcanjo',
                    'driverOptions' => array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    )
                )
            )
        )
    )
);