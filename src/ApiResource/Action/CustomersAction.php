<?php

namespace App\ApiResource\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Customers;
use App\Repository\CustomersRepository;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class CustomersAction extends AbstractController
{   
    public function __invoke(Request $request, CustomersRepository $customerRepository)
    {
        return $customerRepository->saveCostumer($request);
    }
}
