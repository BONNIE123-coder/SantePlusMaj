<?php

namespace App\Repository;

use App\Entity\Cliniques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cliniques>
 *
 * @method Cliniques|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliniques|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliniques[]    findAll()
 * @method Cliniques[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CliniquesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cliniques::class);
    }

    public function save(Cliniques $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cliniques $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllCliniquesQuery()
    {
        return $this->createQueryBuilder('p')
        ->orderBy('p.id','ASC')
        ->getQuery();
    }

//    /**
//     * @return Cliniques[] Returns an array of Cliniques objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cliniques
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
