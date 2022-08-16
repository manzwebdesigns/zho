<?php

namespace App\Controller;

use App\Entity\Hymn;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HymnController extends AbstractController
{
    #[Route('/hymns', name: 'app_hymn')]
    public function index(ManagerRegistry $registry): Response
    {
        $hymn = $registry->getRepository(Hymn::class)->findAll();

        return $this->render('hymn/index.html.twig', [
            'hymns' => $hymn,
        ]);
    }
}
