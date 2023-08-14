<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CarsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;

#[ORM\Entity(repositoryClass: CarsRepository::class)]
#[ApiResource(operations: [
    new Get(
        name: 'cars_plate', routeName: 'cars_get_plate' 
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
    private ?string $plate = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $brands = null;

    #[ORM\Column(length: 20, nullable: true)]
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
