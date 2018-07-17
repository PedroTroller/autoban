<?php

declare(strict_types=1);

namespace App\Username;

final class Hasher
{
    public function hash(string $string): string
    {
        return sha1($string);
    }
}
