<?php

namespace App\Repository;

use App\Entity\Hopitaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hopitaux>
 *
 * @method Hopitaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hopitaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hopitaux[]    findAll()
 * @method Hopitaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HopitauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hopitaux::class);
    }

    public function save(Hopitaux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Hopitaux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllHopitauxQuery()
    {
        return $this->createQueryBuilder('p')
        ->orderBy('p.id','ASC')
        ->getQuery();
    }

    public function searchHopitaux($query)
    {
        return $this->createQueryBuilder('p')
            ->where('p.name LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Hopitaux[] Returns an array of Hopitaux objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Hopitaux
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
