<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Banner;

final class Clients
{
    /**
     * @var Banners
     */
    private $banners;

    public function __construct(Banners $banners)
    {
        $this->banners = $banners;
    }

    public function findAll(): array
    {
        $clients = array_map(
            function (Banner $banner) {
                return $banner->getClientName();
            },
            $this->banners->findAll()
        );

        return array_unique($clients);
    }
}
