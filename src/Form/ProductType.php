<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\DataConvert\CentimeToMille;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TypeTextType::class, [
                'label' => 'Nom du produit',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'le nom à insérer'
                ]
            ])
            ->add(
                'ShortDesc',
                TextareaType::class,
                [
                    'label' => 'Description courte',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'la description à insérer'
                    ]
                ]
            )
            ->add('price', MoneyType::class, [
                'label' => 'Prix en',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'le prix à insérer'
                ],
                'divisor' => 100
            ])->add('picture', UrlType::class, [
                'label' => 'Image de produit',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => ' Url de l\'image'
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'attr' => ['class' => 'form-control'],
                'placeholder' => '-- Choisir une catégorie --',
                'class' => Category::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
