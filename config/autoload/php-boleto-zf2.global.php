<?php

/**
 * PHP Boleto ZF2 - Versão Beta 
 * 
 * Este arquivo está disponível sob a Licença GPL disponível pela Web
 * em http://pt.wikipedia.org/wiki/GNU_General_Public_License 
 * Você deve ter recebido uma cópia da GNU Public License junto com
 * este pacote; se não, escreva para: 
 * 
 * Free Software Foundation, Inc.
 * 59 Temple Place - Suite 330
 * Boston, MA 02111-1307, USA.
 * 
 * Originado do Projeto BoletoPhp: http://www.boletophp.com.br 
 * 
 * Adaptação ao Zend Framework 2: João G. Zanon Jr. <jot@jot.com.br>
 * 
 */
return array(
    'php-zf2-boleto' => array(
        '001' => array(// codigo do BANCO DO BRASIL
            'dados_cedente' => array(
                'documento' => '00.000.000/0000-00',
                'identificacao' => 'PhpBoletoZf2',
                'nomeCedente' => 'Módulo PHP Boleto ZF2',
                'endereco' => 'Rua dos Quilobytes, 10101',
                'cidade' => 'Vila Velha',
                'uf' => 'ES',
                'logoCedente' => 'data:image/png;base64,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',
                'agencia' => '1400',
                'agenciaDv' => 1,
                'contaCorrente' => '16611',
                'contaCorrenteDv' => 1,
                'formatacaoConvenio' => 7,
                'convenio' => '1105369',
                'contrato' => '017512813',
                'carteira' => '18',
                'variacaoCarteira' => '-19'
            ),
        ),
        '033' => array(// codigo do SANTANDER
            'dados_cedente' => array(
                'documento' => '00.000.000/0000-00',
                'identificacao' => 'PhpBoletoZf2',
                'nomeCedente' => 'Módulo PHP Boleto ZF2',
                'endereco' => 'Rua dos Quilobytes, 10101',
                'cidade' => 'Vila Velha',
                'uf' => 'ES',
                'logoCedente' => 'data:image/png;base64,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',
                'carteira' => '102',
                'carteiraDescricao' => 'COBRANÇA SIMPLES - CSR',
                'codigocliente' => '0707077' , // Código do Cliente (PSK) (Somente 7 digitos)
                'pontodevenda' => '1333' // Agencia
            ),
        ),
        '237' => array(// codigo do BRADESCO
            'dados_cedente' => array(
                'documento' => '03.940.797/0001-03',
                'identificacao' => 'Igreja Catedral da Bênção',
                'nomeCedente' => 'IGREJA CATEDRAL DA BÊNÇÃO',
                'endereco' => 'QSF AE 4/5, Taguatinga Sul ',
                'cidade' => 'Brasília',
                'uf' => 'DF',
               // 'logoCedente' => 'data:image/png;base64,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',
                'logoCedente' => 'data:image/gif;base64,R0lGODlhkwAuANUAAKJrk7Y2VMnK47fJ6snt/d6GlHV4tdZebZCSw9GuwcTE3/cSEOvs9Mc5T55Ebb2+3Nzc64KEu+Pl8fn6/HWLyfP1+uE9R/8wKP8qFqys0sXS7ExOnfL+/9HR5+bp8+j9//8tILKy1dXV6Kanz7nc/NYsPMseMuDi8HM6d7i52c7N5O/w9lpcpD5Alaux1u4zOKuWuuYhKeMWHtjY6ba11/MuMZycyODr+N/f7mhprMrd9+8uMo+36KXA5tra6////yH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS41LWMwMjEgNzkuMTU1NzcyLCAyMDE0LzAxLzEzLTE5OjQ0OjAwICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOjUwMzc5MkZFRkI1OUUzMTE4QjlFQkI2OUFBMzAxQjQwIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjI4NzRCNjkzRkE3QjExRTQ5RjBGQjdBNzExRDVEMTU2IiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjI4NzRCNjkyRkE3QjExRTQ5RjBGQjdBNzExRDVEMTU2IiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9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',
                'agencia' => '0879',
                'agenciaDv' => 6,
                'contaCedente' => '0112012',
                'contaCedenteDv' => 3,
                'carteira' => '06',
            ),
        ),
        '104' => array(// codigo da CAIXA
            'dados_cedente' => array(
                'documento' => '00.000.000/0000-00',
                'identificacao' => 'PhpBoletoZf2',
                'nomeCedente' => 'Módulo PHP Boleto ZF2',
                'endereco' => 'Rua dos Quilobytes, 10101',
                'cidade' => 'Vila Velha',
                'uf' => 'ES',
                'logoCedente' => 'data:image/png;base64,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',
                'agencia' => '1564',
                'agenciaDv' => 0,
                'contaCedente' => '441530',
                'contaCedenteDv' => 0,
                'carteira' => 'SR',
            ),
        ),
        '341' => array(// codigo do ITAÚ
            'dados_cedente' => array(
                'documento' => '00.000.000/0000-00',
                'identificacao' => 'PhpBoletoZf2',
                'nomeCedente' => 'Módulo PHP Boleto ZF2',
                'endereco' => 'Rua dos Quilobytes, 10101',
                'cidade' => 'Vila Velha',
                'uf' => 'ES',
                'logoCedente' => 'data:image/png;base64,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',
                'agencia' => '4536',
                'contaCedente' => '09053',
                'contaCedenteDv' => '5',
                'carteira' => '175',
            ),
        ),
        'instrucoes' => array(
            'instrucoes1' => '- Sr. Caixa, cobrar multa de 2% após o vencimento',
            'instrucoes2' => '- Receber até 10 dias após o vencimento',
            'instrucoes3' => '- Em caso de dúvidas entre em contato conosco: xxxx@xxxx.com.br',
            'instrucoes4' => '- Emitido pelo BoletoPhp para Zend Framework 2 - phpboleto-zf2.jot.com.br',
        ),
    ),
);

