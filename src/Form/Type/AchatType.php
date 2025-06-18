<?php

namespace App\Form\Type;

use App\Entity\Achat;
use App\Entity\User;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class AchatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('utilisateur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email', // ou autre champ
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
            ])
            ->add('montant', MoneyType::class)
            ->add('dateAchat', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ]);
    }
}