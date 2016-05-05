<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 11/04/2016
 * Time: 13:04
 */

namespace TenilPagamento\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use \PagSeguroPaymentRequest;
use \PagSeguroConfig;
use \PagSeguroAccountCredentials;

use Zend\Config\Config;

class PagamentoController extends AbstractActionController
{

    public function indexAction()
    {

        $paymentRequest = new PagSeguroPaymentRequest();
        $paymentRequest->addItem('0001', 'Notebook', 1, 130.00);
        $paymentRequest->addItem('0002', 'Mochila',  1, 150.99);

        $paymentRequest->setSender(
            'João Comprador',
            'roberto.tenil@yahoo.com',
            '11',
            '56273440',
            'CPF',
            '156.009.442-76'
        );

        $paymentRequest->setCurrency("BRL");

        // Referenciando a transação do PagSeguro em seu sistema
        $paymentRequest->setReference("REF123");

        // URL para onde o comprador será redirecionado (GET) após o fluxo de pagamento
        $paymentRequest->setRedirectUrl("http://www.lojamodelo.com.br");

        // URL para onde serão enviadas notificações (POST) indicando alterações no status da transação
        $paymentRequest->addParameter('notificationURL', 'http://www.lojamodelo.com.br/nas');
        
        // Você pode definir percentuais de descontos a serem oferecidos com base no meio de pagamento escolhido
        // pelo seu cliente, durante o checkout, no ambiente do PagSeguro.
        $paymentRequest->addPaymentMethodConfig('CREDIT_CARD', 1.00, 'DISCOUNT_PERCENT');
        $paymentRequest->addPaymentMethodConfig('EFT', 2.90, 'DISCOUNT_PERCENT');
        $paymentRequest->addPaymentMethodConfig('BOLETO', 10.00, 'DISCOUNT_PERCENT');
        $paymentRequest->addPaymentMethodConfig('DEPOSIT', 3.45, 'DISCOUNT_PERCENT');
        $paymentRequest->addPaymentMethodConfig('BALANCE', 0.01, 'DISCOUNT_PERCENT');
        
        $config = $this->getServiceLocator()->get('Config');

        $credentialsConfig = $config['PagSeguro'];

        $credentialsConfig['credentials']['email'];
        $credentialsConfig['credentials']['token']['production'];


        try {

            // $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()
            $credentials = new PagSeguroAccountCredentials($credentialsConfig['credentials']['email'], $credentialsConfig['credentials']['token']['production']);

            $checkoutUrl = $paymentRequest->register($credentials);

            $this->redirect()->toUrl($checkoutUrl);


        } catch (\PagSeguroServiceException $e) {
            die($e->getMessage());
        }

        return new ViewModel(array('data' => $checkoutUrl));
    }

}