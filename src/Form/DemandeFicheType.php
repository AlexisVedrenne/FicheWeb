<?php

namespace App\Form;

use App\Entity\DemandeFiche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Categorie;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DemandeFicheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('objet',TextType::class)
        ->add('categorie',EntityType::class,[
            'class'=>Categorie::class,
            'choice_label'=>'nom',
            'expanded'=>false,
            'multiple'=>false,

        ])  
        ->add('message',TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DemandeFiche::class,
        ]);
    }
}
