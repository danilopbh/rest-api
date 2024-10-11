<?php

namespace App\Controller;

use App\Entity\ContribuinteSupp;
use App\Entity\CertidaoDividaSupp;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ContribuinteSuppController extends AbstractController
{



    private $entityManager;
    private $httpClient;

    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $httpClient)
    {
        $this->entityManager = $entityManager;
        $this->httpClient = $httpClient;
    }

    #[Route('/contribuinte/supp', name: 'app_contribuinte_supp')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ContribuinteSuppController.php',
        ]);
    }

    #[Route('/api/sync/contribuintes', name: 'app_sync_contribuintes', methods: ['POST'])]
    public function syncContribuintes(): JsonResponse
    {
        // URL da API do SIATU
        $siatuApiUrl = 'http://localhost:8000/api/contribuinte/siatu'; // substitua pela URL correta da sua API

        

        // Faz a requisição à API do SIATU
        $response = $this->httpClient->request('GET', $siatuApiUrl);
        $contribuintes = $response->toArray();

        
        foreach ($contribuintes as $contribuinteData) {
            // Cria um novo ContribuinteSupp

         

            $contribuenteSupp = new ContribuinteSupp();
            $contribuenteSupp->setNome($contribuinteData['nome']);
            $contribuenteSupp->setCpf($contribuinteData['cpf']);
            $contribuenteSupp->setEndereco($contribuinteData['endereco']);
            
            // Persiste o contribuinte na tabela SUPP
            $this->entityManager->persist($contribuenteSupp);
            $this->entityManager->flush(); // Grava para obter o ID gerado

            // Verifica se há certidões de dívida
            if (isset($contribuinteData['certidoesDivida'])) {
                foreach ($contribuinteData['certidoesDivida'] as $certidaoData) {

              
                    $certidaoDividaSupp = new CertidaoDividaSupp();
                    $certidaoDividaSupp->setContribuinteSupp($contribuenteSupp); // Associar com o novo contribuinte
                    $certidaoDividaSupp->setValor($certidaoData['valor']);
                    $certidaoDividaSupp->setDescricao($certidaoData['descricao']);
                    $certidaoDividaSupp->setPdfDivida($certidaoData['pdfDivida']); // PDF como BLOB
                    $certidaoDividaSupp->setPdfDivida($certidaoData['dataVencimento']); // PDF como BLOB

                    // Persiste a certidão de dívida na tabela SUPP
                    $this->entityManager->persist($certidaoDividaSupp);
                }
            }
                
        }

       
        // Grava todas as mudanças no banco de dados
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Dados sincronizados com sucesso!'], JsonResponse::HTTP_OK);
    }


}
