<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ImageRepository
 * @package Horus\SiteBundle\Repository
 */
class ImageRepository extends EntityRepository
{

    /**
     * Get Active Image
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getActiveImageQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Image', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }


    /**
     * If on category
     * @return mixed
     */
    public function isFirstImage($id = null)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HorusSiteBundle:Image a WHERE a.produit = :produit")->setParameter('produit', $id);
        return $query->getOneOrNullResult();
    }

}