<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Horus\SiteBundle\Entity\Category;

/**
 * Class CategoryRepository
 * @package Horus\SiteBundle\Repository
 */
class CategoryRepository extends EntityRepository
{
    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getArticlesByCategory(Category $category = null)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT a FROM HorusSiteBundle:Article a WHERE a.category = :category")
            ->setParameter('category', $category)
            ->setMaxResults(15);


        return $query->getResult();
    }

    /**
     * Get Active Category
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getActiveCategoryQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Category', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

    /**
     * If on category
     * @return mixed
     */
    public function isCategory()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HorusSiteBundle:Category a");
        return $query->getOneOrNullResult();
    }


    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getCategoryIsProductNull()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Category a  WHERE a.produits IS EMPTY");
        return $query->getSingleScalarResult();
    }

    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getCategoryIsDesactive()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Category a WHERE a.visible = :visible")
            ->setParameter('visible', false);
        return $query->getSingleScalarResult();
    }




}