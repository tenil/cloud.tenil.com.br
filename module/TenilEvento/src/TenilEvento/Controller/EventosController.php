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
use TenilEvento\Form\Retorno;
use Zend\Filter\File\RenameUpload;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use TenilBase\Controller\CrudController;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;



class EventosController extends CrudController
{

    public function __construct()
    {
        $this->controller = 'eventos';
        $this->entity = 'TenilEvento\Entity\Evento';
        $this->form = 'TenilEvento\Form\EventoCreate';
        $this->formEdit = 'TenilEvento\Form\EventoEdit';
        $this->route = 'tenil-evento/default';
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
                    $service = $this->getServiceLocator()->get('TenilEvento\Service\Boleto');
                    $boleto = $service->gerarBoleto(array(
                        'inscricao' => $inscricao->getId(),
                    ));
                    // GERAR BOLETO AQUI - FIM

                    /**
                     * @todo Disparar e-mail com todos os dados
                     */

                    $data = array(
                        'email' => $inscricao->getEmail(),
                        'inscricao' => $inscricao->getId(),
                        'nome' => $inscricao->getNome(),
                        'cpf' => $inscricao->getCpf(),
                        'evento' => $inscricao->getEvento()->getNome(),
                        'valor' => $inscricao->getEvento()->getValorInscricao(),
                        'slug' => $inscricao->getEvento()->getSlug(),
                    );
                    $serviceEvento = $this->getServiceLocator()->get('TenilEvento\Service\Evento');
                    $serviceEvento->dispararEmail($data);

                    /**
                     * @todo Redirecionar para página de inscrição efetuada com sucesso.
                     * @todo Clicar em gerar boleto
                     */


                    $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Inscrição realizada com sucesso!');
                    return $this->redirect()->toRoute($this->route, array('action' => 'inscricao', 'id' => $inscricao->getId(), 'cpf' => $inscricao->getCpf()));

                } else {
                    $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage('Preencha todos os valores corretamente!');
                }

            }

            return new ViewModel(array('form' => $form, 'data' => $evento));
        } else {
            return $this->notFoundAction();
        }

    }

    /**
     * @return ViewModel
     * @todo Receber id do boleto (nossoNumero) e exibir boleto
     */
    public function boletoAction()
    {
        $id = $this->params()->fromRoute('id', null);
        $cpf = $this->params()->fromRoute('cpf', null);
        $inscricao = $this->getEm()->getRepository('TenilEvento\Entity\Inscricao')->findOneBy(array('id' => $id, 'cpf' => $cpf));

        if ($inscricao) {

            $data = array(
                'documento' => $this->mask($inscricao->getCpf(), '###.###.###-##'), // '123.456.789-09',
                'nome' => $inscricao->getNome(), // 'Roberto Tenil',
                'endereco1' => $inscricao->getLogradouro() . ', ' . $inscricao->getNumero(), // 'Rua das Gretrudes, 25 - Apartamento 522',
                'endereco2' => $inscricao->getBairro() . ' - ' . $inscricao->getLocalidade() . ' - ' . $inscricao->getUf() . ' CEP:' . $inscricao->getCep(), //'Bairro Blaster - São Paulo - SP',
                'dataVencimento' => $inscricao->getBoleto()->getDataVencimento()->format("d/m/Y"),
                'dataDocumento' => date("d/m/Y"),
                'dataProcessamento' => $inscricao->getBoleto()->getDataProcessamento()->format("d/m/Y"),
                'nossoNumero' => $inscricao->getBoleto()->getNossoNumero(),
                'numeroDocumento' => $inscricao->getBoleto()->getNumeroDocumento(),
                'valor' => $val = $inscricao->getBoleto()->getValorBoleto() * 100, // $val = rand(1000, 2000) * 100,
                'valorUnitario' => $val,
                'quantidade' => 1,
                'demonstrativo1' => 'Referente à inscrição no evento:', // 'Dados do produto ou serviço que foi vendido',
                'demonstrativo2' => substr($inscricao->getEvento(), 0, 50),// 'que deve ser aproveitado em 3 únicas linhas de ',
                'demonstrativo3' => null, //'até 50 caracteres',
                'instrucoes1' => $inscricao->getBoleto()->getInstrucoes1(),
                'instrucoes2' => $inscricao->getBoleto()->getInstrucoes2(),
                'instrucoes3' => $inscricao->getBoleto()->getInstrucoes3(),
                'instrucoes4' => $inscricao->getBoleto()->getInstrucoes4(),
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

        } else {
            return $this->notFoundAction();
        }

    }

    public function inscricaoAction()
    {
        $id = $this->params()->fromRoute('id', null);
        $cpf = $this->params()->fromRoute('cpf', null);
        $data = $this->getEm()->getRepository('TenilEvento\Entity\Inscricao')->findOneBy(array('id' => $id, 'cpf' => $cpf));

        if ($data) {
            return new ViewModel(array('data' => $data));
        } else {
            return $this->notFoundAction();
        }

    }

    public function inscricoesAction()
    {
        $id = $this->params()->fromRoute('id', null);
        $data = $this->getEm()->getRepository($this->entity)->findOneBy(array('slug' => $id));
        if ($data) {
            return new ViewModel(array('data' => $data));
        } else {
            return $this->notFoundAction();
        }
    }

    public function retornoAction()
    {

        $form = new Retorno();

        $request = $this->getRequest();

        if ($request->isPost()) {
            // Make certain to merge the files info!
            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                // Inserir no banco... etc...

                $arquivo = $data['arquivo']['tmp_name'];

                // Processar arquivo
                $service = $this->getServiceLocator()->get('TenilBoleto\Service\Boleto');
                $resposta = $service->processarRetorno($arquivo);
                // Processar arquivo - FIM

                var_dump($resposta);



                $this->flashMessenger()->setNamespace('Tenil')->addSuccessMessage('Arquivo enviado e processado com sucesso.');

                // Form is valid, save the form!
                return $this->redirect()->toRoute($this->route, array('action' => 'retorno'));
            } else {
                $this->flashMessenger()->setNamespace('Tenil')->addErrorMessage('Erro ao enviar o arquivo.');
            }

        }

        return array('form' => $form);

    }

    private function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

}