<?php
/**
 * Created by PhpStorm.
 * User: ecado
 * Date: 10/01/19
 * Time: 17:26
 */

namespace App\Repository;


use App\Entity\Album;
use App\Entity\Composer;
use App\Entity\Enregistrement;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method Composer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Composer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Composer[]    findAll()
 * @method Composer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumRepository extends EntityRepository
{

    public function findEnregistrements(Album $album)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata(Enregistrement::class, 'Enregistrement');
        $sql = 'SELECT DISTINCT Enregistrement.* FROM Enregistrement 
        INNER JOIN Composition_Disque C on Enregistrement.Code_Morceau = C.Code_Morceau
        INNER JOIN Disque D on C.Code_Disque = D.Code_Disque
        INNER JOIN Album A on D.Code_Album = A.Code_Album
        WHERE A.Code_Album = '.$album->getCodeAlbum();
        $query = $em->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }

    public function findAlbumsResearch(string $albumName)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata(Album::class, 'Album');
        $sql = "SELECT DISTINCT Album.* FROM Album
        WHERE Album.Titre_Album LIKE'%" .$albumName. "%'";
        $query = $em->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }

}