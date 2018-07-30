<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Repository\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ClientType extends AbstractType implements DataTransformerInterface
{
    /**
     * @var Clients
     */
    private $clients;

    private const TYPE_EXISTING = 'existing';
    private const TYPE_NEW      = 'new';

    public function __construct(Clients $clients)
    {
        $this->clients = $clients;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'type',
                ChoiceType::class,
                [
                    'mapped'  => false,
                    'choices' => ['new client' => self::TYPE_NEW, 'existing client' => self::TYPE_EXISTING],
                ]
            )
            ->add(
                'new',
                TextType::class,
                [
                    'required' => false,
                ]
            )
            ->add(
                'list',
                ChoiceType::class,
                [
                    'required' => false,
                    'choices'  => array_combine($this->clients->findAll(), $this->clients->findAll()),
                ]
            )
            ->addModelTransformer($this)
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event): void {
                $data = $event->getData();

                switch ($data['type']) {
                    case self::TYPE_EXISTING:
                        $event->getForm()->remove('new');
                        unset($data['new']);
                        break;
                    case self::TYPE_NEW:
                        $event->getForm()->remove('list');
                        unset($data['list']);
                        break;
                }

                $event->setData($data);
            });
    }

    public function transform($value)
    {
        if (null === $value) {
            return [];
        }

        return [
            'list' => [$value],
        ];
    }

    public function reverseTransform($value)
    {
        if (null === $value) {
            return null;
        }

        if (false === empty($value['new'])) {
            return $value['new'];
        }

        return $value['list'];
    }
}
