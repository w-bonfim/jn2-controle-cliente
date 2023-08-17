<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CarsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use App\ApiResource\Action\CarsAction;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: CarsRepository::class)]
#[ApiResource(operations: [
    new GetCollection(
        name: 'consultPlate',
        uriTemplate: '/consulta/final-placa/{plate}', 
        controller: CarsAction::class,
        read: false
    )
])]
class Cars
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Customers $customer = null;

    #[ORM\Column(length: 10)]
    #[Groups('customers')]
    private ?string $plate = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups('customers')]
    private ?string $brands = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups('customers')]
    private ?string $model = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customers
    {
        return $this->customer;
    }

    public function setCustomer(?Customers $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getPlate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): static
    {
        $this->plate = $plate;

        return $this;
    }

    public function getBrands(): ?string
    {
        return $this->brands;
    }

    public function setBrands(?string $brands): static
    {
        $this->brands = $brands;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): static
    {
        $this->model = $model;

        return $this;
    }
}
