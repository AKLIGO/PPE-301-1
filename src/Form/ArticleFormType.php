<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Type;

use App\Entity\ArticlesImages;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('prix')
            ->add('stock')
            ->add('creat_at')
            ->add('valid')
            ->add('slug')
            ->add('Type', EntityType::class, [

                'class' => Type::class,
                'choice_label' => 'Type',
                'placeholder' => 'Select the type'
            ])

            ->add('articlesImages', EntityType::class, [
                'class' => ArticlesImages::class,
                'choice_label' => function (ArticlesImages $articleImage) {
                    return $articleImage->getImages();
                },
                'placeholder' => 'Select the image',
                'group_by' => function (ArticlesImages $articleImage) {
                    return $articleImage->getArticlesImages();
                },
            ]);
    }
    // ->add('articlesImages',EntityType::class, [
    //     'class' => ArticlesImages::class,
    //     'choice_label' => function (ArticlesImages $articleImage) {
    //         return $articleImage->getFileName();
    //     },
    //     'placeholder' => 'Select the image',
    //     'group_by' => function (ArticlesImages $articleImage) {
    //         return $articleImage->getArticlesImages(); 
    //     },
    // ]);


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
