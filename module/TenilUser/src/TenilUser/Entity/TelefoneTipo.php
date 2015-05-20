<?php

namespace TenilUser\Entity;

// Uso padrão do doctrine, criado na geração automática do arquivo por linha de comando.
use Doctrine\ORM\Mapping as ORM;
// Usado para geração de valores para o salt.
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\Table(name="tenil_telefone_tipo")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="TenilUser\Entity\TelefoneTipoRepository")
 */
class TelefoneTipo {

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

    public function __construct(array $options = array()) {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function __toString() {
        return $this->getNome();
    }

}
