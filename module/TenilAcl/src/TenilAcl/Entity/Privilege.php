<?php

namespace TenilAcl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity(repositoryClass="TenilAcl\Entity\PrivilegeRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="tenilacl_privileges")
 */
class Privilege {

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var Role
     *
     * @ORM\OneToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $role;

    /**
     * @var Resource
     *
     * @ORM\OneToOne(targetEntity="Resource")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     */
    private $resource;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

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
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
            'role' => $this->role->getId(),
            'resource' => $this->resource->getId()
        );
    }
    
    public function toString(){
        return $this->nome;
    }

    public function getId() {
        return $this->id;
    }

    public function getRole() {
        return $this->role;
    }

    public function getResource() {
        return $this->resource;
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

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    public function setResource($resource) {
        $this->resource = $resource;
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
    
    /**
     * 
     * @param \DateTime $updatedAt
     * @return \TenilAcl\Entity\Privilege
     * @ORM\PreUpdate
     */
    
    public function setUpdatedAt() {
        $this->updatedAt = new \DateTime("now");
        return $this;
    }

}