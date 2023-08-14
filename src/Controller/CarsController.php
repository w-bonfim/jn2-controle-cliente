<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cars;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class CarsController extends AbstractController
{
    #[Route(
        name: 'cars_get_plate',
        path: 'api/consulta/final-placa/{plate}',
        methods: ['GET'],
        defaults: [
            '_api_resource_class' => Cars::class,
            '_api_operation_name' => 'cars_plate'
        ],
    )]
    public function __invoke(Cars $cars): Response
    {
        return true;
    }
}
