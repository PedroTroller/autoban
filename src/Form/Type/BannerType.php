<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Banner;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Form\Type\ClientType;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

final class BannerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('data_class', Banner::class)
        ;
    }
}
