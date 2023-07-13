<?php

namespace App\Repository;

use App\Entity\CouponsCommandes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CouponsCommandes>
 *
 * @method CouponsCommandes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CouponsCommandes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CouponsCommandes[]    findAll()
 * @method CouponsCommandes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouponsCommandesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CouponsCommandes::class);
    }

//    /**
//     * @return CouponsCommandes[] Returns an array of CouponsCommandes objects
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

//    public function findOneBySomeField($value): ?CouponsCommandes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
