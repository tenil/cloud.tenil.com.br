<?php

namespace TenilAcl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="tenilacl_resources")
 * @ORM\Entity(repositoryClass="TenilAcl\Entity\ResourceRepository")
 */
class Resource {

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    protected $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    public function __construct($options = array()) {


        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        /*
         * $hydrator = new Hydrator\ClassMethods;
         * $hydrator->hydrate($options, $this);        
         */
        // Somente php >= 5.4
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    public function toArray() {
        return (new Hydrator\ClassMethods)->extract($this);
    }
    
    public function toString (){
        return $this->nome;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    /*
     * @ORM\PrePersist
     */
    public function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}