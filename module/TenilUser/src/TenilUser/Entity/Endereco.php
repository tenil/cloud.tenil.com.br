<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 15/05/2015
 * Time: 13:24
 */

namespace TenilUser\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endereco
 *
 * @ORM\Table(name="tenil_endereco")
 * @ORM\Entity(repositoryClass="TenilUser\Entity\EnderecoRepository")
 */
class Endereco
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
     * @ORM\ManyToOne(targetEntity="Perfil", inversedBy="enderecos")
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id")
     */
    protected $perfil;

    /**
     * @var string
     * @ORM\Column(name="logradouro", type="string", length=255, nullable=true)
     */
    protected $logradouro;

    /**
     * @var string
     * @ORM\Column(name="numero", type="string", length=5, nullable=true)
     */
    protected $numero;

    /**
     * @var string
     * @ORM\Column(name="complemento", type="string", length=45, nullable=true)
     */
    protected $complemento;

    /**
     * @var string
     * @ORM\Column(name="bairro", type="string", length=255, nullable=true)
     */
    protected $bairro;

    /**
     * @var string
     * @ORM\Column(name="localidade", type="string", length=255, nullable=true)
     */
    protected $localidade;

    /**
     * @var string
     * @ORM\Column(name="uf", type="string", length=2, nullable=true)
     */
    protected $uf;

    /**
     * @var string
     * @ORM\Column(name="cep", type="string", length=8, nullable=true)
     */
    protected $cep;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * Allow null to remove association
     *
     * @param Perfil $perfil
     * @return Endereco $this
     */
    public function setPerfil(Perfil $perfil = null)
    {
        $this->perfil = $perfil;
        return $this;
    }

    /**
     * @return Perfil
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getLogradouro();
    }

}