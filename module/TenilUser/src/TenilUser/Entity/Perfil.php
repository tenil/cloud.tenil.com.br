<?php

namespace TenilUser\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Perfil
 *
 * @ORM\Entity(repositoryClass="PerfilRepository")
 * @ORM\Table(name="teniluser_perfil")
 */
class Perfil
{

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="perfil", cascade={"persist"})
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Telefone", mappedBy="perfil", cascade={"persist"})
     */
    protected $telefones;

    /**
     * @ORM\OneToMany(targetEntity="Endereco", mappedBy="perfil", cascade={"persist"})
     */
    protected $enderecos;

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
     * @var string
     * @ORM\Column(name="apelido", type="string", length=255, nullable=true)
     */
    protected $apelido;

    /**
     * @ORM\ManyToOne(targetEntity="PerfilTratamento")
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
     * Nunca esquecer de inicializar todas as coleções!
     */
    public function __construct()
    {
        $this->telefones = new ArrayCollection();
        $this->enderecos = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    function getNome()
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * @return string
     */
    function getApelido()
    {
        return $this->apelido;
    }

    function getTratamento()
    {
        return $this->tratamento;
    }

    /**
     * @return bool
     */
    function getIsGravatar()
    {
        return $this->isGravatar;
    }

    /**
     * @return string
     */
    function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param $id
     * @return $this
     */
    function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $nome
     * @return $this
     */
    function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @param $sobrenome
     * @return $this
     */
    function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
        return $this;
    }

    /**
     * @param $apelido
     * @return $this
     */
    function setApelido($apelido)
    {
        $this->apelido = $apelido;
        return $this;
    }

    /**
     * @param $isGravatar
     * @return $this
     */
    function setIsGravatar($isGravatar)
    {
        $this->isGravatar = $isGravatar;
        return $this;
    }

    /**
     * @param $foto
     * @return $this
     */
    function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

    /**
     * @param Collection $telefones
     */
    public function addTelefones(Collection $telefones)
    {
        foreach ($telefones as $telefone) {
            $telefone->setPerfil($this);
            $this->telefones->add($telefone);
        }
    }

    /**
     * @param Collection $telefones
     */
    public function removeTelefones(Collection $telefones)
    {
        foreach ($telefones as $telefone) {
            $telefone->setPerfil(null);
            $this->telefones->removeElement($telefone);
        }
    }

    /**
     * @return Collection
     */
    public function getTelefones()
    {
        return $this->telefones;
    }

    /**
     * @param Collection $enderecos
     */
    public function addEnderecos(Collection $enderecos)
    {
        foreach ($enderecos as $endereco) {
            $endereco->setPerfil($this);
            $this->enderecos->add($endereco);
        }
    }

    /**
     * @param Collection $enderecos
     */
    public function removeEnderecos(Collection $enderecos)
    {
        foreach ($enderecos as $endereco) {
            $endereco->setPerfil(null);
            $this->enderecos->removeElement($endereco);
        }
    }

    /**
     * @return Collection
     */
    public function getEnderecos()
    {
        return $this->enderecos;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getNome();
    }

    /**
     * Allow null to remove association
     *
     * @param User $user
     * @return Perfil $this
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }


    public function setTratamento(PerfilTratamento $tratamento = null)
    {
        $this->tratamento = $tratamento;
        return $this;
    }

}