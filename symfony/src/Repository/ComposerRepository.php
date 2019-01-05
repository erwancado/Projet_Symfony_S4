<?php

namespace App\Repository;

use App\Entity\Composer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Composer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Composer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Composer[]    findAll()
 * @method Composer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComposerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Composer::class);
    }

    public function findOeuvre(Musicien $musicien)
    {
        $qb = $this->createQueryBuilder('C');
        $qb->where('C.codeMusicien = :codeMusicien')
           ->setParameter('codeMusicien', $musicien->getCodeMusicien());

        return $qb->getQuery()->getResult();
    }
}
