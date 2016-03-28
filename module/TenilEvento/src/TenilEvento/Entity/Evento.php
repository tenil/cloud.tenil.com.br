<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 15/05/2015
 * Time: 13:24
 */

namespace TenilEvento\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\DecimalType;


/**
 * Evento
 *
 * @ORM\Table(name="tenilevento_evento")
 * @ORM\Entity(repositoryClass="TenilEvento\Entity\EventoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Evento
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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=512, nullable=false)
     */
    protected $nome;

    /**
     * @ORM\OneToMany(targetEntity="EventoImages", mappedBy="evento")
     */
    protected $imagens;

    /**
     * @var string
     *
     * @ORM\Column(name="tema", type="string", length=512)
     */
    protected $tema;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     */
    protected $descricao;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_inicio", type="date")
     */
    protected $dataInicio;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_fim", type="date")
     */
    protected $dataFim;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time")
     */
    protected $horaInicio;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="hora_fim", type="time")
     */
    protected $horaFim;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd_vagas", type="integer")
     */
    protected $qtdVagas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="flag_inscricoes_abertas", type="boolean")
     */
    protected $flagInscricoesAbertas = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="organizador", type="string", length=512)
     */
    protected $organizador;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=256)
     */
    protected $slug;

    /**
     * @var DecimalType
     *
     * @ORM\Column(name="valor_inscricao", type="decimal", precision=10, scale=2)
     */
    protected $valorInscricao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="flag_evento_gratuito", type="boolean")
     */
    protected $flagEventoGratuito = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * Evento constructor.
     */
    public function __construct()
    {
        $this->createdAt = new DateTime("now");
        $this->updatedAt = new DateTime("now");

        $this->imagens = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nome;
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
     * @param string $nome
     * @return $this
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @param string $tema
     * @return $this
     */
    public function setTema($tema)
    {
        $this->tema = $tema;
        return $this;
    }

    /**
     * @param string $descricao
     * @return $this
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @param DateTime $dataInicio
     * @return $this
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;
        return $this;
    }

    /**
     * @param DateTime $dataFim
     * @return $this
     */
    public function setDataFim($dataFim)
    {
        $this->dataFim = $dataFim;
        return $this;
    }

    /**
     * @param DateTime $horaInicio
     * @return $this
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;
        return $this;
    }

    /**
     * @param DateTime $horaFim
     * @return $this
     */
    public function setHoraFim($horaFim)
    {
        $this->horaFim = $horaFim;
        return $this;
    }

    /**
     * @param int $qtdVagas
     * @return $this
     */
    public function setQtdVagas($qtdVagas)
    {
        $this->qtdVagas = $qtdVagas;
        return $this;
    }

    /**
     * @param boolean $flagInscricoesAbertas
     * @return $this
     */
    public function setFlagInscricoesAbertas($flagInscricoesAbertas)
    {
        $this->flagInscricoesAbertas = $flagInscricoesAbertas;
        return $this;
    }

    /**
     * @param string $organizador
     * @return $this
     */
    public function setOrganizador($organizador)
    {
        $this->organizador = $organizador;
        return $this;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $valorInscricao
     * @return $this
     */
    public function setValorInscricao($valorInscricao)
    {
        $this->valorInscricao = $valorInscricao;
        return $this;
    }

    /**
     * @param boolean $flagEventoGratuito
     * @return $this
     */
    public function setFlagEventoGratuito($flagEventoGratuito)
    {
        $this->flagEventoGratuito = $flagEventoGratuito;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @return DateTime
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * @return DateTime
     */
    public function getDataFim()
    {
        return $this->dataFim;
    }

    /**
     * @return DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * @return DateTime
     */
    public function getHoraFim()
    {
        return $this->horaFim;
    }

    /**
     * @return int
     */
    public function getQtdVagas()
    {
        return $this->qtdVagas;
    }

    /**
     * @return boolean
     */
    public function isFlagInscricoesAbertas()
    {
        return $this->flagInscricoesAbertas;
    }

    /**
     * @return string
     */
    public function getOrganizador()
    {
        return $this->organizador;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return DecimalType
     */
    public function getValorInscricao()
    {
        return $this->valorInscricao;
    }

    /**
     * @return boolean
     */
    public function isFlagEventoGratuito()
    {
        return $this->flagEventoGratuito;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * prePersist: Antes de gravar as informações no banco, ele executa o método.
     * @param string $slug
     * @return $this
     * @ORM\PrePersist
     */
    public function setSlug()
    {
        $slugify = new Slugify();
        $slug = $slugify->slugify($this->nome);
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImagens()
    {
        return $this->imagens;
    }

    /**
     * @param mixed $imagens
     * @return Evento
     */
    public function setImagens($imagens)
    {
        $this->imagens = $imagens;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return Evento
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Evento
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }


}