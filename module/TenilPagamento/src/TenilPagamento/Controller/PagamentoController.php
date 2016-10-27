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

use Zend\Math\Rand;


use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Production;
use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;
use PHPSC\PagSeguro\Purchases\Transactions\Locator;

class PagamentoController extends AbstractActionController
{

    private function getCredentials()
    {
        $config = $this->getServiceLocator()->get('Config');
        $credentialsConfig = $config['PagSeguro'];

        $email = $credentialsConfig['credentials']['email'];
        $token = $credentialsConfig['credentials']['token']['sandbox'];

        return new Credentials(
            $email,
            $token,
            new Sandbox()
        );
    }

    public function indexAction()
    {

        $paymentRequest = new PagSeguroPaymentRequest();
        $paymentRequest->addItem('0001', 'Notebook', 1, 130.00);
        $paymentRequest->addItem('0002', 'Mochila', 1, 150.99);

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

    public function testSandboxAction()
    {

        try {
            $service = new CheckoutService($this->getCredentials()); // cria instância do serviço de pagamentos

            $checkout = $service->createCheckoutBuilder()
                ->addItem(new Item(1, $string = Rand::getString(32, 'abcdefghijklmnopqrstuvwxyz', true), $float = Rand::getFloat() * 100))
                ->addItem(new Item(2, $string2 = Rand::getString(32, 'abcdefghijklmnopqrstuvwxyz', true), $float = Rand::getFloat() * 100))
                ->getCheckout();

            $response = $service->checkout($checkout);

            //Se você quer usar uma url de retorno
            $checkout->setRedirectTo($this->url('tenil-pagamento', array('action' => 'retorno')));

            //Se você quer usar uma url de notificação
            $checkout->setNotificationURL($this->url('tenil-pagamento', array('action' => 'notificacao')));

            header('Location: ' . $response->getRedirectionUrl()); // Redireciona o usuário
        } catch (Exception $error) { // Caso ocorreu algum erro
            echo $error->getMessage(); // Exibe na tela a mensagem de erro
        }


    }

    public function transacaoAction()
    {

        try {
            $service = new Locator($this->getCredentials()); // Cria instância do serviço de localização de transações

            $transaction = $service->getByCode('2C5C65F1262D47E985566E24D87AC1EA');

            var_dump($transaction); die;// Exibe na tela a transação
        } catch (Exception $error) { // Caso ocorreu algum erro
            echo $error->getMessage(); // Exibe na tela a mensagem de erro
        }
    }

}