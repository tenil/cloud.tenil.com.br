<?php

return array(

    'PagSeguro' => array(

        'environment' => 'sandbox', // production, sandbox
        'credentials' => array(
            'email' => 'loja@cb.org.br',
            'token' => array(
                'production' => 'E1E09A2FA1E84E93AF194ED700F5F4DD', // ITEJ
                'sandbox' => '474944B5310745F39DDDED35F403B19C' // ITEJ
            ),
            'appId' => array(
                'production' => 'your_production_pagseguro_application_id',
                'sandbox' => 'app7137876743' // ITEJ
            ),
            'appKey' => array(
                'production' => 'your_production_application_key',
                'sandbox' => '724399EA0202C115545AAFBBED7299BB'
            ),
        ),
        'application' => array(
            'charset' => 'UTF-8' // UTF-8, ISO-8859-1
        ),
        'log' => array(
            'active' => false,
            'fileLocation' => './data/pagsegurolog.txt'
        )
    )

);