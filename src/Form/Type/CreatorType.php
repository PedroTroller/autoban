<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Creator;
use App\Form\DataMapper;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\NotBlank;

final class CreatorType extends AbstractType
{
    public const TYPE_ANONYMOUS = 'anonymous';
    public const TYPE_COMPLETE = 'complete';

    /**
     * @var DataMapper\CreatorType
     */
    private $dataMapper;

    public function __construct(DataMapper\Creator $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'type',
                ChoiceType::class,
                [
                    'mapped' => false,
                    'choices' => [self::TYPE_ANONYMOUS => self::TYPE_ANONYMOUS, self::TYPE_COMPLETE => self::TYPE_COMPLETE],
                ]
            )
            ->add('email', EmailType::class, ['required' => false])
            ->add('password', EncodedPasswordType::class, [
                'user_class' => Creator::class,
            ])
            ->add('givenName', TextType::class, ['required' => false])
            ->add('familyName', TextType::class, ['required' => false])
            ->add('birthDate', BirthdayType::class, ['required' => false])
        ;

        $builder->setDataMapper($this->dataMapper);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $useless = ['givenName', 'familyName', 'birthDate'];
            $form = $event->getForm();
            $data = $event->getData();

            if (self::TYPE_COMPLETE === $data['type']) {
                $form
                    ->add('givenName', TextType::class, ['required' => false, 'constraints' => new NotBlank()])
                    ->add('familyName', TextType::class, ['required' => false, 'constraints' => new NotBlank()])
                    ->add('birthDate', BirthdayType::class, ['required' => false, 'constraints' => new NotBlank()])
                ;

                return;
            }

            foreach ($useless as $field) {
                $form->remove($field);
                unset($data[$field]);
            }

            $event->setData($data);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('data_class', Creator::class)
            ->setDefault('empty_data', function (FormInterface $form) {
                $data = null;

                $this->dataMapper->mapFormsToData($form, $data);

                return $data;
            })
        ;
    }
}
