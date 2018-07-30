<?php

declare(strict_types=1);

namespace App\Controller;

use App\File\Uploader;
use App\Form\Type\BannerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AddBanner extends Controller
{
    /**
     * @var Uploader
     */
    private $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @Route("/new", name="add_banner", methods="GET")
     */
    public function display(Request $request): Response
    {
        $form = $this->createForm(BannerType::class, null, ['method' => 'POST', 'action' => '/new']);

        return $this->render('banners/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/new", methods="POST")
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(BannerType::class, null, ['method' => 'POST', 'action' => '/new']);

        if ($form->handleRequest($request)->isValid()) {
            $this->getDoctrine()->getManager()->persist($form->getData());
            $this->getDoctrine()->getManager()->flush();

            $file = $form->get('bannerImage')->getData();

            // $this->uploader->upload($form->getData(), $file);

            return $this->redirectToRoute('list_banners');
        }

        return $this->render('banners/create.html.twig', ['form' => $form->createView()]);
    }
}
