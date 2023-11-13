<?php

namespace Motorist\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator\ClassMethods;


/**
 * @ORM\Entity
 * @ORM\Table(name="motorist")
 */
class Motorist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=false)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    protected $rg;

    /**
     * @ORM\Column(type="string", length=11, nullable=false)
     */
    protected $cpf;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $telefone;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicle\Entity\Vehicle")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     * @ORM\Column(type="integer", nullable=true)
     * @var Integer|null
     */
    protected $vehicle_id;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            (new ClassMethods(false))->hydrate($data, $this);
        }
    }

    /**
     * Returns ID of this motorist.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getVehicleId()
    {
        return $this->vehicle_id;
    }

    public function setVehicleId($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
    }

}
