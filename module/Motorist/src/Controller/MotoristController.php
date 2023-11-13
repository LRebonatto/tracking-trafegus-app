<?php

namespace Motorist\Controller;

use Doctrine\ORM\EntityManager;
use Exception;
use Motorist\Entity\Motorist;
use Vehicle\Entity\Vehicle;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class MotoristController extends AbstractActionController
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
        $motorists = $this->entityManager->getRepository(Motorist::class)->findAll();
        $vehicles = $this->entityManager->getRepository(Vehicle::class)->findAll();
        return new ViewModel(['motorists' => $motorists, 'vehicles' => $vehicles]);
    }

    public function addAction()
    {
        // Se o formulário foi submetido:
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();

            $motorist = new Motorist();
            $motorist->setNome($data['nome']);
            $motorist->setRg(preg_replace('/\D/', '', $data['rg']));
            $motorist->setCpf(preg_replace('/\D/', '', $data['cpf']));
            $motorist->setTelefone(preg_replace('/\D/', '', $data['telefone']));
            //vehicle id can be null
            $motorist->setVehicleId($data['vehicle_id'] == '' ? null : $data['vehicle_id']);


            $this->entityManager->persist($motorist);
            $this->entityManager->flush();

            // Redirecionar para a página de listagem de veículos
            return $this->redirect()->toRoute('motorists');
        }

        // Passar os veiculos para view
        $vehicles = $this->entityManager->getRepository(Vehicle::class)->findAll();
        return new ViewModel(['vehicles' => $vehicles]);
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            // Lidar com a situação em que o ID não está presente
            return $this->redirect()->toRoute('motorists', ['action' => 'index']);
        }

        try {
            // Busca pelo ID
            $motorist = $this->entityManager->getRepository(Motorist::class)->find($id);

            if (!$motorist) {
                // Lidar com a situação em que o motorista não foi encontrado
                return $this->redirect()->toRoute('motorists', ['action' => 'index']);
            }

            // Se o formulário foi submetido:
            if ($this->getRequest()->isPost()) {
                $data = $this->params()->fromPost();

                $motorist->setNome($data['nome']);
                $motorist->setRg($data['rg']);
                $motorist->setCpf($data['cpf']);
                $motorist->setTelefone($data['telefone']);
                $motorist->setVehicleId($data['vehicle_id']);

                // Persistir as mudanças
                $this->entityManager->flush();

                // se o registro foi alterado com sucesso, redireciona para a view action
                return $this->redirect()->toRoute('motorists', ['action' => 'view', 'id' => $motorist->getId()]);
            }

            // Passar os veiculos para view
            $vehicles = $this->entityManager->getRepository(Vehicle::class)->findAll();
            return new ViewModel(['motorist' => $motorist, 'vehicles' => $vehicles]);

        } catch (Exception $e) {
            // throw new \Exception('Could not edit. Error was thrown, details: ', $e->getMessage());
            return $this->redirect()->toRoute('motorists', ['action' => 'index']);
        }
    }

    public function viewAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            // Lidar com a situação em que o ID não está presente
            return $this->redirect()->toRoute('motorists', ['action' => 'index']);
        }

        try {
            // Busca pelo ID
            $motorist = $this->entityManager->getRepository(Motorist::class)->find($id);

            if (!$motorist) {
                // Lidar com a situação em que o motorista não foi encontrado
                return $this->redirect()->toRoute('motorists', ['action' => 'index']);
            }

            $vehicle = $this->entityManager->getRepository(Vehicle::class)->find($motorist->getVehicleId());

            // set flash success message
            $this->flashMessenger()->addSuccessMessage("Cadastro alterado com sucesso.");
            return new ViewModel(['motorist' => $motorist, 'vehicle' => $vehicle]);

        } catch (Exception $e) {
            // throw new \Exception('Could not edit. Error was thrown, details: ', $e->getMessage());
            return $this->redirect()->toRoute('motorists', ['action' => 'index']);
        }

    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('motorists', ['action' => 'index']);
        }

        $motorist = $this->entityManager->getRepository(Motorist::class)->find($id);

        if (!$motorist) {
            return $this->redirect()->toRoute('motorists', ['action' => 'index']);
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();

            // Verificar se a confirmação de exclusão está presente
            if (isset($data['confirm']) && $data['confirm'] == 'yes') {
                $this->entityManager->remove($motorist);
                $this->entityManager->flush();

                $this->flashMessenger()->addSuccessMessage('Motorista excluído com sucesso.');
            }

            return $this->redirect()->toRoute('motorists', ['action' => 'index']);
        }

        return new ViewModel(['motorist' => $motorist]);
    }

}
