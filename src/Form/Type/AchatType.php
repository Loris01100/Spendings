<?php

namespace App\Form\Type;

use App\Entity\Achat;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AchatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'constraints' => [
                    new Assert\Length(max: 255),
                ]
            ])
            ->add('montant', MoneyType::class, [
                'label' => 'Montant',
                'currency' => 'EUR',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThan(0),
                ]
            ])
            ->add('date_achat', DateType::class, [
                'label' => 'Date d\'achat',
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
            ->add('categorie', EntityType::class, [
                'label' => 'Catégorie',
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'placeholder' => '-- Choisir une catégorie --',
                'constraints' => [
                    new Assert\NotNull(),
                ]
            ]);

        // Ajouter un bouton uniquement si le formulaire est actif
        if ($builder->getDisabled() === false) {
            $builder->add('submit', SubmitType::class, [
                'label' => $options['is_edit'] ? 'Modifier' : 'Ajouter',
                'attr' => [
                    'class' => $options['is_edit'] ? 'btn btn-warning' : 'btn btn-success'
                ],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Achat::class,
            'translation_domain' => false,
            'is_edit' => false,
        ]);
    }
}