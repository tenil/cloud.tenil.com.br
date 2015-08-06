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

/**
 * Inscricao
 *
 * @ORM\Table(name="tenilevento_inscricao")
 * @ORM\Entity(repositoryClass="TenilEvento\Entity\InscricaoRepository")
 */
class Inscricao
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="TenilUser\Entity\Perfil")
     * @ORM\JoinColumn(name="id_responsavel", referencedColumnName="id")
     **/
    private $responsavel;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Evento")
     * @ORM\JoinColumn(name="id_evento", referencedColumnName="id")
     **/
    private $evento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=512, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=512)
     */
    private $email;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="criado_em", type="datetime")
     */
    private $criadoEm;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="modificado_em", type="datetime")
     */
    private $modificadoEm;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nome;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    /**
     * @param mixed $responsavel
     */
    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
    }

    /**
     * @return mixed
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * @param mixed $evento
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return DateTime
     */
    public function getCriadoEm()
    {
        return $this->criadoEm;
    }

    /**
     * @param DateTime $criadoEm
     */
    public function setCriadoEm($criadoEm)
    {
        $this->criadoEm = $criadoEm;
    }

    /**
     * @return DateTime
     */
    public function getModificadoEm()
    {
        return $this->modificadoEm;
    }

    /**
     * @param DateTime $modificadoEm
     */
    public function setModificadoEm($modificadoEm)
    {
        $this->modificadoEm = $modificadoEm;
    }

}