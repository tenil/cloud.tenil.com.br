<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 31/03/2016
 * Time: 16:37
 */

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;


class formataCpf extends AbstractHelper
{
    public function __invoke($cpf)
    {
        // limpar tudo que não for digito
        $cpf = preg_replace('/[^0-9]/', '', trim($cpf));
        if (strlen($cpf) != 11) {
            // quantidade de numeros inválidos para cpf
            return null;
        }

        // formatar cpf
        $cpf_formatado = substr($cpf, 0, 3) . '.';
        $cpf_formatado .= substr($cpf, 3, 3) . '.';
        $cpf_formatado .= substr($cpf, 6, 3) . '-';
        $cpf_formatado .= substr($cpf, 9, 3);
        return $cpf_formatado;
    }
}