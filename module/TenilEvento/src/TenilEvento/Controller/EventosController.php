<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 03/06/2015
 * Time: 14:27
 */

namespace TenilEvento\Controller;

use PhpBoletoZf2\Model\BoletoBradesco;
use PhpBoletoZf2\Model\Cedente;
use PhpBoletoZf2\Model\Sacado;
use TenilEvento\Entity\Inscricao;
use TenilEvento\Form\InscricaoCreate;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use TenilBase\Controller\CrudController;


class EventosController extends CrudController
{

    public function __construct()
    {
        $this->controller = 'eventos';
        $this->entity = 'TenilEvento\Entity\Evento';
        $this->form = 'TenilEvento\Form\EventoCreate';
        $this->route = 'tenil-evento';
        $this->service = 'TenilEvento\Service\Evento';
    }


    /**
     * @return ViewModel
     */
    public function detailAction()
    {
        $id = $this->params()->fromRoute('id', null);
        //$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        // $evento = $em->getRepository('TenilEvento\Entity\Evento')->find($id);
        $data = $this->getEm()->getRepository($this->entity)->findOneBy(array('slug' => $id));

        if ($data) {
            return new ViewModel(array('data' => $data));
        } else {
            return $this->notFoundAction();
        }

    }


    public function signupAction()
    {

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $form = new InscricaoCreate($objectManager);

        $id = $this->params()->fromRoute('id', null);

        $evento = $this->getEm()->getRepository($this->entity)->findOneBy(array('slug' => $id));

        if ($evento) {

            $inscricao = new Inscricao();
            $inscricao->setEvento($evento);

            $form->bind($inscricao);

            if ($this->request->isPost()) {
                $form->setData($this->request->getPost());

                if ($form->isValid()) {
                    $objectManager->persist($inscricao);
                    $objectManager->flush();

                    // GERAR BOLETO AQUI


                    $service = $this->getServiceLocator()->get('TenilEvento\Service\Evento');
                    $service->gerarBoleto(array(
                        'inscricao' => $inscricao->getId(),
                        //'valor' =>
                    ));


                    // GERAR BOLETO AQUI - FIM

                    $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Cadastro realizado com sucesso!');
                    return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => 'list'));

                } else {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage('Preencha todos os valores corretamente!');
                }

            }

            return new ViewModel(array('form' => $form, 'data' => $evento));
        } else {
            return $this->notFoundAction();
        }

    }

    public function boletoAction()
    {
        // recebendo os dados do boleto, seja por REQUEST ou Banco de Dados
        // $data = array(/** dados para emissão do boleto **/);

        // $config = $this->getServiceLocator()->get('Config');
        // $dataBradesco = $config['php-zf2-boleto']['237']['dados_cedente'];

        $data = array(
            'documento' => '123.456.789-09',
            'nome' => 'Roberto Tenil',
            'endereco1' => 'Rua das Gretrudes, 25 - Apartamento 522',
            'endereco2' => 'Bairro Blaster - São Paulo - SP',
            'dataVencimento' => date("d/m/Y", strtotime('+1 week')),
            'dataDocumento' => date("d/m/Y"),
            'dataProcessamento' => date("d/m/Y"),
            'nossoNumero' => rand(100, 500),
            'numeroDocumento' => rand(100, 500),
            'valor' => $val = rand(1000, 2000) * 100,
            'valorUnitario' => $val,
            'quantidade' => 1,
            'demonstrativo1' => 'Dados do produto ou serviço que foi vendido',
            'demonstrativo2' => 'que deve ser aproveitado em 3 únicas linhas de ',
            'demonstrativo3' => 'até 50 caracteres',
        );

        // Instanciando as classes relacionadas ao boleto
        $boleto = new BoletoBradesco($data);
        $sacado = new Sacado($data);
        // $cedente = new Cedente($dataBradesco);

        // chamando o serviço para criação do boleto
        $bradesco = $this->getServiceLocator()
            ->get('Boleto\Bradesco')
            ->setSacado($sacado)
            //    ->setCedente($cedente)
            ->setBoleto($boleto);
        $dados = $bradesco->prepare();

        // montando a view
        $view = new ViewModel(array("dados" => $dados));
        $view->setTerminal(true); // elimina o layout
        $view->setTemplate("/php-boleto-zf2/bradesco/index");

        return $view;
    }

}