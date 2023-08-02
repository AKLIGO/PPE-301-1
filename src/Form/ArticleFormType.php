<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Type;
use App\Entity\Marque;
use App\Entity\ArticleImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom')
            ->add('description', TextType::class)
            ->add('prix_unitaire', MoneyType::class)
            ->add('stock', NumberType::class, [
                'html5' => true
            ])
            ->add('couleur', ChoiceType::class, [
                'choices' => [
                    'Rouge' => 'rouge',
                    'Vert' => 'vert',
                    'Bleu' => 'bleu',
                ],
            ])
            ->add('valid', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'nom',
            ])
            ->add('articleImages', CollectionType::class, [
                'entry_type' => ArticleImageFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'nom',
            ]);
        // ->add('nom')
        // ->add('description')
        // ->add('prix_unitaire')
        // ->add('stock')
        // ->add('couleur', ChoiceType::class, [
        //     'choices' => [
        //         'Rouge' => 'rouge',
        //         'Vert' => 'vert',
        //         'Bleu' => 'bleu',
        //     ],
        // ])
        // ->add('valid', ChoiceType::class, [
        //     'choices' => [
        //         'Oui' => true,
        //         'Non' => false,
        //     ],
        //     'expanded' => true,
        // ])
        // ->add('type', EntityType::class, [
        //     'class' => Type::class,
        //     'choice_label' => 'nom',
        // ])
        // ->add('marque', EntityType::class, [
        //     'class' => Marque::class,
        //     'choice_label' => 'nom',
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
