<?php

/**
 * @author Roberto
 */

namespace TenilEvento\Service;

use Doctrine\ORM\EntityManager;
use TenilBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Boleto extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        // Executa o método contrutor da classe pai.
        parent::__construct($em);
        $this->entity = 'TenilEvento\Entity\Boleto';
    }

    public function gerarBoleto(array $data)
    {
        $inscricao = $this->em->getReference('TenilEvento\Entity\Inscricao', $data['inscricao']);

        if ($inscricao) {

            $data = array(
                'documento' => $inscricao->getCpf(), // '123.456.789-09',
                'nome' => $inscricao->getNome(), // 'Roberto Tenil',
                'endereco1' => $inscricao->getLogradouro() . ', ' . $inscricao->getNumero(), // 'Rua das Gretrudes, 25 - Apartamento 522',
                'endereco2' => $inscricao->getBairro() . ' - ' . $inscricao->getLocalidade() . ' - ' . $inscricao->getUf(), //'Bairro Blaster - São Paulo - SP',
                'dataVencimento' => date("d/m/Y", strtotime('+1 week')),
                'dataDocumento' => date("d/m/Y"),
                'dataProcessamento' => date("d/m/Y"),
                // 'nossoNumero' => rand(100, 500),
                'nossoNumero' => $nossoNumero = str_pad($inscricao->getId(), 5, "0", STR_PAD_LEFT),
                'numeroDocumento' => rand(100, 500),
                'valor' => $val = $inscricao->getEvento()->getValorInscricao(), // $val = rand(1000, 2000) * 100,
                'valorUnitario' => $val,
                'quantidade' => 1,
                'demonstrativo1' => 'Referente à inscrição no evento:', // 'Dados do produto ou serviço que foi vendido',
                'demonstrativo2' => substr($inscricao->getEvento(), 0, 50) ,// 'que deve ser aproveitado em 3 únicas linhas de ',
                'demonstrativo3' => '', //'até 50 caracteres',
            );

        }

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));

        $entity = new $this->entity($data);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}
