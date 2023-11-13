<?php

namespace Vehicle\Controller\Factory;

use Psr\Container\ContainerInterface;
use Vehicle\Controller\VehicleController;
use Doctrine\ORM\EntityManager;

class VehicleControllerFactory
{
    public function __invoke(ContainerInterface $container): VehicleController
    {
        $entityManager = $container->get(EntityManager::class);
        return new VehicleController($entityManager);
    }
}
