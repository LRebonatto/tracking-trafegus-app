<?php

namespace Vehicle\Controller;

use Doctrine\ORM\EntityManager;
use Exception;
use Vehicle\Entity\Vehicle;
use Motorist\Entity\Motorist;
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

        return new ViewModel();
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            // Lidar com a situação em que o ID não está presente
            return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
        }

        try {
            // Busca pelo ID
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

                // se o registro foi alterado com sucesso, redireciona para a view action
                return $this->redirect()->toRoute('vehicles', ['action' => 'view', 'id' => $vehicle->getId()]);
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
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
        }

        $vehicle = $this->entityManager->getRepository(Vehicle::class)->find($id);

        if (!$vehicle) {
            return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
        }

        $motorist = $this->entityManager->getRepository(Motorist::class)->findBy(['vehicleId' => $vehicle->getId()]);

        if ($this->getRequest()->isPost()) {
            $confirm = $this->params()->fromPost('confirm');

            if ($confirm === 'yes') {
                if ($motorist) {
                    // Exibir uma mensagem ou redirecionar para desvincular o veículo do motorista primeiro
                    $this->flashMessenger()->addErrorMessage('Não é possível excluir o veículo, pois ele está vinculado a um motorista.');
                    return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
                }

                $this->entityManager->remove($vehicle);
                $this->entityManager->flush();

                // Set flash message
                $this->flashMessenger()->addSuccessMessage('Veículo excluído com sucesso.');

                return $this->redirect()->toRoute('vehicles', ['action' => 'index']);
            }
        }

        return new ViewModel(['vehicle' => $vehicle, 'motorist' => $motorist]);
    }

}
