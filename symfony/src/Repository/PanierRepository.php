<?php
/**
 * Created by PhpStorm.
 * User: ecado
 * Date: 12/01/19
 * Time: 10:21
 */

namespace App\Repository;


use App\Entity\Abonne;
use App\Entity\Achat;
use App\Entity\Album;
use App\Entity\Enregistrement;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method Achat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Achat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Achat[]    findAll()
 * @method Achat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanierRepository extends EntityRepository
{

    public function findPanierByAbonne(Abonne $abonne)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata(Enregistrement::class, 'Enregistrement');
        $sql = "SELECT Enregistrement.* FROM Abonne 
        INNER JOIN Achat ON Abonne.Code_Abonne = Achat.Code_Abonne
        INNER JOIN Enregistrement ON Achat.Code_Enregistrement = Enregistrement.Code_Morceau
        WHERE Achat.Achat_Confirme=0 AND Abonne.Code_Abonne=".$abonne->getCodeAbonne();
        $query = $em->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }

    public function findAchatsByAbonne(Abonne $abonne)
    {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata(Enregistrement::class, 'Enregistrement');
        $sql = "SELECT Enregistrement.* FROM Abonne 
        INNER JOIN Achat ON Abonne.Code_Abonne = Achat.Code_Abonne
        INNER JOIN Enregistrement ON Achat.Code_Enregistrement = Enregistrement.Code_Morceau
        WHERE Achat.Achat_Confirme=1 AND Abonne.Code_Abonne=".$abonne->getCodeAbonne();
        $query = $em->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }

}