<?php

namespace TenilAcl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="tenilacl_roles")
 * @ORM\Entity(repositoryClass="TenilAcl\Entity\RoleRepository")
 */
class Role {

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var integer
     * 
     * @ORM\OneToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    protected $nome;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_admin", type="boolean")
     */
    protected $isAdmin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    public function __construct($options = array()) {

        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    public function toArray() {

        $parent = FALSE;

        if (isset($this->parent)) {
            $parent = $this->parent->getId();
        }

        return array(
            'id' => $this->id,
            'nome' => $this->nome,
            'isAdmin' => $this->isAdmin,
            'parent' => $parent
        );
    }

    public function toString() {
        return $this->nome;
    }

    public function __toString() {
        return $this->nome;
    }

    public function getId() {
        return $this->id;
    }

    public function getParent() {
        return $this->parent;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
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

    public function setParent($parent) {
        $this->parent = $parent;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * 
     * @param \DateTime $updatedAt
     * @return \TenilAcl\Entity\Role
     * @ORM\PreUpdate
     */
    
    public function setUpdatedAt() {
        $this->updatedAt =  new \DateTime("now");;
        return $this;
    }
    
}