<?php
// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Contribuinte;
use App\Entity\CertidaoDivida;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('pt_BR'); // Para gerar dados no formato brasileiro

        for ($i = 0; $i < 100; $i++) {
            // Criar um Contribuinte
            $contribuinte = new Contribuinte();
            $contribuinte->setName($faker->name);
            $contribuinte->setCpf($faker->cpf(false));
            $contribuinte->setAdress($faker->address);
            // Criar Certidões de Dívida para o Contribuinte
            for ($j = 0; $j < 3; $j++) {
                $pdfFileName = 'certidao_divida_' . $j . '.pdf';

                $certidao = new CertidaoDivida();


                $certidao->setDescription('Certidao divida' .' - '. $j);
                $certidao->setPdfdivida($pdfFileName);
                if ($j%2 != 0){ 
                  
                    $certidao->setDatePayment($faker->dateTimeThisDecade);

                }
                $certidao->setValue($faker->randomFloat(2, 500, 10000));
                $certidao->setContribuinte($contribuinte); // Estabelecer a relação

                $manager->persist($certidao);
            }

            $manager->persist($contribuinte);

            // Persistir todos os dados no banco de dados
            $manager->flush();
        }
    }
}
