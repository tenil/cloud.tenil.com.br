<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 15/05/2015
 * Time: 13:24
 */

namespace TenilEvento\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Cocur\Slugify\Slugify;

/**
 * Evento
 *
 * @ORM\Table(name="tenilevento_evento")
 * @ORM\Entity(repositoryClass="TenilEvento\Entity\EventoRepository")
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
     * @ORM\Column(name="slug", type="string", length=1024)
     */
    protected $slug;

    /**
     * @var string
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
     * @return string
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
     * @param string $urlEvento
     * @return $this
     */
    public function setSlug()
    {
        $slugify = new Slugify();
        $slugify->slugify($this->nome);
        $this->slug = $slugify;
        return $this;
    }

}