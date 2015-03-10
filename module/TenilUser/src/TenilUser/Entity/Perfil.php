<?php

namespace TenilUser\Entity;

// Uso padrão do doctrine, criado na geração automática do arquivo por linha de comando.
use Doctrine\ORM\Mapping as ORM;
// Responsável por preencher os sets com os dados passados. Usado no construtor.
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity(repositoryClass="TenilUser\Entity\PerfilRepository")
 * @ORM\Table(name="teniluser_perfil")
 * @ORM\HasLifecycleCallbacks
 */
class Perfil {

    /**
     * @var Perfil 
     * @ORM\OneToOne(targetEntity="User", inversedBy="perfil")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    protected $nome;

    /**
     * @var string
     * @ORM\Column(name="sobrenome", type="string", length=255, nullable=true)
     */
    protected $sobrenome;

    /**
     * @ORM\OneToOne(targetEntity="TipoTratamento")
     * @ORM\JoinColumn(name="id_tratamento", referencedColumnName="id")
     */
    protected $tratamento;

    /**
     * @var boolean
     * @ORM\Column(name="is_gravatar", type="boolean", nullable=true)
     */
    protected $isGravatar = '0';

    /**
     * @var string
     * @ORM\Column(name="id_foto", type="string", length=45, nullable=true)
     */
    protected $foto;

    /**
     * @var string
     * @ORM\Column(name="fone_1_numero", type="string", length=10, nullable=true)
     */
    protected $fone1numero;

    /**
     * @var string
     * @ORM\Column(name="fone_1_ddd", type="string", length=2, nullable=true)
     */
    protected $fone1ddd;

    /**
     * @var integer
     * @ORM\OneToOne(targetEntity="TipoFone")
     * @ORM\JoinColumn(name="fone_1_tipo", referencedColumnName="id")
     */
    protected $fone1tipo;

    /**
     * @var string
     * @ORM\Column(name="fone_1_ramal", type="string", length=5, nullable=true)
     */
    protected $fone1ramal;

    /**
     * @var string
     * @ORM\Column(name="fone_1_contato", type="string", length=45, nullable=true)
     */
    protected $fone1contato;

    /**
     * @var string
     * @ORM\Column(name="fone_2_numero", type="string", length=10, nullable=true)
     */
    protected $fone2numero;

    /**
     * @var string
     * @ORM\Column(name="fone_2_ddd", type="string", length=2, nullable=true)
     */
    protected $fone2ddd;

    /**
     * @var integer
     * @ORM\OneToOne(targetEntity="TipoFone")
     * @ORM\JoinColumn(name="fone_2_tipo", referencedColumnName="id")
     */
    protected $fone2tipo;

    /**
     * @var string
     * @ORM\Column(name="fone_2_ramal", type="string", length=5, nullable=true)
     */
    protected $fone2ramal;

    /**
     * @var string
     * @ORM\Column(name="fone_2_contato", type="string", length=45, nullable=true)
     */
    protected $fone2contato;

    /**
     * @var string
     * @ORM\Column(name="fone_3_numero", type="string", length=10, nullable=true)
     */
    protected $fone3numero;

    /**
     * @var string
     * @ORM\Column(name="fone_3_ddd", type="string", length=2, nullable=true)
     */
    protected $fone3ddd;

    /**
     * @var integer
     * @ORM\OneToOne(targetEntity="TipoFone")
     * @ORM\JoinColumn(name="fone_3_tipo", referencedColumnName="id")
     */
    protected $fone3tipo;

    /**
     * @var string
     * @ORM\Column(name="fone_3_ramal", type="string", length=5, nullable=true)
     */
    protected $fone3ramal;

    /**
     * @var string
     * @ORM\Column(name="fone_3_contato", type="string", length=45, nullable=true)
     */
    protected $fone3contato;

    /**
     * @var string
     * @ORM\Column(name="endereco_logradouro", type="string", length=255, nullable=true)
     */
    protected $logradouro;

    /**
     * @var string
     * @ORM\Column(name="endereco_numero", type="string", length=5, nullable=true)
     */
    protected $numero;

    /**
     * @var string
     * @ORM\Column(name="endereco_complemento", type="string", length=45, nullable=true)
     */
    protected $complemento;

    /**
     * @var string
     * @ORM\Column(name="endereco_bairro", type="string", length=255, nullable=true)
     */
    protected $bairro;

    /**
     * @var string
     * @ORM\Column(name="endereco_localidade", type="string", length=255, nullable=true)
     */
    protected $localidade;

    /**
     * @var string
     * @ORM\Column(name="endereco_uf", type="string", length=2, nullable=true)
     */
    protected $uf;

    /**
     * @var string
     * @ORM\Column(name="endereco_cep", type="string", length=8, nullable=true)
     */
    protected $cep;

    public function __construct(array $options = array()) {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    function getUser() {
        return $this->user;
    }

    function setUser(Perfil $user) {
        $this->user = $user;
        return $this;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getTratamento() {
        return $this->tratamento;
    }

    function getIsGravatar() {
        return $this->isGravatar;
    }

    function getFoto() {
        return $this->foto;
    }

    function getFone1numero() {
        return $this->fone1numero;
    }

    function getFone1ddd() {
        return $this->fone1ddd;
    }

    function getFone1tipo() {
        return $this->fone1tipo;
    }

    function getFone1ramal() {
        return $this->fone1ramal;
    }

    function getFone1contato() {
        return $this->fone1contato;
    }

    function getFone2numero() {
        return $this->fone2numero;
    }

    function getFone2ddd() {
        return $this->fone2ddd;
    }

    function getFone2tipo() {
        return $this->fone2tipo;
    }

    function getFone2ramal() {
        return $this->fone2ramal;
    }

    function getFone2contato() {
        return $this->fone2contato;
    }

    function getFone3numero() {
        return $this->fone3numero;
    }

    function getFone3ddd() {
        return $this->fone3ddd;
    }

    function getFone3tipo() {
        return $this->fone3tipo;
    }

    function getFone3ramal() {
        return $this->fone3ramal;
    }

    function getFone3contato() {
        return $this->fone3contato;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getLocalidade() {
        return $this->localidade;
    }

    function getUf() {
        return $this->uf;
    }

    function getCep() {
        return $this->cep;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
        return $this;
    }

    function setTratamento($tratamento) {
        $this->tratamento = $tratamento;
        return $this;
    }

    function setIsGravatar($isGravatar) {
        $this->isGravatar = $isGravatar;
        return $this;
    }

    function setFoto($foto) {
        $this->foto = $foto;
        return $this;
    }

    function setFone1numero($fone1numero) {
        $this->fone1numero = $fone1numero;
        return $this;
    }

    function setFone1ddd($fone1ddd) {
        $this->fone1ddd = $fone1ddd;
        return $this;
    }

    function setFone1tipo($fone1tipo) {
        $this->fone1tipo = $fone1tipo;
        return $this;
    }

    function setFone1ramal($fone1ramal) {
        $this->fone1ramal = $fone1ramal;
        return $this;
    }

    function setFone1contato($fone1contato) {
        $this->fone1contato = $fone1contato;
        return $this;
    }

    function setFone2numero($fone2numero) {
        $this->fone2numero = $fone2numero;
        return $this;
    }

    function setFone2ddd($fone2ddd) {
        $this->fone2ddd = $fone2ddd;
        return $this;
    }

    function setFone2tipo($fone2tipo) {
        $this->fone2tipo = $fone2tipo;
        return $this;
    }

    function setFone2ramal($fone2ramal) {
        $this->fone2ramal = $fone2ramal;
        return $this;
    }

    function setFone2contato($fone2contato) {
        $this->fone2contato = $fone2contato;
        return $this;
    }

    function setFone3numero($fone3numero) {
        $this->fone3numero = $fone3numero;
        return $this;
    }

    function setFone3ddd($fone3ddd) {
        $this->fone3ddd = $fone3ddd;
        return $this;
    }

    function setFone3tipo($fone3tipo) {
        $this->fone3tipo = $fone3tipo;
        return $this;
    }

    function setFone3ramal($fone3ramal) {
        $this->fone3ramal = $fone3ramal;
        return $this;
    }

    function setFone3contato($fone3contato) {
        $this->fone3contato = $fone3contato;
        return $this;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
        return $this;
    }

    function setNumero($numero) {
        $this->numero = $numero;
        return $this;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
        return $this;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
        return $this;
    }

    function setLocalidade($localidade) {
        $this->localidade = $localidade;
        return $this;
    }

    function setUf($uf) {
        $this->uf = $uf;
        return $this;
    }

    function setCep($cep) {
        $this->cep = $cep;
        return $this;
    }

    public function toArray() {

        if (isset($this->tratamento)) {
            $tratamento = $this->tratamento->getId();
        } else {
            $tratamento = NULL;
        }

        if (isset($this->fone1tipo)) {
            $fone1tipo = $this->fone1tipo->getId();
        } else {
            $fone1tipo = NULL;
        }
        
        if (isset($this->fone2tipo)) {
            $fone2tipo = $this->fone2tipo->getId();
        } else {
            $fone2tipo = NULL;
        }
        
        if (isset($this->fone3tipo)) {
            $fone3tipo = $this->fone3tipo->getId();
        } else {
            $fone3tipo = NULL;
        }
        
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
            'sobrenome' => $this->sobrenome,
            'tratamento' => $tratamento,
            'isGravatar' => $this->isGravatar,
            'foto' => $this->foto,
            'fone1numero' => $this->fone1numero,
            'fone1ddd' => $this->fone1ddd,
            'fone1tipo' => $fone1tipo,
            'fone1ramal' => $this->fone1ramal,
            'fone1contato' => $this->fone1contato,
            'fone2numero' => $this->fone2numero,
            'fone2ddd' => $this->fone2ddd,
            'fone2tipo' => $fone2tipo,
            'fone2ramal' => $this->fone2ramal,
            'fone2contato' => $this->fone2contato,
            'fone3numero' => $this->fone3numero,
            'fone3ddd' => $this->fone3ddd,
            'fone3tipo' => $fone3tipo,
            'fone3ramal' => $this->fone3ramal,
            'fone3contato' => $this->fone3contato,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'localidade' => $this->localidade,
            'uf' => $this->uf,
            'cep' => $this->cep,
        );


        // return (new Hydrator\ClassMethods())->extract($this);
    }

}
