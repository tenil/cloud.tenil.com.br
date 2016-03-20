<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 15/05/2015
 * Time: 13:24
 */

namespace TenilEvento\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Inscricao
 *
 * @ORM\Table(name="tenilevento_inscricao")
 * @ORM\Entity(repositoryClass="TenilEvento\Entity\InscricaoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Inscricao
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Evento")
     * @ORM\JoinColumn(name="id_evento", referencedColumnName="id")
     **/
    protected $evento;

    /**
     * @ORM\OneToOne(targetEntity="Boleto", mappedBy="pagador")
     */
    private $boleto;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=512, nullable=false)
     */
    protected $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=512)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=512)
     */
    protected $cpf;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_nascimento", type="date")
     */
    protected $dataNascimento;

    /**
     * @var string
     * @ORM\Column(name="fone_fixo", type="string", length=11, nullable=true)
     */
    protected $foneFixo;

    /**
     * @var string
     * @ORM\Column(name="fone_celular", type="string", length=11, nullable=true)
     */
    protected $foneCelular;

    /**
     * @var string
     * @ORM\Column(name="end_logradouro", type="string", length=255, nullable=true)
     */
    protected $logradouro;

    /**
     * @var string
     * @ORM\Column(name="end_numero", type="string", length=5, nullable=true)
     */
    protected $numero;

    /**
     * @var string
     * @ORM\Column(name="end_complemento", type="string", length=45, nullable=true)
     */
    protected $complemento;

    /**
     * @var string
     * @ORM\Column(name="end_bairro", type="string", length=255, nullable=true)
     */
    protected $bairro;

    /**
     * @var string
     * @ORM\Column(name="end_localidade", type="string", length=255, nullable=true)
     */
    protected $localidade;

    /**
     * @var string
     * @ORM\Column(name="end_uf", type="string", length=2, nullable=true)
     */
    protected $uf;

    /**
     * @var string
     * @ORM\Column(name="end_cep", type="string", length=8, nullable=true)
     */
    protected $cep;

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
     * Inscricao constructor.
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
        return $this->nome;
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
     * @return Inscricao
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Evento
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * @param Evento $evento
     * @return Inscricao
     */
    public function setEvento(Evento $evento)
    {
        $this->evento = $evento;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Inscricao
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Inscricao
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return Inscricao
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * @param DateTime $dataNascimento
     * @return Inscricao
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
        return $this;
    }

    /**
     * @return string
     */
    public function getFoneFixo()
    {
        return $this->foneFixo;
    }

    /**
     * @param string $foneFixo
     * @return Inscricao
     */
    public function setFoneFixo($foneFixo)
    {
        $this->foneFixo = $foneFixo;
        return $this;
    }

    /**
     * @return string
     */
    public function getFoneCelular()
    {
        return $this->foneCelular;
    }

    /**
     * @param string $foneCelular
     * @return Inscricao
     */
    public function setFoneCelular($foneCelular)
    {
        $this->foneCelular = $foneCelular;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param string $logradouro
     * @return Inscricao
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     * @return Inscricao
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return string
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param string $complemento
     * @return Inscricao
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
        return $this;
    }

    /**
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param string $bairro
     * @return Inscricao
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocalidade()
    {
        return $this->localidade;
    }

    /**
     * @param string $localidade
     * @return Inscricao
     */
    public function setLocalidade($localidade)
    {
        $this->localidade = $localidade;
        return $this;
    }

    /**
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param string $uf
     * @return Inscricao
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
        return $this;
    }

    /**
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param string $cep
     * @return Inscricao
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
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
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return Inscricao
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
     * @return Inscricao
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }


}