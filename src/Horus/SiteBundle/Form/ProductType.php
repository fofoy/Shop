<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Class ProductType
 * @package Horus\SiteBundle\Form
 */
class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('attr' => array('class' => 'popov form-control', 'placeholder' => 'Ex:  Kindle Paperwhite', "data-content" => "Un titre explicite à votre produit")))
            ->add('accroche', 'text', array('attr' => array('class' => 'popov form-control', "data-content" => "Une accroche attractive de votre produit", 'placeholder' => "Ex:  Le meilleur appareil pour lecture, un point c'est tout")))
            ->add('video', 'text', array('required' => false, 'attr' => array('class' => 'popov form-control', "data-content" => "Une vidéo Youtube, Dailymotion, Vimeo de présentation", 'placeholder' => "Ex:  http://www.youtube.com/watch?v=BQjqM24uWr8")))
            ->add('reference', 'text', array('required' => true, 'attr' => array('class' => 'popov form-control', "data-content" => "Une référence unique", 'placeholder' => 'Ex: EAX09-A')))
            ->add('ean', 'text', array('required' => false, 'attr' => array('placeholder' => 'Ex: 471-9-5120-0288-x')))
            ->add('quantity', 'integer', array('required' => true, 'attr' => array('class' => 'form-control', 'placeholder' => 'Ex: 12')))
            ->add('poid', 'text', array('required' => false, 'label' => 'Poid(Kg.)', 'attr' => array('class' => 'popov form-control', "data-content" => "Un poid en kilo pour le transport", 'placeholder' => 'Ex: 5')))
            ->add('home', 'checkbox', array('required' => false, 'label' => "Visible en page d'accueil"))
            ->add('longueur', 'text', array('required' => false, 'label' => 'Longeur(cm.)', 'attr' => array('class' => 'form-control', 'placeholder' => 'Ex: 35')))
            ->add('largeur', 'text', array('required' => false, 'label' => 'Largeur(cm.)', 'attr' => array('class' => 'form-control', 'placeholder' => 'Ex: 25')))
            ->add('profondeur', 'text', array('required' => false, 'label' => 'Profondeur(cm.)', 'attr' => array('class' => 'form-control', 'placeholder' => 'Ex: 15')))
            ->add('position', 'integer', array('required' => false, 'label' => 'Positionnement', 'attr' => array('class' => 'form-control', 'placeholder' => 'Ex: 15')))
            ->add('hauteur', 'text', array('required' => false, 'label' => 'Hauteur(cm.)', 'attr' => array('class' => 'form-control', 'placeholder' => 'Ex: 15')))
            ->add('etat', 'choice', array(
                'attr' => array('class' => 'rad'),
                'choices' => array(1 => 'Neuf', 2 => 'Occasion', 3 => 'Reconditionné'),
                'required' => true,
                'expanded' => true,
            ))
            ->add('tva', 'choice', array(
                'attr' => array('class' => 'rad'),
                'choices' => array("19.6" => '19.6%', "20" => '20%',  "10" => '10%',"7" => '7%', "5.5" => '5.5%', "2.1" => '2.1%', '0' => '0%'),
                'required' => true,
                'preferred_choices' => array('19.6')
            ))
            ->add('status', 'choice', array(
                'attr' => array('class' => 'rad'),
                'choices' => array(1 => 'Disponible à la vente', 2 => 'Juste afficher le prix', 3 => 'Gratuit'),
                'required' => true,
                'expanded' => true
            ))
            ->add('category', null, array('required' => true, 'property' => 'optionLabel'))
            ->add('isShop')
            ->add('accesories')
            ->add('cates', null, array('property' => 'optionLabel'))
            ->add('articles')
            ->add('marque', 'entity', array(
                'required' => false,
                'empty_value' => 'Choisissez une marque',
                'class' => 'HorusSiteBundle:Marques',
                'property' => 'OptionLabel',
            ))
            ->add('fournisseur')
            ->add('tags')
            ->add('familles')
            ->add('prodparent', null, array('empty_value' => 'Choisissez un produit'))
            ->add('metas', 'collection', array(
                'type' => new MetaType(),
                'by_reference' => true,
                'allow_delete' => true,
                'allow_add' => true
            ))
            ->add('liens', 'collection', array(
                'type' => new LiensType(),
                'by_reference' => true,
                'allow_delete' => true,
                'allow_add' => true
            ))
            ->add('pjs', 'collection', array(
                'type' => new PjType(),
                'by_reference' => true,
                'allow_delete' => true,
                'allow_add' => true
            ))
            ->add('seo', 'collection', array('type' => new SeoType()))
            ->add('transport', null, array('required' => true))
            ->add('livraison', 'checkbox', array('label' => 'Livraison gratuite', 'attr' => array()))
            ->add('prixHT', 'text', array('attr' => array('placeholder' => 'Ex: 15€')))
            ->add('prixTTC', 'text', array('attr' => array('placeholder' => 'Ex: 19€')))
            ->add('cover', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Résumé en quelques mots')))
            ->add('service', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Ex: Garantie, Installation etc... ')))
            ->add('securite', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Ex: Consignes de sécurité ')))
            ->add('extras', 'textarea', array('required' => false, 'attr' => array('class' => 'form-control', 'cols' => 50, 'rows' => 6, 'placeholder' => 'Commentaire sur le produit')))
            ->add('tags')
            ->add('content', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'La description complè')))
            ->add('isVisible', null, array('required' => false))
            ->add('threeTime', null, array('required' => false))
            ->add('datePublication', 'date', array('widget' => 'single_text', 'attr' => array('class' => 'form-control', 'placeholder' => 'Format: AAAA-MM-JJ')));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Produit',
            'csrf_protection' => false
        ));
    }
}
