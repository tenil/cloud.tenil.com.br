<?php

namespace TenilUser\Entity;

// Uso padrão do doctrine, criado na geração automática do arquivo por linha de comando.
use Doctrine\ORM\Mapping as ORM;
// Usado para geração de valores para o salt.
use Zend\Math\Rand;
// Usado para gerar um valor criptografado para senha. Muito forte.
use Zend\Crypt\Key\Derivation\Pbkdf2;
// Responsável por preencher os sets com os dados passados. Usado no construtor.
use Zend\Stdlib\Hydrator;

/**
 * TeniluserUser
 *
 * @ORM\Entity(repositoryClass="TenilUser\Entity\UserRepository")
 * @ORM\Table(name="teniluser_user", uniqueConstraints={@ORM\UniqueConstraint(name="email_UNIQUE", columns={"email"})})
 * @ORM\HasLifecycleCallbacks
 */
class User
{

    /**
     * @ORM\OneToOne(targetEntity="Perfil", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $perfil;

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
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=false)
     */
    private $activationKey;

    /**
     * @var string
     *
     * @ORM\Column(name="password_reset_key", type="string", length=255, nullable=false)
     */
    private $passwordResetKey;

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

    public function __construct(array $options = array())
    {
        /*
         * Executado no momento da criação do objeto.
         * 
         * IMPORTANTE: Verificar por que algumas coisas são atribuidas no construtor
         * e outras nos setters. Ex. $password
         */
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        // Atribuindo o valor para o salt.
        // Rand::getBytes(8, TRUE) Gera uma string de 8 caracteres.
        // base64_encode converte para a base 64.
        $this->salt = base64_encode(Rand::getBytes(8, TRUE));

        // Atribuindo o valor da chave de ativação.
        $this->activationKey = md5($this->email . $this->salt);

        // Getters e Setters automáticos (subistitui o configurator.php)
        /*
         * $hydrator = new Hydrator\ClassMethods;
         * $hydrator->hydrate($options, $this);        
         */
        // Somente php >= 5.4
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    public function encryptPassword($password)
    {

        $hash = 'sha256';
        $salt = $this->salt;
        $iterations = 10000;
        $length = 32;
        $data = Pbkdf2::calc($hash, $password, $salt, $iterations, $length);

        return base64_encode($data);
    }

    function getPerfil()
    {
        return $this->perfil;
    }

    function setPerfil(Perfil $perfil)
    {
        $this->perfil = $perfil;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = strtolower($email);
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $this->encryptPassword($password);
        return $this;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    public function getActivationKey()
    {
        return $this->activationKey;
    }

    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;
        return $this;
    }

    public function getPasswordResetKey()
    {
        return $this->passwordResetKey;
    }

    public function setPasswordResetKey($passwordResetKey = NULL)
    {
        // se for passado um valor TRUE, então será gerada a chave.
        // caso contrario, a chave será nula
        $this->passwordResetKey = $passwordResetKey ? Rand::getString(64, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890', TRUE) : NULL;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    // prePersist: Antes de gravar as informações no banco, ele executa o método.
    /**
     *
     * @param \DateTime $updatedAt
     * @return \TenilUser\Entity\User
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime("now");
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function __toString()
    {
        return $this->email;
    }

    public function toArray()
    {

        $hydrator = new Hydrator\ClassMethods();
        return $hydrator->extract($this);

        // return (new Hydrator\ClassMethods())->extract($this);
    }

}
