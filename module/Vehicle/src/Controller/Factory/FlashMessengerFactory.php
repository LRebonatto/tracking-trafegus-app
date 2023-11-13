<?php
namespace Vehicle\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\View\Helper\FlashMessenger;

class FlashMessengerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new FlashMessenger();
    }
}
