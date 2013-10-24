<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
    'mail' => array(
        'name' => 'tenil.com.br',
        'host' => 'email-smtp.us-east-1.amazonaws.com',
        'port' => 587, // Notice port change for TLS is 587
        'connection_class' => 'plain',
        'connection_config' => array(
            'username' => 'AKIAIMQAL354XXTUFRVQ',
            'password' => 'ApwN9pFWzUkmpsa0LTqODsjz9cSwU+pRE0KIc55uvni3',
            'ssl' => 'tls',
            'from' => 'contato@tenil.com.br',
            'sender' => 'Tenil Tecnologia'
        )
    )
);