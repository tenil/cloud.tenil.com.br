<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 04/04/2016
 * Time: 13:24
 */

namespace TenilBoleto\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\DBAL\Types\DecimalType;

/**
 * BoletoRetorno
 *
 * @ORM\Table(name="tenilevento_boleto_retorno")
 * @ORM\Entity(repositoryClass="TenilBoleto\Entity\BoletoRetornoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class BoletoRetorno
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="TenilEvento\Entity\Boleto", mappedBy="retorno")
     * @ORM\JoinColumn(name="id_boleto", referencedColumnName="id")
     */
    protected $boleto;

    /**
     * @var string
     * @ORM\Column(name="registro", type="string", length=1, nullable=true)
     */
    protected $registro;

    /**
     * @var string
     * @ORM\Column(name="tipo_inscr_empresa", type="string", length=2, nullable=true)
     */
    protected $tipoInscrEmpresa;

    /**
     * @var string
     * @ORM\Column(name="num_inscr_empresa", type="string", length=14, nullable=true)
     */
    protected $numInscrEmpresa;

    /**
     * @var string
     * @ORM\Column(name="id_empresa_banco", type="string", length=17, nullable=true)
     */
    protected $idEmpresaBanco;

    /**
     * @var string
     * @ORM\Column(name="num_controle_part", type="string", length=25, nullable=true)
     */
    protected $numControlePart;

    /**
     * @var string
     * @ORM\Column(name="nosso_numero", type="integer", nullable=false)
     */
    protected $nossoNumero;

    /**
     * @var string
     * @ORM\Column(name="nosso_numero_dv", type="string", length=1, nullable=false)
     */
    protected $nossoNumeroDv;

    /**
     * @var string
     * @ORM\Column(name="id_rateio_credito", type="string", length=1, nullable=true)
     */
    protected $idRateioCredito;

    /**
     * @var string
     * @ORM\Column(name="carteira", type="string", length=1, nullable=true)
     */
    protected $carteira;

    /**
     * @var string
     * @ORM\Column(name="id_ocorrencia", type="string", length=2, nullable=true)
     */
    protected $idOcorrencia;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_pagamento", type="date")
     */
    protected $dataPagamento;

    /**
     * @var string
     * @ORM\Column(name="num_documento", type="string", length=10, nullable=true)
     */
    protected $numDocumento;


    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_vencimento", type="date")
     */
    protected $dataVencimento;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="valor_titulo", type="decimal", precision=13, scale=2)
     */
    protected $valorTitulo;

    /**
     * @var string
     * @ORM\Column(name="cod_banco", type="string", length=3, nullable=true)
     */
    protected $codBanco;

    /**
     * @var string
     * @ORM\Column(name="agencia", type="string", length=5, nullable=true)
     */
    protected $agencia;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="desp_cobranca", type="decimal", precision=13, scale=2)
     */
    protected $despCobranca;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="outras_despesas", type="decimal", precision=13, scale=2)
     */
    protected $outrasDespesas;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="juros_atraso", type="decimal", precision=13, scale=2)
     */
    protected $jurosAtraso;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="iof", type="decimal", precision=13, scale=2)
     */
    protected $iof;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="desconto_concedido", type="decimal", precision=13, scale=2)
     */
    protected $descontoConcedido;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="valor_recebido", type="decimal", precision=13, scale=2)
     */
    protected $valorRecebido;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="juros_mora", type="decimal", precision=13, scale=2)
     */
    protected $jurosMora;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="outros_recebimentos", type="decimal", precision=13, scale=2)
     */
    protected $outrosRecebimentos;

    /**
     * @var string
     * @ORM\Column(name="motivo_cod_ocorrencia", type="string", length=10, nullable=true)
     */
    protected $motivoCodOcorrencia;

    /**
     * @var string
     * @ORM\Column(name="num_cartorio", type="string", length=2, nullable=true)
     */
    protected $numCartorio;

    /**
     * @var string
     * @ORM\Column(name="num_protocolo", type="string", length=10, nullable=true)
     */
    protected $numProtocolo;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="valor_abatimento", type="decimal", precision=13, scale=2)
     */
    protected $valorAbatimento;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="abatimento_nao_aprov", type="decimal", precision=13, scale=2)
     */
    protected $abatimentoNaoAprov;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="valor_pagamento", type="decimal", precision=13, scale=2)
     */
    protected $valorPagamento;

    /**
     * @var string
     * @ORM\Column(name="indicativo_dc", type="string", length=1, nullable=true)
     */
    protected $indicativoDc;

    /**
     * @var string
     * @ORM\Column(name="indicador_valor", type="string", length=1, nullable=true)
     */
    protected $indicadorValor;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="valor_ajuste", type="decimal", precision=13, scale=2)
     */
    protected $valorAjuste;

    /**
     * @var string
     * @ORM\Column(name="sequencial", type="string", length=6, nullable=true)
     */
    protected $sequencial;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * BoletoRetorno constructor.
     */
    public function __construct()
    {
        $this->createdAt = new DateTime("now");
        $this->updatedAt = new DateTime("now");
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->nossoNumero;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return BoletoRetorno
     * @ORM\PreUpdate
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return BoletoRetorno
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BoletoRetorno
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBoleto()
    {
        return $this->boleto;
    }

    /**
     * @param mixed $boleto
     * @return BoletoRetorno
     */
    public function setBoleto(\TenilEvento\Entity\Boleto $boleto)
    {
        $this->boleto = $boleto;
        return $this;
    }




    /**
     * @return string
     */
    public function getRegistro()
    {
        return $this->registro;
    }

    /**
     * @param string $registro
     * @return BoletoRetorno
     */
    public function setRegistro($registro)
    {
        $this->registro = $registro;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipoInscrEmpresa()
    {
        return $this->tipoInscrEmpresa;
    }

    /**
     * @param string $tipoInscrEmpresa
     * @return BoletoRetorno
     */
    public function setTipoInscrEmpresa($tipoInscrEmpresa)
    {
        $this->tipoInscrEmpresa = $tipoInscrEmpresa;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumInscrEmpresa()
    {
        return $this->numInscrEmpresa;
    }

    /**
     * @param string $numInscrEmpresa
     * @return BoletoRetorno
     */
    public function setNumInscrEmpresa($numInscrEmpresa)
    {
        $this->numInscrEmpresa = $numInscrEmpresa;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdEmpresaBanco()
    {
        return $this->idEmpresaBanco;
    }

    /**
     * @param string $idEmpresaBanco
     * @return BoletoRetorno
     */
    public function setIdEmpresaBanco($idEmpresaBanco)
    {
        $this->idEmpresaBanco = $idEmpresaBanco;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumControlePart()
    {
        return $this->numControlePart;
    }

    /**
     * @param string $numControlePart
     * @return BoletoRetorno
     */
    public function setNumControlePart($numControlePart)
    {
        $this->numControlePart = $numControlePart;
        return $this;
    }

    /**
     * @return string
     */
    public function getNossoNumero()
    {
        return $this->nossoNumero;
    }

    /**
     * @param string $nossoNumero
     * @return BoletoRetorno
     */
    public function setNossoNumero($nossoNumero)
    {
        $this->nossoNumero = $nossoNumero;
        return $this;
    }

    /**
     * @return string
     */
    public function getNossoNumeroDv()
    {
        return $this->nossoNumeroDv;
    }

    /**
     * @param string $nossoNumeroDv
     * @return BoletoRetorno
     */
    public function setNossoNumeroDv($nossoNumeroDv)
    {
        $this->nossoNumeroDv = $nossoNumeroDv;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdRateioCredito()
    {
        return $this->idRateioCredito;
    }

    /**
     * @param string $idRateioCredito
     * @return BoletoRetorno
     */
    public function setIdRateioCredito($idRateioCredito)
    {
        $this->idRateioCredito = $idRateioCredito;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarteira()
    {
        return $this->carteira;
    }

    /**
     * @param string $carteira
     * @return BoletoRetorno
     */
    public function setCarteira($carteira)
    {
        $this->carteira = $carteira;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdOcorrencia()
    {
        return $this->idOcorrencia;
    }

    /**
     * @param string $idOcorrencia
     * @return BoletoRetorno
     */
    public function setIdOcorrencia($idOcorrencia)
    {
        $this->idOcorrencia = $idOcorrencia;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataPagamento()
    {
        return $this->dataPagamento;
    }

    /**
     * @param DateTime $dataPagamento
     * @return BoletoRetorno
     */
    public function setDataPagamento($dataPagamento)
    {
        $this->dataPagamento = $dataPagamento;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumDocumento()
    {
        return $this->numDocumento;
    }

    /**
     * @param string $numDocumento
     * @return BoletoRetorno
     */
    public function setNumDocumento($numDocumento)
    {
        $this->numDocumento = $numDocumento;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataVencimento()
    {
        return $this->dataVencimento;
    }

    /**
     * @param DateTime $dataVencimento
     * @return BoletoRetorno
     */
    public function setDataVencimento($dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getValorTitulo()
    {
        return $this->valorTitulo;
    }

    /**
     * @param DecimalType $valorTitulo
     * @return BoletoRetorno
     */
    public function setValorTitulo($valorTitulo)
    {
        $this->valorTitulo = $valorTitulo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCodBanco()
    {
        return $this->codBanco;
    }

    /**
     * @param string $codBanco
     * @return BoletoRetorno
     */
    public function setCodBanco($codBanco)
    {
        $this->codBanco = $codBanco;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * @param string $agencia
     * @return BoletoRetorno
     */
    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getDespCobranca()
    {
        return $this->despCobranca;
    }

    /**
     * @param DecimalType $despCobranca
     * @return BoletoRetorno
     */
    public function setDespCobranca($despCobranca)
    {
        $this->despCobranca = $despCobranca;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getOutrasDespesas()
    {
        return $this->outrasDespesas;
    }

    /**
     * @param DecimalType $outrasDespesas
     * @return BoletoRetorno
     */
    public function setOutrasDespesas($outrasDespesas)
    {
        $this->outrasDespesas = $outrasDespesas;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getJurosAtraso()
    {
        return $this->jurosAtraso;
    }

    /**
     * @param DecimalType $jurosAtraso
     * @return BoletoRetorno
     */
    public function setJurosAtraso($jurosAtraso)
    {
        $this->jurosAtraso = $jurosAtraso;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getIof()
    {
        return $this->iof;
    }

    /**
     * @param DecimalType $iof
     * @return BoletoRetorno
     */
    public function setIof($iof)
    {
        $this->iof = $iof;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getDescontoConcedido()
    {
        return $this->descontoConcedido;
    }

    /**
     * @param DecimalType $descontoConcedido
     * @return BoletoRetorno
     */
    public function setDescontoConcedido($descontoConcedido)
    {
        $this->descontoConcedido = $descontoConcedido;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getValorRecebido()
    {
        return $this->valorRecebido;
    }

    /**
     * @param DecimalType $valorRecebido
     * @return BoletoRetorno
     */
    public function setValorRecebido($valorRecebido)
    {
        $this->valorRecebido = $valorRecebido;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getJurosMora()
    {
        return $this->jurosMora;
    }

    /**
     * @param DecimalType $jurosMora
     * @return BoletoRetorno
     */
    public function setJurosMora($jurosMora)
    {
        $this->jurosMora = $jurosMora;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getOutrosRecebimentos()
    {
        return $this->outrosRecebimentos;
    }

    /**
     * @param DecimalType $outrosRecebimentos
     * @return BoletoRetorno
     */
    public function setOutrosRecebimentos($outrosRecebimentos)
    {
        $this->outrosRecebimentos = $outrosRecebimentos;
        return $this;
    }

    /**
     * @return string
     */
    public function getMotivoCodOcorrencia()
    {
        return $this->motivoCodOcorrencia;
    }

    /**
     * @param string $motivoCodOcorrencia
     * @return BoletoRetorno
     */
    public function setMotivoCodOcorrencia($motivoCodOcorrencia)
    {
        $this->motivoCodOcorrencia = $motivoCodOcorrencia;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumCartorio()
    {
        return $this->numCartorio;
    }

    /**
     * @param string $numCartorio
     * @return BoletoRetorno
     */
    public function setNumCartorio($numCartorio)
    {
        $this->numCartorio = $numCartorio;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumProtocolo()
    {
        return $this->numProtocolo;
    }

    /**
     * @param string $numProtocolo
     * @return BoletoRetorno
     */
    public function setNumProtocolo($numProtocolo)
    {
        $this->numProtocolo = $numProtocolo;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getValorAbatimento()
    {
        return $this->valorAbatimento;
    }

    /**
     * @param DecimalType $valorAbatimento
     * @return BoletoRetorno
     */
    public function setValorAbatimento($valorAbatimento)
    {
        $this->valorAbatimento = $valorAbatimento;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getAbatimentoNaoAprov()
    {
        return $this->abatimentoNaoAprov;
    }

    /**
     * @param DecimalType $abatimentoNaoAprov
     * @return BoletoRetorno
     */
    public function setAbatimentoNaoAprov($abatimentoNaoAprov)
    {
        $this->abatimentoNaoAprov = $abatimentoNaoAprov;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getValorPagamento()
    {
        return $this->valorPagamento;
    }

    /**
     * @param DecimalType $valorPagamento
     * @return BoletoRetorno
     */
    public function setValorPagamento($valorPagamento)
    {
        $this->valorPagamento = $valorPagamento;
        return $this;
    }

    /**
     * @return string
     */
    public function getIndicativoDc()
    {
        return $this->indicativoDc;
    }

    /**
     * @param string $indicativoDc
     * @return BoletoRetorno
     */
    public function setIndicativoDc($indicativoDc)
    {
        $this->indicativoDc = $indicativoDc;
        return $this;
    }

    /**
     * @return string
     */
    public function getIndicadorValor()
    {
        return $this->indicadorValor;
    }

    /**
     * @param string $indicadorValor
     * @return BoletoRetorno
     */
    public function setIndicadorValor($indicadorValor)
    {
        $this->indicadorValor = $indicadorValor;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getValorAjuste()
    {
        return $this->valorAjuste;
    }

    /**
     * @param DecimalType $valorAjuste
     * @return BoletoRetorno
     */
    public function setValorAjuste($valorAjuste)
    {
        $this->valorAjuste = $valorAjuste;
        return $this;
    }

    /**
     * @return string
     */
    public function getSequencial()
    {
        return $this->sequencial;
    }

    /**
     * @param string $sequencial
     * @return BoletoRetorno
     */
    public function setSequencial($sequencial)
    {
        $this->sequencial = $sequencial;
        return $this;
    }


}