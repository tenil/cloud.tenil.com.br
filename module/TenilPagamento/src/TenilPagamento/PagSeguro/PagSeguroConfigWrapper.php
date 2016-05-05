<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 16/04/2016
 * Time: 14:51
 */

namespace TenilPagamento\PagSeguro;


class PagSeguroConfigWrapper
{
    public static function getConfig()
    {
        $PagSeguroConfig = array();
        $PagSeguroConfig['environment'] = "sandbox"; // production, sandbox
        $PagSeguroConfig['credentials'] = array();
        $PagSeguroConfig['credentials']['email'] = "roberto.tenil@gmail.com";
        $PagSeguroConfig['credentials']['token']['production'] = "3FA029F45461419DBE43993449D67C46";
        $PagSeguroConfig['credentials']['token']['sandbox'] = "9F07E8CFFAAD45EA9B101A282E2595BD";
        $PagSeguroConfig['credentials']['appId']['production'] = "your__production_pagseguro_application_id";
        $PagSeguroConfig['credentials']['appId']['sandbox'] = "app3391897162";
        $PagSeguroConfig['credentials']['appKey']['production'] = "your_production_application_key";
        $PagSeguroConfig['credentials']['appKey']['sandbox'] = "71673E496C6C5208845CAFB9925CEC3F";
        $PagSeguroConfig['application'] = array();
        $PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1
        $PagSeguroConfig['log'] = array();
        $PagSeguroConfig['log']['active'] = false;
        // Informe o path completo (relativo ao path da lib) para o arquivo, ex.: ../PagSeguroLibrary/logs.txt
        $PagSeguroConfig['log']['fileLocation'] = "./data/pagsegurolog.txt";
        return $PagSeguroConfig;
    }
}