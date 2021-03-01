<?php

namespace App\Repository;

use App\Entity\Inscricao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inscricao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscricao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscricao[]    findAll()
 * @method Inscricao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscricaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inscricao::class);
    }

    // /**
    //  * @return Inscricao[] Returns an array of Inscricao objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Inscricao
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
