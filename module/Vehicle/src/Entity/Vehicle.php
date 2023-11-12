<?php

namespace Vehicle\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicles")
 */
class Vehicle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
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
}
