<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VinylController
{
    #[Route(path:"/", name:"homepage")]
    public function homepage(): Response
    {
        return new Response('Testowa wiadomość');
    }
}