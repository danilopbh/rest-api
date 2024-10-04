<?php

namespace App\Controller;
use App\Repository\ContribuinteRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;

class ContribuinteController extends AbstractController
{
    #[Route('/contribuinte', name: 'app_contribuinte')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ContribuinteController.php',
        ]);
    }


    #[Route('/contribuinte/eproc/test', name: 'test', methods: ['GET'])]
    public function test(): Response
    {
        // Simulando alguma lógica aqui
        $message = 'Teste OK!'; // Mensagem de sucesso

        // Você pode incluir lógica adicional, se necessário

        return new Response($message);
    }

    #[Route('/api/contribuintes', name: 'get_contribuintes', methods: ['GET'])]
    public function getContribuintes(ContribuinteRepository $contribuinteRepository): JsonResponse
    {
        // Fetch all Contribuintes with their CertidaoDivida relations
        $contribuintes = $contribuinteRepository->findAll();
        
        $data = [];

        foreach ($contribuintes as $contribuinte) {
            $certidoes = [];
            
            foreach ($contribuinte->getCertidaoDividas() as $certidaoDivida) {
               
                $data_payment = $certidaoDivida->getDatePayment();
                $datePaymentFormatted = $data_payment ? $data_payment->format('Y-m-d') : null; // Verifique se não é nulo


                $certidoes[] = [
                    'id' => $certidaoDivida->getId(),
                    'descricao' => $certidaoDivida->getDescription(),
                    'data_payment' => $datePaymentFormatted,
                    'valor' => $certidaoDivida->getValue(),
                ];
            }

           $data[] = [
                'id' => $contribuinte->getId(),
                'nome' => $contribuinte->getName(),
                'cpf' => $contribuinte->getCpf(),
                'certidoesDivida' => $certidoes,
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
