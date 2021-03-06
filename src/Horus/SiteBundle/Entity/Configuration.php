<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * Produit
 * @ORM\Entity
 * @ORM\Table(name="configuration")
 * @ORM\HasLifecycleCallbacks()
 */
class Configuration
{


    /**
     * Constructor
     */
    public function __construct(){
        $this->dateCreated = new \Datetime('now');
        $this->nombreParPage = 5;
        $this->quantity = true;
        $this->emballage = true;
        $this->etat = true;
        $this->horsStock = true;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="horaires", type="string", nullable=false)
     */
    private $horaires;

    /**
     * @ORM\Column(name="siret", type="string", nullable=false)
     */
    private $siret;


    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(name="ville", type="string", nullable=false)
     */
    private $ville;

    /**
     * @ORM\Column(name="zipcode", type="string", nullable=false)
     */
    private $zipcode;

    /**
     * @ORM\Column(name="adresse", type="string", nullable=false)
     */
    private $adresse;

    /**
     * @ORM\Column(name="tel", type="string", nullable=false)
     */
    private $tel;

    /**
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(name="nom", type="string", nullable=false)
     */
    private $nom;

    /**
     * @ORM\Column(name="nombre_par_page", type="integer", nullable=false)
     */
    private $nombreParPage;

    /**
     * @ORM\Column(name="montant_valide", type="integer", nullable=false)
     */
    private $montantValide;

    /**
     * @ORM\Column(name="prenom", type="string", nullable=false)
     */
    private $prenom;

    /**
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(name="background", type="string", nullable=false)
     */
    private $background;

    /**
     * @ORM\Column(name="color", type="string", nullable=false)
     */
    private $color;

    /**
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(name="menu", type="string", nullable=false)
     */
    private $menu;

    /**
     * @ORM\Column(name="emballage", type="boolean", nullable=false)
     */
    private $emballage;

    /**
     * @ORM\Column(name="etat", type="boolean", nullable=false)
     */
    private $etat;

    /**
     * @ORM\Column(name="panel", type="string", nullable=false)
     */
    private $panel;

    /**
     * @ORM\Column(name="url", type="string", nullable=false)
     */
    private $url;

    /**
     * @ORM\Column(name="jour_nouveau", type="integer", nullable=false)
     */
    private $jourNouveau;

    /**
     * @ORM\Column(name="order_by", type="integer", nullable=false)
     */
    private $orderBy;

    /**
     * @ORM\Column(name="order_by_type", type="boolean", nullable=false)
     */
    private $orderByType;

    /**
     * @ORM\Column(name="hors_stock", type="boolean", nullable=false)
     */
    private $horsStock;

    /**
     * @ORM\Column(name="quantity", type="boolean", nullable=false)
     */
    private $quantity;

    /**
     * @ORM\Column(name="entreprise", type="string", nullable=false)
     */
    private $entreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;


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
     * Set nom
     *
     * @param string $nom
     * @return Configuration
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Configuration
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Configuration
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set background
     *
     * @param string $background
     * @return Configuration
     */
    public function setBackground($background)
    {
        $this->background = $background;
        return $this;
    }

    /**
     * Get background
     *
     * @return string 
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Configuration
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set panel
     *
     * @param string $panel
     * @return Configuration
     */
    public function setPanel($panel)
    {
        $this->panel = $panel;
        return $this;
    }

    /**
     * Get panel
     *
     * @return string 
     */
    public function getPanel()
    {
        return $this->panel;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Configuration
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set entreprise
     *
     * @param string $entreprise
     * @return Configuration
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;
        return $this;
    }

    /**
     * Get entreprise
     *
     * @return string 
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set dateCreated
     *
     * @param datetime $dateCreated
     * @return Configuration
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
     * Set etat
     *
     * @param boolean $etat
     * @return Configuration
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean 
     */
    public function getEtat()
    {
        return $this->etat;
    }


    /**
     * Set nombreParPage
     *
     * @param string $nombreParPage
     * @return Configuration
     */
    public function setNombreParPage($nombreParPage)
    {
        $this->nombreParPage = $nombreParPage;
        return $this;
    }

    /**
     * Get nombreParPage
     *
     * @return string 
     */
    public function getNombreParPage()
    {
        return $this->nombreParPage;
    }

    /**
     * Set montantValide
     *
     * @param integer $montantValide
     * @return Configuration
     */
    public function setMontantValide($montantValide)
    {
        $this->montantValide = $montantValide;
        return $this;
    }

    /**
     * Get montantValide
     *
     * @return integer 
     */
    public function getMontantValide()
    {
        return $this->montantValide;
    }

    /**
     * Set emballage
     *
     * @param boolean $emballage
     * @return Configuration
     */
    public function setEmballage($emballage)
    {
        $this->emballage = $emballage;
        return $this;
    }

    /**
     * Get emballage
     *
     * @return boolean 
     */
    public function getEmballage()
    {
        return $this->emballage;
    }

    /**
     * Set jourNouveau
     *
     * @param boolean $jourNouveau
     * @return Configuration
     */
    public function setJourNouveau($jourNouveau)
    {
        $this->jourNouveau = $jourNouveau;
        return $this;
    }

    /**
     * Get jourNouveau
     *
     * @return boolean 
     */
    public function getJourNouveau()
    {
        return $this->jourNouveau;
    }

    /**
     * Set orderBy
     *
     * @param integer $orderBy
     * @return Configuration
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * Get orderBy
     *
     * @return integer 
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Set orderByType
     *
     * @param boolean $orderByType
     * @return Configuration
     */
    public function setOrderByType($orderByType)
    {
        $this->orderByType = $orderByType;
        return $this;
    }

    /**
     * Get orderByType
     *
     * @return boolean 
     */
    public function getOrderByType()
    {
        return $this->orderByType;
    }

    /**
     * Set horsStock
     *
     * @param boolean $horsStock
     * @return Configuration
     */
    public function setHorsStock($horsStock)
    {
        $this->horsStock = $horsStock;
        return $this;
    }

    /**
     * Get horsStock
     *
     * @return boolean 
     */
    public function getHorsStock()
    {
        return $this->horsStock;
    }

    /**
     * Set quantity
     *
     * @param boolean $quantity
     * @return Configuration
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Get quantity
     *
     * @return boolean 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Configuration
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set menu
     *
     * @param string $menu
     * @return Configuration
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
        return $this;
    }

    /**
     * Get menu
     *
     * @return string 
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Configuration
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
     * Set ville
     *
     * @param string $ville
     * @return Configuration
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Configuration
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Configuration
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Configuration
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Configuration
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set horaires
     *
     * @param string $horaires
     * @return Configuration
     */
    public function setHoraires($horaires)
    {
        $this->horaires = $horaires;
        return $this;
    }

    /**
     * Get horaires
     *
     * @return string 
     */
    public function getHoraires()
    {
        return $this->horaires;
    }

    /**
     * Set siret
     *
     * @param string $siret
     * @return Configuration
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
        return $this;
    }

    /**
     * Get siret
     *
     * @return string 
     */
    public function getSiret()
    {
        return $this->siret;
    }
}