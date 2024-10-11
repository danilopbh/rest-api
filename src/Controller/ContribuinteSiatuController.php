<?php

namespace App\Controller;

use App\Repository\ContribuinteSiatuRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContribuinteSiatuController extends AbstractController
{
    #[Route('/contribuinte/siatu', name: 'app_contribuinte_siatu')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ContribuinteSiatuController.php',
        ]);
    }


    #[Route('/api/contribuinte/siatu', name: 'app_contribuintes_siatu', methods: ['GET'])]
    public function getContribuintesSiatu(ContribuinteSiatuRepository $contribuinteSiatuRepository): JsonResponse
    {
        
       
        // Fetch all Contribuintes with their CertidaoDivida relations
        $contribuintes = $contribuinteSiatuRepository->findAll();
        
       dd($contribuintes);
      

        $data = [];

        foreach ($contribuintes as $contribuinte) {
            $certidoes = [];
            
            foreach ($contribuinte->getCertidoesDividaSiatu() as $certidaoDivida) {

                
                $certidoes[] = [
                    'id' => $certidaoDivida->getId(),
                    'descricao' => $certidaoDivida->getDescricao(),
                    'dataEmissao' => $certidaoDivida->getDataEmissao()->format('Y-m-d'),
                    'valor' => $certidaoDivida->getValor(),
                ];
            }

            $data[] = [
                'id' => $contribuinte->getId(),
                'nome' => $contribuinte->getNome(),
                'cpf' => $contribuinte->getCpf(),
                'certidoesDivida' => $certidoes,
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
