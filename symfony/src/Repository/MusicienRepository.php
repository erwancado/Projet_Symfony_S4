<?php

namespace App\Repository;

use App\Entity\Musicien;
use App\Entity\Album;
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

    public function findAlbumsByMusicien(Musicien $musicien)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata(Album::class, 'Album');
        $sql = 'SELECT DISTINCT A.* FROM Interpreter
        INNER JOIN Musicien ON Interpreter.Code_Musicien = Musicien.Code_Musicien
        INNER JOIN Enregistrement E on Interpreter.Code_Morceau = E.Code_Morceau
        INNER JOIN Composition_Disque C on E.Code_Morceau = C.Code_Morceau
        INNER JOIN Disque D2 on C.Code_Disque = D2.Code_Disque
        INNER JOIN Album A on D2.Code_Album = A.Code_Album
        WHERE Musicien.Code_Musicien = ' . $musicien->getCodeMusicien();

        $query = $em->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }

}
