<?php

namespace App\ApiResource\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cars;
use App\Repository\CarsRepository;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class CarsAction extends AbstractController
{   
    public function __invoke($plate, CarsRepository $carsRepository)
    {
        return $carsRepository->findCostumer($plate);
    }
}
