<?php
/**
 * Created by Tenil Tecnologia.
 * User: Roberto
 * Date: 15/05/2015
 * Time: 13:24
 */

namespace TenilUser\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telefone
 *
 * @ORM\Table(name="tenil_telefone")
 * @ORM\Entity(repositoryClass="TenilUser\Entity\TelefoneRepository")
 */
class Telefone
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
     * @ORM\ManyToOne(targetEntity="Perfil", inversedBy="telefones")
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id")
     */
    protected $perfil;

    /**
     * @var string
     *
     * @ORM\Column(name="ddd", type="string", length=2, nullable=false)
     */
    protected $ddd;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=10, nullable=true)
     */
    protected $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="ramal", type="string", length=5, nullable=true)
     */
    protected $ramal;

    /**
     * @var string
     *
     * @ORM\Column(name="contato", type="string", length=45, nullable=true)
     */
    protected $contato;

    /**
     * @var boolean
     *
     * @ORM\Column(name="flag_sms", type="boolean", nullable=false)
     */
    protected $flagSms = '1';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDdd()
    {
        return $this->ddd;
    }

    /**
     * @param $ddd
     * @return $this
     */
    public function setDdd($ddd)
    {
        $this->ddd = $ddd;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param $numero
     * @return $this
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return string
     */
    public function getRamal()
    {
        return $this->ramal;
    }

    /**
     * @param $ramal
     * @return $this
     */
    public function setRamal($ramal)
    {
        $this->ramal = $ramal;
        return $this;
    }

    /**
     * @return string
     */
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * @param $contato
     * @return $this
     */
    public function setContato($contato)
    {
        $this->contato = $contato;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFlagSms()
    {
        return $this->flagSms;
    }

    /**
     * @param $flagSms
     * @return $this
     */
    public function setFlagSms($flagSms)
    {
        $this->flagSms = $flagSms;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getDdd() . $this->getNumero();
    }

    /**
     * Allow null to remove association
     *
     * @param Perfil $perfil
     * @return Telefone $this
     */
    public function setPerfil(Perfil $perfil = null)
    {
        $this->perfil = $perfil;
        return $this;
    }

    /**
     * @return Perfil
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

}