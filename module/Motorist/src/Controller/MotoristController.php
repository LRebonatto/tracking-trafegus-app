<?php

namespace Motorist\Controller;

use Doctrine\ORM\EntityManager;
use Exception;
use Motorist\Entity\Motorist;
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
        return new ViewModel(['motorists' => $motorists]);
    }

    public function addAction()
    {
        // Se o formulário foi submetido:
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();

            $motorist = new Motorist();
            $motorist->setNome($data['nome']);
            $motorist->setRg($data['rg']);
            $motorist->setCpf($data['cpf']);
            $motorist->setTelefone($data['telefone']);

            $this->entityManager->persist($motorist);
            $this->entityManager->flush();

            // Redirecionar para a página de listagem de veículos
            return $this->redirect()->toRoute('motorists');

        }
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            // Lidar com a situação em que o ID não está presente
            return $this->redirect()->toRoute('motorists', ['action' => 'index']);
        }

        try {
            // Busca o veículo pelo ID
            $motorist = $this->entityManager->getRepository(Motorist::class)->find($id);

            if (!$motorist) {
                // Lidar com a situação em que o veículo não foi encontrado
                return $this->redirect()->toRoute('motorists', ['action' => 'index']);
            }

            // Se o formulário foi submetido:
            if ($this->getRequest()->isPost()) {
                $data = $this->params()->fromPost();

                $motorist->setNome($data['nome']);
                $motorist->setRg($data['rg']);
                $motorist->setCpf($data['cpf']);
                $motorist->setTelefone($data['telefone']);

                // Persistir as mudanças
                $this->entityManager->flush();

                // Passar os dados do veículo para a view
                return new ViewModel(['motorists' => $motorist]);
            }


        } catch (Exception $e) {
            // throw new \Exception('Could not edit. Error was thrown, details: ', $e->getMessage());
            // Lidar com exceções, como registro não encontrado, erro de banco de dados, etc.
            return $this->redirect()->toRoute('motorists', ['action' => 'index']);
        }
    }

    public function deleteAction()
    {
        return new ViewModel();
    }
}
