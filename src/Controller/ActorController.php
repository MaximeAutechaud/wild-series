<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Actor;
use App\Entity\Program;

/**
 * Class ActorController
 * @package App\Controller
 * @Route("actors", name="actor_")
 */
class ActorController extends AbstractController
{

    /**
     * @return Response
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->findAll();
        return $this->render('actor/index.html.twig', [
            'actors' => $actors,
        ]);
    }
    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @return Response
     */
    public function show(Actor $actor): Response
    {
        return $this->render("actor/show.html.twig", [
            "actor" => $actor
        ]);
    }

}
