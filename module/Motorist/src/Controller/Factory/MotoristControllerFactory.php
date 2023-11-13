<?php

namespace Motorist\Controller\Factory;

use Psr\Container\ContainerInterface;
use Motorist\Controller\MotoristController;
use Doctrine\ORM\EntityManager;

class MotoristControllerFactory
{
    public function __invoke(ContainerInterface $container): MotoristController
    {
        $entityManager = $container->get(EntityManager::class);
        return new MotoristController($entityManager);
    }
}
