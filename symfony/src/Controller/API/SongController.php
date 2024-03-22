<?php

declare(strict_types=1);

namespace App\Controller\API;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    #[Route(path:"/api/songs/{id<\d+>}", name:"api_get_song", methods: 'GET')]
    public function getSong(int $id, LoggerInterface $logger): JsonResponse
    {
         // TODO query the database
         $song = [
            'id' => $id,
            'name' => 'Waterfalls',
            'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ];

        $logger->info('Returning API response for ' . $id);
        
        return new JsonResponse($song);
    }
}