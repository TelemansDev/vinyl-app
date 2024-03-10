<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\UnicodeString;

class VinylController extends AbstractController
{
    #[Route(path:"/", name:"homepage")]
    public function homepage(): Response
    {
        return new Response('Testowa wiadomość');
    }

    #[Route(path:'/browse/{slug}', name:'browse')]
    public function browse(Request $request, string $slug = ''): Response
    {
        if ($slug) {
            $unicodeSlug = new UnicodeString($slug);
            $title = 'Genre: ' . $unicodeSlug->title(true);
        } else {
            $title = 'All genres';
        }

        return new Response($title);
    }
}