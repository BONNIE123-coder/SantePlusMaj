<?php

namespace App\Repository;

use App\Entity\Pharmacies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pharmacies>
 *
 * @method Pharmacies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pharmacies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pharmacies[]    findAll()
 * @method Pharmacies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PharmaciesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pharmacies::class);
    }

    public function save(Pharmacies $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Pharmacies $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllPharmaciesQuery()
    {
        return $this->createQueryBuilder('p')
        ->orderBy('p.id','ASC')
        ->getQuery();
    }

//    /**
//     * @return Pharmacies[] Returns an array of Pharmacies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pharmacies
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
