<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 14/03/2016
 * Time: 13:24
 */

namespace TenilEvento\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\DBAL\Types\DecimalType;

/**
 * Boleto
 *
 * @ORM\Table(name="tenilevento_boleto")
 * @ORM\Entity(repositoryClass="TenilEvento\Entity\BoletoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Boleto
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
     *
     * @ORM\ManyToOne(targetEntity="Inscricao", inversedBy="boleto")
     * @ORM\JoinColumn(name="id_pagador", referencedColumnName="id")
     **/
    protected $pagador;

    /**
     * @ORM\OneToOne(targetEntity="TenilBoleto\Entity\BoletoRetorno", mappedBy="boleto", cascade={"persist"})
     */
    protected $retorno;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_vencimento", type="date")
     */
    protected $dataVencimento;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_processamento", type="date")
     */
    protected $dataProcessamento;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="valor_boleto", type="decimal", precision=10, scale=2)
     */
    protected $valorBoleto;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="valor_pago", type="decimal", nullable=true)
     */
    protected $valorPago;

    /**
     * @var integer
     * @ORM\Column(name="nosso_numero", type="integer", length=11)
     */
    protected $nossoNumero;

    /**
     * @var integer
     * @ORM\Column(name="numero_documento", type="integer", length=10, nullable=true)
     */
    protected $numeroDocumento;

    /**
     * @var string
     * @ORM\Column(name="demonstrativo_1", type="string", length=50, nullable=true)
     */
    protected $demonstrativo1;

    /**
     * @var string
     * @ORM\Column(name="demonstrativo_2", type="string", length=50, nullable=true)
     */
    protected $demonstrativo2;

    /**
     * @var string
     * @ORM\Column(name="demonstrativo_3", type="string", length=50, nullable=true)
     */
    protected $demonstrativo3;

    /**
     * @var string
     * @ORM\Column(name="instrucoes_1", type="string", length=50, nullable=true)
     */
    protected $instrucoes1;

    /**
     * @var string
     * @ORM\Column(name="instrucoes_2", type="string", length=50, nullable=true)
     */
    protected $instrucoes2;

    /**
     * @var string
     * @ORM\Column(name="instrucoes_3", type="string", length=50, nullable=true)
     */
    protected $instrucoes3;

    /**
     * @var string
     * @ORM\Column(name="instrucoes_4", type="string", length=50, nullable=true)
     */
    protected $instrucoes4;

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
     * Boleto constructor.
     */
    public function __construct()
    {
        $this->createdAt = new DateTime("now");
        $this->updatedAt = new DateTime("now");
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
     * @return Boleto
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Inscricao
     */
    public function getPagador()
    {
        return $this->pagador;
    }

    /**
     * @param Inscricao $pagador
     * @return Boleto
     */
    public function setPagador(Inscricao $pagador)
    {
        $this->pagador = $pagador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRetorno()
    {
        return $this->retorno;
    }

    /**
     * @param mixed $retorno
     * @return Boleto
     */
    public function setRetorno(\TenilBoleto\Entity\BoletoRetorno $retorno = null)
    {
        $this->retorno = $retorno;
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
     * @return Boleto
     */
    public function setDataVencimento($dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataProcessamento()
    {
        return $this->dataProcessamento;
    }

    /**
     * @param DateTime $dataProcessamento
     * @return Boleto
     */
    public function setDataProcessamento($dataProcessamento)
    {
        $this->dataProcessamento = $dataProcessamento;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getValorBoleto()
    {
        return $this->valorBoleto;
    }

    /**
     * @param DecimalType $valorBoleto
     * @return Boleto
     */
    public function setValorBoleto($valorBoleto)
    {
        $this->valorBoleto = $valorBoleto;
        return $this;
    }

    /**
     * @return DecimalType
     */
    public function getValorPago()
    {
        return $this->valorPago;
    }

    /**
     * @param DecimalType $valorPago
     * @return Boleto
     */
    public function setValorPago($valorPago)
    {
        $this->valorPago = $valorPago;
        return $this;
    }

    /**
     * @return int
     */
    public function getNossoNumero()
    {
        return $this->nossoNumero;
    }

    /**
     * @param int $nossoNumero
     * @return Boleto
     */
    public function setNossoNumero($nossoNumero)
    {
        $this->nossoNumero = $nossoNumero;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * @param int $numeroDocumento
     * @return Boleto
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;
        return $this;
    }

    /**
     * @return string
     */
    public function getDemonstrativo1()
    {
        return $this->demonstrativo1;
    }

    /**
     * @param string $demonstrativo1
     * @return Boleto
     */
    public function setDemonstrativo1($demonstrativo1)
    {
        $this->demonstrativo1 = $demonstrativo1;
        return $this;
    }

    /**
     * @return string
     */
    public function getDemonstrativo2()
    {
        return $this->demonstrativo2;
    }

    /**
     * @param string $demonstrativo2
     * @return Boleto
     */
    public function setDemonstrativo2($demonstrativo2)
    {
        $this->demonstrativo2 = $demonstrativo2;
        return $this;
    }

    /**
     * @return string
     */
    public function getDemonstrativo3()
    {
        return $this->demonstrativo3;
    }

    /**
     * @param string $demonstrativo3
     * @return Boleto
     */
    public function setDemonstrativo3($demonstrativo3)
    {
        $this->demonstrativo3 = $demonstrativo3;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstrucoes1()
    {
        return $this->instrucoes1;
    }

    /**
     * @param string $instrucoes1
     * @return Boleto
     */
    public function setInstrucoes1($instrucoes1)
    {
        $this->instrucoes1 = $instrucoes1;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstrucoes2()
    {
        return $this->instrucoes2;
    }

    /**
     * @param string $instrucoes2
     * @return Boleto
     */
    public function setInstrucoes2($instrucoes2)
    {
        $this->instrucoes2 = $instrucoes2;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstrucoes3()
    {
        return $this->instrucoes3;
    }

    /**
     * @param string $instrucoes3
     * @return Boleto
     */
    public function setInstrucoes3($instrucoes3)
    {
        $this->instrucoes3 = $instrucoes3;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstrucoes4()
    {
        return $this->instrucoes4;
    }

    /**
     * @param string $instrucoes4
     * @return Boleto
     */
    public function setInstrucoes4($instrucoes4)
    {
        $this->instrucoes4 = $instrucoes4;
        return $this;
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
     * @return Boleto
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
     * @return Boleto
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

}