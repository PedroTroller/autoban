<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Banner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Url;

final class BannerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('clientName', ClientType::class)
          // ->add(
          //     'redirectUrl',
          //     TextType::class,
          //     [
          //         'constraints' => new Url(),
          //     ]
          // )
          // ->add('campainStartAt', DateTimeType::class)
          // ->add('desktopText', TextareaType::class)
          // ->add(
          //     'mobileText',
          //     TextareaType::class,
          //     [
          //         'constraints' => new Length(['max' => 100]),
          //     ]
          // )
            ->add('bannerImage', FileType::class, [
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('data_class', Banner::class)
        ;
    }
}
