<?php

/**
 * @author Roberto
 */

namespace TenilEvento\Service;

use Doctrine\ORM\EntityManager;
use TenilBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class Boleto extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        // Executa o método contrutor da classe pai.
        parent::__construct($em);
        $this->entity = 'TenilEvento\Entity\Boleto';
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     * @TODO Gravar boleto no banco de dados
     */
    public function gerarBoleto(array $data)
    {
        $inscricao = $this->em->getReference('TenilEvento\Entity\Inscricao', $data['inscricao']);

        /**
         * Dados para gerar o boleto, vem do banco, na exibição
         * Aqui vamos apenas fazer inclusão no banco de dados
         */
        $data = array(
            'dataProcessamento' => date('Y-m-d'),
            'dataVencimento' => date('Y-m-d', strtotime('+1 week')),
            'demonstrativo1' => 'Referente à inscrição no evento:', // 'Dados do produto ou serviço que foi vendido',
            'demonstrativo2' => substr($inscricao->getEvento(), 0, 50),// 'que deve ser aproveitado em 3 únicas linhas de ',
            'demonstrativo3' => 'O não pagamento cancelará a inscrição.', //'até 50 caracteres',
            'instrucoes1' => 'Sr. Caixa, não receber após o vencimento.', //'até 50 caracteres',
            'instrucoes2' => '', //'até 50 caracteres',
            'instrucoes3' => '', //'até 50 caracteres',
            'instrucoes4' => '', //'até 50 caracteres',
            'nossoNumero' => $inscricao->getId(),
            'numeroDocumento' => $inscricao->getId(),
            'pagador' => $inscricao,
            'valorBoleto' => $inscricao->getEvento()->getValorInscricao(),
        );

        $hydrator = new DoctrineHydrator($this->em);

        $entity = new $this->entity();

        $entity = $hydrator->hydrate($data, $entity);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

}
