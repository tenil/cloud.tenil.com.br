<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 28/03/2016
 * Time: 15:24
 */

namespace TenilEvento\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * EventoImages
 *
 * @ORM\Table(name="tenilevento_images")
 * @ORM\Entity(repositoryClass="TenilEvento\Entity\ImagesRepository")
 * @ORM\HasLifecycleCallbacks
 */
class EventoImages
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
     *
     * @ORM\ManyToOne(targetEntity="Evento", inversedBy="imagens")
     * @ORM\JoinColumn(name="id_evento", referencedColumnName="id")
     **/
    protected $evento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_arquivo", type="string", length=45, nullable=false)
     */
    protected $nomeArquivo;

    /**
     * @var string
     *
     * @ORM\Column(name="tamanho_imagem", type="string", length=2, nullable=false)
     */
    protected $tamanhoImagem;

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
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nomeArquivo;
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
     * @return EventoImages
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomeArquivo()
    {
        return $this->nomeArquivo;
    }

    /**
     * @param string $nomeArquivo
     * @return EventoImages
     */
    public function setNomeArquivo($nomeArquivo)
    {
        $this->nomeArquivo = $nomeArquivo;
        return $this;
    }

    /**
     * @return string
     */
    public function getTamanhoImagem()
    {
        return $this->tamanhoImagem;
    }

    /**
     * @param string $tamanhoImagem
     * @return EventoImages
     */
    public function setTamanhoImagem($tamanhoImagem)
    {
        $this->tamanhoImagem = $tamanhoImagem;
        return $this;
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
     * @return EventoImages
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
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