<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\CreatorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AddCreator extends Controller
{
    /**
     * @Route("/creator/new", name="add_creator", methods="GET")
     */
    public function display(Request $request): Response
    {
        $form = $this->createForm(CreatorType::class, null, ['method' => 'POST', 'action' => '/creator/new']);

        return $this->render('creators/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/creator/new", methods="POST")
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(CreatorType::class, null, ['method' => 'POST', 'action' => '/creator/new']);

        if ($form->handleRequest($request)->isValid()) {
            $this->getDoctrine()->getManager()->persist($form->getData());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list_banners');
        }

        return $this->render('creators/create.html.twig', ['form' => $form->createView()]);
    }
}
