<?php

namespace TenilUser\Entity;

// Uso padrão do doctrine, criado na geração automática do arquivo por linha de comando.
use Doctrine\ORM\Mapping as ORM;
// Usado para geração de valores para o salt.
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\Table(name="teniluser_tipo_tratamento")
 * @ORM\Entity(repositoryClass="TenilUser\Entity\PerfilTratamentoRepository")
 */
class PerfilTratamento {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviacao", type="string", length=45, nullable=false)
     */
    private $abreviacao;

    /**
     * @param array $options
     */
    public function __construct(array $options = array()) {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    /**
     * @return int
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    function getNome() {
        return $this->nome;
    }

    /**
     * @return string
     */
    function getAbreviacao() {
        return $this->abreviacao;
    }

    /**
     * @param $id
     * @return $this
     */
    function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $nome
     * @return $this
     */
    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @param $abreviacao
     * @return $this
     */
    function setAbreviacao($abreviacao) {
        $this->abreviacao = $abreviacao;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->getAbreviacao();
    }

    /**
     * @return array
     */
    public function __toArray() {
        return (new Hydrator\ClassMethods)->extract($this);
    }

}
