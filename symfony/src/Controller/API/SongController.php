<?php

declare(strict_types=1);

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    #[Route(path:"/api/songs/{id}", name:"api_get_song")]
    public function getSong(int $id): JsonResponse
    {
         // TODO query the database
         $song = [
            'id' => $id,
            'name' => 'Waterfalls',
            'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ];
        
        return new JsonResponse($song);
    }
}