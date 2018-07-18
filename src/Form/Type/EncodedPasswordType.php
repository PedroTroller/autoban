<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

final class EncodedPasswordType extends AbstractType
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($options) {
                $data = $event->getData();
                $encoder = $this->encoderFactory->getEncoder($options['user_class']);

                $event->setData($encoder->encodePassword($data, null));
            })
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(['user_class'])
        ;
    }

    public function getParent()
    {
        return PasswordType::class;
    }
}
