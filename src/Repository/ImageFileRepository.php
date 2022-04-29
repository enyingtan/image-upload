<?php

namespace App\Repository;

use App\Entity\ImageFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageFile>
 *
 * @method ImageFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageFile[]    findAll()
 * @method ImageFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageFile::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ImageFile $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ImageFile $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return ImageFile[] Returns an array of ImageFile objects
     */
    public function findByTagSearch($term)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.tags like :searchTerm')
            ->setParameter('searchTerm', '%'.$term.'%')
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return ImageFile[] Returns an array of ImageFile objects by full text search
     */
    public function searchByFullTextColumn($term)
    {

        if (empty($term)) {
            return $this->createQueryBuilder('i')
                ->andWhere('i.tags like :searchTerm')
                ->setParameter('searchTerm', '%'.$term.'%')
                ->orderBy('i.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult();
        } else {                
            $rsm = new ResultSetMapping();
            // Specify the object type to be returned in results
            $rsm->addEntityResult(ImageFile::class, 'i');
    
            // references each attribute with table's columns 
            $rsm->addFieldResult('i', 'tags', 'tags');
            $rsm->addFieldResult('i', 'image_name', 'imageName');
            $rsm->addFieldResult('i', 'path_name', 'pathName');
            $rsm->addFieldResult('i', 'id', 'id');
    
            // create a native query
            $sql = 'select * from image_file i 
                    where match(i.tags, i.image_name) against("'.$term.'")';
    
            // execute the query
            $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
    
            // getting the results
            return $query->getResult();
        }
    }


    /*
    public function findOneBySomeField($value): ?ImageFile
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
