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
     * @ORM\Column(name="path", type="string", length=200, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(name="vues", type="integer", nullable=true)
     */
    private $vues;



    /**
     * @Assert\Image(
     *     minWidth = 200,
     *     minHeight  = 100,
     *     maxWidth = 3000,
     *     maxHeight = 3000,
     *     maxSize = "6000k",
     *     mimeTypes = {"image/jpg","image/jpeg", "image/png", "image/gif", "image/bmp"},
     *     mimeTypesMessage = "Image au format non supporté",
     *    maxWidthMessage = "Image trop grande en largeur {{ width }}px. Le maximum en largeur est de {{ max_width }}px" ,
     *    minWidthMessage = "Image trop petite en largeur {{ width }}px. Le minimum en largeur est de {{ min_width }}px" ,
     *    minHeightMessage = "Image trop petite en hauteur {{ height }}px. Le mimum en hauteur est de {{ min_height }}px" ,
     *    maxHeightMessage = "Image trop grande en hauteur  {{ height }}px. Le maximum en hauteur est de {{ max_height }}px"
     * )
     */
    public $file;


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
     * @Assert\Choice(choices = {"1","2", "3"}, message = "Choisissez un genre valide.")
     * @ORM\Column(name="nature", type="integer", length=200, nullable=true)
     */
    private $nature;


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
        $this->nature = 3;
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
            html_entity_decode('...', ENT_QUOTES, 'UTF-8'),
            ($this->getLvl() + 1) * 2
        ) . $this->getName();
    }


    /**
     * Set nature
     *
     * @param integer $nature
     * @return Page
     */
    public function setNature($nature)
    {
        $this->nature = $nature;
        return $this;
    }

    /**
     * Get nature
     *
     * @return integer 
     */
    public function getNature()
    {
        return $this->nature;
    }




    /**
     *  Upload Images
     *
     * @return text
     */

    public function getAbsolutePath()
    {
        return null === $this->picture ? null : $this->getUploadRootDir().'/'.$this->picture;
    }

    public function getWebPath()
    {
        return null === $this->picture ? null : $this->getUploadDir().'/'.$this->picture;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/pages/';
    }



    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->picture = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        }
    }


    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload($id = null)
    {

        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->file) {
            return;
        }

//
//        if(!is_dir(@mkdir($this->getUploadRootDir().'/'.$id)))
//            @mkdir($this->getUploadRootDir().'/'.$id);


        // utilisez le nom de fichier original ici mais
        // vous devriez « l'assainir » pour au moins éviter
        // quelconques problèmes de sécurité

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé


        $rewritename = sha1(uniqid(mt_rand(), true));
        $rewritefile = $rewritename.'.'.$this->file->guessExtension();
        $extension = $this->file->guessExtension();

        $this->file->move($this->getUploadRootDir(), $rewritefile);

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->picture = $rewritefile;

//        $this->picture = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();

        //Original photo
        $bigfile = $this->getUploadRootDir().$rewritefile;

        if ($extension == "jpg" || $extension == "jpeg") {
            $src_img = imagecreatefromjpeg($bigfile);
        }
        if ($extension == "png") {
            $src_img = imagecreatefrompng($bigfile);
        }
        if ($extension == "gif") {
            $src_img = imagecreatefromgif($bigfile);
        }

        // Le ratio de l'image uploadée
        $oldWidth = imageSX($src_img);
        $oldHeight = imageSY($src_img);
        $ratio = $oldWidth / $oldHeight;

        $taille = array(
            array(
                'name' => 'big',
                'width' => 800,
                'height' => 600
            ),
            array(
                'name' => 'medium',
                'width' => 300,
                'height' => 260
            ),
            array(
                'name' => 'small',
                'width' => 250,
                'height' => 180
            ),
        );

        // C'est parti
        foreach ($taille as $value) {

            // On prépare les valeurs
            $width = $value['width'] - 1;
            $height = $value['height'] -1;
            $ratioImg = $width / $height;

            // On calcule les nouvelles
            if ($ratioImg > $ratio) {
                $newWidth = $width;
                $newHeight = $width / $ratio;
            } elseif ($ratioImg < $ratio) {
                $newHeight = $height;
                $newWidth = $height * $ratio;
            } else {
                $newWidth = $width;
                $newHeight = $height;
            }

            // Point de départ du crop
            $x = ($newWidth - $width) / 2;
            $y = 0;

            // On bosse sur l'image
            $imagine = new \Imagine\Gd\Imagine();
            $imagine
                ->open($bigfile)
                ->thumbnail(new \Imagine\Image\Box($newWidth, $newHeight))
                ->save(
                    $this->getUploadRootDir(). $rewritename . '-' . $value['name']. '.' . $extension,
                    array(
                        'quality' => 80
                    )
                );
        }

        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            @unlink($file);
        }
    }



    /**
     * Set picture
     *
     * @param string $picture
     * @return Page
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set vues
     *
     * @param integer $vues
     * @return Page
     */
    public function setVues($vues)
    {
        $this->vues = $vues;
        return $this;
    }

    /**
     * Get vues
     *
     * @return integer 
     */
    public function getVues()
    {
        return $this->vues;
    }
}