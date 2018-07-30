<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Creator
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column
     */
    private $username;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $password;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $givenName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $familyName;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $birthDate;

    private function __construct(
        string $username,
        string $password,
        string $email                = null,
        string $givenName            = null,
        string $familyName           = null,
        DateTimeImmutable $birthDate = null
    ) {
        $this->username   = $username;
        $this->password   = $password;
        $this->email      = $email;
        $this->givenName  = $givenName;
        $this->familyName = $familyName;
        $this->birthDate  = $birthDate;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ? string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getGivenName(): ? string
    {
        return $this->givenName;
    }

    public function setGivenName(string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getFamilyName(): ? string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): void
    {
        $this->familyName = $familyName;
    }

    public function getBirthDate(): ? DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setBirthDate(DateTimeImmutable $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public static function createAnonymous(string $username, string $password): self
    {
        return new self($username, $password);
    }

    public static function createComplete(
        string $username,
        string $password,
        string $email,
        string $givenName,
        string $familyName,
        DateTimeImmutable $birthDate
    ) {
        return new self(...func_get_args());
    }
}
