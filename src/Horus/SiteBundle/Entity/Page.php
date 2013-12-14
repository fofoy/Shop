<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Horus\SiteBundle\Util\Box;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Page
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\PageRepository")
 * @ORM\Table(name="page")
 * @ORM\HasLifecycleCallbacks()
 */
class Page
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Assert\NotBlank(
     *     message = "Le titre ne doit pas etre vide"
     * )
     * @ORM\Column(name="name", type="string", length=200, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(name="path", type="string", length=3000, nullable=true)
     */
    private $path;
    
    /**
     * @Assert\NotBlank(
     *     message = "La description ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "5",
     *      max = "50000",
     *      minMessage = "Votre description doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre description ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    /**
     * @Assert\Length(
     *      min = "5",
     *      max = "30000",
     *      minMessage = "Votre chapeau doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre chapeau ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="chapeau", type="text", nullable=true)
     */
    private $chapeau;
    
    /**
     * @Assert\NotBlank(
     *     message = "Le résumé ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "3",
     *      max = "6000",
     *      minMessage = "Votre résumé doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre résumé ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="cover", type="text", nullable=true)
     */
    private $cover;


    /**
     * @var integer
     * @Assert\Url(message="Votre URL de Vidéo n'est pas valide")
     * @Assert\Length(
     *      min = "8",
     *      max = "1000",
     *      minMessage = "Votre video doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre video ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="video", type="string", length=200, nullable=false)
     */
    private $video;

    /**
     * @ORM\ManyToMany(targetEntity="Produit")
     */
    protected $produits;


    /**
     * @var string
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;


    /**
     * @var string
     *
     * @ORM\Column(name="visible", type="boolean", nullable=true)
     */
    private $visible;


    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;


    /**
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="pages", cascade={"all"},orphanRemoval=true)
     * @ORM\JoinTable(name="article_page")
     */
    protected $articles;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->visible = true;
        $this->dateCreated = new \DateTime('now');
    }



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Page
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Page
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Page
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set cover
     *
     * @param text $cover
     * @return Page
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * Get cover
     *
     * @return text 
     */
    public function getCover()
    {
        if(!empty($this->cover))
            return $this->cover;
        else
            return Box::limit_words($this->description);
    }

    /**
     * Set dateCreated
     *
     * @param datetime $dateCreated
     * @return Page
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return datetime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Page
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Page
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Page
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Page
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Page
     */
    public function setRoot($root)
    {
        $this->root = $root;
        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Add produits
     *
     * @param Horus\SiteBundle\Entity\Produit $produits
     * @return Page
     */
    public function addProduit(\Horus\SiteBundle\Entity\Produit $produits)
    {
        $this->produits[] = $produits;
        return $this;
    }

    /**
     * Remove produits
     *
     * @param Horus\SiteBundle\Entity\Produit $produits
     */
    public function removeProduit(\Horus\SiteBundle\Entity\Produit $produits)
    {
        $this->produits->removeElement($produits);
    }

    /**
     * Get produits
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * Set parent
     *
     * @param Horus\SiteBundle\Entity\Category $parent
     * @return Page
     */
    public function setParent(\Horus\SiteBundle\Entity\Page $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Horus\SiteBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param Horus\SiteBundle\Entity\Category $children
     * @return Page
     */
    public function addChildren(\Horus\SiteBundle\Entity\Page $children)
    {
        $this->children[] = $children;
        return $this;
    }

    /**
     * Remove children
     *
     * @param Horus\SiteBundle\Entity\Category $children
     */
    public function removeChildren(\Horus\SiteBundle\Entity\Page $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add articles
     *
     * @param Horus\SiteBundle\Entity\Article $articles
     * @return Page
     */
    public function addArticle(\Horus\SiteBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;
        return $this;
    }

    /**
     * Remove articles
     *
     * @param Horus\SiteBundle\Entity\Article $articles
     */
    public function removeArticle(\Horus\SiteBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    public function __toString(){
        return Box::limit_words($this->getName());
    }

    /**
     * Set chapeau
     *
     * @param text $chapeau
     * @return Page
     */
    public function setChapeau($chapeau)
    {
        $this->chapeau = $chapeau;
        return $this;
    }

    /**
     * Get chapeau
     *
     * @return text 
     */
    public function getChapeau()
    {
        return $this->chapeau;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return Page
     */
    public function setVideo($video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }


    public function getOptionLabel()
    {
        return str_repeat(
            html_entity_decode('>>', ENT_QUOTES, 'UTF-8'),
            ($this->getLvl() + 1) * 2
        ) . $this->getName();
    }

}