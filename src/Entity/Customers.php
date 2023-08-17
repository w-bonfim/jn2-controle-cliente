<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CustomersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as MyConstrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Entity\Cars;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CustomersRepository::class)]
#[UniqueEntity(fields: ['cpf'], message:"CPF já está sendo utilizado.")]
#[ApiResource(operations: [
    new Post(
        uriTemplate: '/clienteCadastro'
    ),
    new Put(
        uriTemplate: '/cliente/{id}', 
        requirements: ['id' => '\d+']
        ),
    new Delete(
        uriTemplate: '/cliente/{id}', 
        requirements: ['id' => '\d+']
        ),
    new Get(
        uriTemplate: '/cliente/{id}', 
        requirements: ['id' => '\d+']
    )   
    ]
    )]
class Customers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: 'nome é obrigatório'
    )]
    #[Groups('customers')]
    private ?string $name = null;

    #[ORM\Column(length: 11, unique: true)]
    #[Assert\NotBlank(message: 'CPF é obrigatório')]
    #[MyConstrait\IsCpf]
    #[Groups('customers')]
    private ?string $cpf = null;

    #[ORM\Column(length: 15)]
    #[Assert\NotBlank(
        message: 'telefone é obrigatório'
    )]
    #[Groups('customers')]
    private ?string $phone = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Cars::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY')]
    private Collection $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): static
    {
        $this->cpf = str_replace(array('.','-','/'), "", $cpf);

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = str_replace(array('(',')',' '), "", $phone);

        return $this;
    }

    /**
     * @return Collection<int, Cars>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Cars $car): static
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setCustomer($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): static
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getCustomer() === $this) {
                $car->setCustomer(null);
            }
        }

        return $this;
    }
}
