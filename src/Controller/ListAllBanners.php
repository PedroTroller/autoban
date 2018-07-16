<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Banner;

final class ListAllBanners extends Controller
{
    /**
     * @Route("/", name="list_banners")
     */
    public function __invoke(Request $request): Response
    {
        $banners = $this
            ->getDoctrine()
            ->getRepository(Banner::class)
            ->findBy([], ['createdAt' => 'DESC']);

        return $this->render('banners/list.html.twig', ['banners' => $banners]);
    }
}
