<?php

namespace TenilAcl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="tenilacl_privileges")
 * @ORM\Entity(repositoryClass="TenilAcl\Entity\RoleRepository")
 */
class Privilege {

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
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAd;

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

    public function getUpdatedAd() {
        return $this->updatedAd;
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
     * @ORM\PrePersist
     */
    public function setUpdatedAd(\DateTime $updatedAd) {
        $this->updatedAd = $updatedAd;
        return $this;
    }

}
