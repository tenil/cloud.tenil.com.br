<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 01/04/2016
 * Time: 15:15
 */

namespace TenilBoleto\Service;


use \ManoelCampos\RetornoBoleto\LeituraArquivo;
use \ManoelCampos\RetornoBoleto\RetornoFactory;
use \ManoelCampos\RetornoBoleto\RetornoInterface;
use \ManoelCampos\RetornoBoleto\LinhaArquivo;

use Doctrine\ORM\EntityManager;
use TenilBoleto\Entity\BoletoRetorno;

class Boleto
{

    /**
     *
     * @var EntityManager
     */
    protected $em;
    protected $entity;
    private $data = array();

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->entity = 'TenilEvento\Entity\Boleto';
    }

    public function processarRetorno($caminho)
    {

        if (file_exists($caminho)) {

            //$boletos = $this->em->getRepository($this->entity)->findAll();

            $processarLinha1 = function (RetornoInterface $retorno, LinhaArquivo $linha) {

                    if($linha->dados["registro"] == $retorno->getIdDetalhe()) { // Verifica se é linha detalhe

                        $nossoNumero = (int) substr($linha->dados['nosso_numero'], 0, -1);


                        $boleto = $this->em->getRepository($this->entity)->findOneBy(array('nossoNumero' => $nossoNumero));
                        
                        if($boleto){

                            $retorno = new BoletoRetorno();

                            $retorno->setRegistro($linha->dados['registro']);
                            $retorno->setTipoInscrEmpresa($linha->dados['tipo_inscr_empresa']);
                            $retorno->setNumInscrEmpresa($linha->dados['num_inscr_empresa']);
                            $retorno->setIdEmpresaBanco($linha->dados['id_empresa_banco']);
                            $retorno->setNumControlePart($linha->dados['num_controle_part']);
                            $retorno->setNossoNumero($nossoNumero);
                            $retorno->setNossoNumeroDv((int) substr($linha->dados['nosso_numero'], -1));
                            $retorno->setIdRateioCredito($linha->dados['id_rateio_credito']);
                            $retorno->setCarteira($linha->dados['carteira']);
                            $retorno->setIdOcorrencia($linha->dados['id_ocorrencia']);
                            $retorno->setDataPagamento(\DateTime::createFromFormat('d/m/Y', $linha->dados['data_pagamento']));
                            $retorno->setNumDocumento($linha->dados['num_documento']);
                            $retorno->setDataVencimento(\DateTime::createFromFormat('d/m/Y', $linha->dados['data_vencimento']));
                            $retorno->setValorTitulo($linha->dados['valor_titulo']);
                            $retorno->setCodBanco($linha->dados['cod_banco']);
                            $retorno->setAgencia($linha->dados['agencia']);
                            $retorno->setDespCobranca($linha->dados['desp_cobranca']);
                            $retorno->setOutrasDespesas($linha->dados['outras_despesas']);
                            $retorno->setJurosAtraso($linha->dados['juros_atraso']);
                            $retorno->setIof($linha->dados['iof']);
                            $retorno->setDescontoConcedido($linha->dados['desconto_concedido']);
                            $retorno->setValorRecebido($linha->dados['valor_recebido']);
                            $retorno->setJurosMora($linha->dados['juros_mora']);
                            $retorno->setOutrosRecebimentos($linha->dados['outros_recebimentos']);
                            $retorno->setMotivoCodOcorrencia($linha->dados['motivo_cod_ocorrencia']);
                            $retorno->setNumCartorio($linha->dados['num_cartorio']);
                            $retorno->setNumProtocolo($linha->dados['num_protocolo']);
                            $retorno->setValorAbatimento($linha->dados['valor_abatimento']);
                            $retorno->setAbatimentoNaoAprov($linha->dados['abatimento_nao_aprov']);
                            $retorno->setValorPagamento($linha->dados['valor_pagamento']);
                            $retorno->setIndicativoDc($linha->dados['indicativo_dc']);
                            $retorno->setIndicadorValor($linha->dados['indicador_valor']);
                            $retorno->setValorAjuste($linha->dados['valor_ajuste']);
                            $retorno->setSequencial($linha->dados['sequencial']);

                            $retorno->setBoleto($boleto);
                            $boleto->setRetorno($retorno);

                            $this->em->persist($boleto);
                            $this->em->flush();
                            return $retorno;
                            
                            
                        }


                    }

                return true;

            };

            $fileName = $caminho;

            $cnab400 = RetornoFactory::getRetorno($fileName);

            $leitura = new LeituraArquivo($processarLinha1, $cnab400);

            $leitura->lerArquivoRetorno();


        } else {

            throw new \Exception("O nome do arquivo não pode ser NULL nem vazio.");

        }
        return $this->data;
    }


}