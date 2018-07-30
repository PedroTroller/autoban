<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Banners")
 */
class Banner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $clientName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $redirectUrl;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $campainStartAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $desktopText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mobileText;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getName(): ? string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getClientName(): ? string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): void
    {
        $this->clientName = $clientName;
    }

    public function getRedirectUrl(): ? string
    {
        return $this->redirectUrl;
    }

    public function setRedirectUrl(string $redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCampainStartAt(): ? DateTime
    {
        return $this->campainStartAt;
    }

    public function setCampainStartAt(DateTime $campainStartAt): void
    {
        $this->campainStartAt = $campainStartAt;
    }

    public function getDesktopText(): ? string
    {
        return $this->desktopText;
    }

    public function setDesktopText(string $desktopText): void
    {
        $this->desktopText = $desktopText;
    }

    public function getMobileText(): ? string
    {
        return $this->mobileText;
    }

    public function setMobileText(string $mobileText): void
    {
        $this->mobileText = $mobileText;
    }
}
