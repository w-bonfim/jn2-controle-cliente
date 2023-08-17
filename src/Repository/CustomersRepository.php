<?php

namespace App\Repository;

use App\Entity\Cars;
use App\Entity\Customers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Customers>
 *
 * @method Customers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customers[]    findAll()
 * @method Customers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customers::class);
    }

   public function saveCostumer($request): ?Customers
   {
        $em = $this->getEntityManager();

        $data = json_decode(file_get_contents('php://input'), true);
        $name = isset($data['name']) ? $data['name'] : null;
        $cpf = isset($data['cpf']) ? str_replace(array('.','-','/'), "", $data['cpf']) : null;
        $phone = isset($data['phone']) ? $data['phone'] : null;
        $plate = isset($data['plate']) ? $data['plate'] : null;

        $customer = $em->getRepository(Customers::class)->findOneBy(['cpf' => $cpf]);
        if (!$customer) {
            $customer = new Customers();
        }
      
        $customer->setName($name);
        $customer->setCpf($cpf);
        $customer->setPhone($phone);
        
        $car = new Cars();
        $car->setPlate($plate);

        $customer->addCar($car);

        $em->persist($customer);
        $em->flush();

        return $customer;
   }
}
