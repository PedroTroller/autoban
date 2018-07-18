<?php

declare(strict_types=1);

namespace App\Form\DataMapper;

use Symfony\Component\Form\DataMapperInterface;
use App\Form\Type\CreatorType;
use App\Entity;
use DateTimeImmutable;
use App\Username\Hasher;

final class Creator implements DataMapperInterface
{
    /**
     * @var Hasher
     */
    private $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param \App\Entity\Creator $data
     */
    public function mapDataToForms($data, $forms)
    {
        $forms = iterator_to_array($forms);

        if (null === $data) {
            return;
        }
    }

    public function mapFormsToData($forms, &$data)
    {
        $forms = iterator_to_array($forms);

        if (null !== $data) {
            return;
        }

        switch ($forms['type']->getData()) {
            case CreatorType::TYPE_ANONYMOUS:
                $data = Entity\Creator::createAnonymous(
                    $this->hasher->hash($forms['email']->getData() ?: ''),
                    $forms['password']->getData()
                );
                break;
            case CreatorType::TYPE_COMPLETE:
                $data = Entity\Creator::createComplete(
                    $this->hasher->hash($forms['email']->getData() ?: ''),
                    $forms['password']->getData() ?: '',
                    $forms['email']->getData() ?: '',
                    $forms['givenName']->getData() ?: '',
                    $forms['familyName']->getData() ?: '',
                    DateTimeImmutable::createFromMutable($forms['birthDate']->getData())
                );
                break;
        }
    }
}
