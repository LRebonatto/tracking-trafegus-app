<?php

namespace Vehicle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator\ClassMethods;


/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle")
 */
class Vehicle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=7, nullable=false)
     */
    protected $placa;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $renavam;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    protected $modelo;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    protected $marca;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $ano;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    protected $cor;

    /**
     * @ORM\ManyToOne(targetEntity="\Vehicle\Entity\Vehicle")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $vehicle;

    /**
     * Returns associated vehicle.
     * @return Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Sets associated vehicle.
     * @param Vehicle $vehicle
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Returns ID of this vehicle.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets ID of this vehicle.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns placa.
     * @return string
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * Sets placa.
     * @param string $placa
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    /**
     * Returns renavam.
     * @return string
     */
    public function getRenavam()
    {
        return $this->renavam;
    }

    /**
     * Sets renavam.
     * @param string $renavam
     */
    public function setRenavam($renavam)
    {
        $this->renavam = $renavam;
    }

    /**
     * Returns modelo.
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Sets modelo.
     * @param string $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * Returns marca.
     * @return string
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Sets marca.
     * @param string $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * Returns ano.
     * @return integer
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Sets ano.
     * @param int $ano
     */
    public function setAno($ano)
    {
        $this->ano = $ano;
    }

    /**
     * Returns cor.
     * @return string
     */
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * Sets cor.
     * @param string $cor
     */
    public function setCor($cor)
    {
        $this->cor = $cor;
    }

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
//            $this->exchangeArray($data);
            (new ClassMethods(false))->hydrate($data, $this);
        }
    }

    /**
     * Returns array of this vehicle.
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'placa' => $this->getPlaca(),
            'renavam' => $this->getRenavam(),
            'modelo' => $this->getModelo(),
            'marca' => $this->getMarca(),
            'ano' => $this->getAno(),
            'cor' => $this->getCor(),
        ];
    }

    /**
     * Populate from an array.
     * @param array $data
     */
    public function exchangeArray($data)
    {
        $this->setId(!empty($data['id']) ? $data['id'] : null);
        $this->setPlaca(!empty($data['placa']) ? $data['placa'] : null);
        $this->setRenavam(!empty($data['renavam']) ? $data['renavam'] : null);
        $this->setModelo(!empty($data['modelo']) ? $data['modelo'] : null);
        $this->setMarca(!empty($data['marca']) ? $data['marca'] : null);
        $this->setAno(!empty($data['ano']) ? $data['ano'] : null);
        $this->setCor(!empty($data['cor']) ? $data['cor'] : null);
    }

    /**
     * Convert the object to an array.
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'placa' => $this->getPlaca(),
            'renavam' => $this->getRenavam(),
            'modelo' => $this->getModelo(),
            'marca' => $this->getMarca(),
            'ano' => $this->getAno(),
            'cor' => $this->getCor(),
        ];
    }
}
