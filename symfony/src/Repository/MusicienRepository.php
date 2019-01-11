<?php

namespace App\Repository;

use App\Entity\Musicien;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method Composer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Composer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Composer[]    findAll()
 * @method Composer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusicienRepository extends EntityRepository
{
    public function findMusicienResearch(string $musicienName)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata(Musicien::class, 'Musicien');
        $sql = "SELECT DISTINCT Musicien.* FROM Musicien
        WHERE Musicien.Nom_Musicien LIKE'%" .$musicienName. "%'"." OR Musicien.Prenom_Musicien LIKE '%".$musicienName."%'";
        $query = $em->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }

}
