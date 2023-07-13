<?php

namespace App\Repository;

use App\Entity\CommandUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommandUsers>
 *
 * @method CommandUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandUsers[]    findAll()
 * @method CommandUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandUsers::class);
    }

//    /**
//     * @return CommandUsers[] Returns an array of CommandUsers objects
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

//    public function findOneBySomeField($value): ?CommandUsers
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
