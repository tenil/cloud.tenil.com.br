<?php

namespace TenilUser\Entity;

// Uso padrão do doctrine, criado na geração automática do arquivo por linha de comando.
use Doctrine\ORM\Mapping as ORM;
// Usado para geração de valores para o salt.
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\Table(name="teniluser_tipo_tratamento")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="TenilUser\Entity\TipoTratamentoRepository")
 */
class TipoTratamento {

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

    public function __construct(array $options = array()) {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getAbreviacao() {
        return $this->abreviacao;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setAbreviacao($abreviacao) {
        $this->abreviacao = $abreviacao;
        return $this;
    }

    public function __toString() {
        return $this->abreviacao;
    }

    public function toArray() {
        return (new Hydrator\ClassMethods)->extract($this);
    }

}
