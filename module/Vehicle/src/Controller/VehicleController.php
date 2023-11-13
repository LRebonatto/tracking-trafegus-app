<?php

namespace Vehicle\Controller;

use Doctrine\ORM\EntityManager;
use Exception;
use Vehicle\Entity\Vehicle;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class VehicleController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $vehicles = $this->entityManager->getRepository(Vehicle::class)->findAll();
        return new ViewModel(['vehicles' => $vehicles]);
    }

    public function addAction()
    {
        // Form Trigger
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();

            $vehicle = new Vehicle();

            $vehicle->setPlaca($data['placa']);
            $vehicle->setRenavam($data['renavam']);
            $vehicle->setModelo($data['modelo']);
            $vehicle->setMarca($data['marca']);
            $vehicle->setAno($data['ano']);
            $vehicle->setCor($data['cor']);

            // Persistir o veículo
            $this->entityManager->persist($vehicle);
            $this->entityManager->flush();

            return $this->redirect()->toRoute('vehicles');
        }
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            // Lidar com a situação em que o ID não está presente
            return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
        }

        try {
            // Busca o veículo pelo ID
            $vehicle = $this->entityManager->getRepository(Vehicle::class)->find($id);

            if (!$vehicle) {
                // Lidar com a situação em que o veículo não foi encontrado
                return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
            }

            // Se o formulário foi submetido:
            if ($this->getRequest()->isPost()) {
                $data = $this->params()->fromPost();

                $vehicle->setPlaca($data['placa']);
                $vehicle->setRenavam($data['renavam']);
                $vehicle->setModelo($data['modelo']);
                $vehicle->setMarca($data['marca']);
                $vehicle->setAno($data['ano']);
                $vehicle->setCor($data['cor']);

                // Persistir as mudanças
                $this->entityManager->flush();
            }

            return new ViewModel(['vehicle' => $vehicle]);

        } catch (Exception $e) {
            // throw new \Exception('Could not edit. Error was thrown, details: ', $e->getMessage());
            return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
        }

    }

    public function viewAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            // Lidar com a situação em que o ID não está presente
            return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
        }

        try {
            // Busca o veículo pelo ID
            $vehicle = $this->entityManager->getRepository(Vehicle::class)->find($id);

            if (!$vehicle) {
                // Lidar com a situação em que o veículo não foi encontrado
                return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
            }

            // set flash message
            $this->flashMessenger()->addSuccessMessage("Cadastro alterado com sucesso.");
            return new ViewModel(['vehicle' => $vehicle]);

        } catch (Exception $e) {
            // throw new \Exception('Could not edit. Error was thrown, details: ', $e->getMessage());
            return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
        }

    }

    public function deleteAction()
    {
        return new ViewModel();
    }
}
