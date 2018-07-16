<?php

declare(strict_types=1);

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class DateTimeExtension extends AbstractTypeExtension
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['attr'] = ['foo' => 'bar'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('widget', 'single_text')
        ;
    }

    public function getExtendedType()
    {
        return DateTimeType::class;
    }
}
