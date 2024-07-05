<?php

namespace App\Controller;

use App\Repository\VinylMixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\UnicodeString;

class VinylController extends AbstractController
{
    #[Route(path:"/", name:"homepage")]
    public function homepage(): Response
    {
        $tracks = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Waterfalls', 'artist' => 'TLC'],
            ['song' => 'Creep', 'artist' => 'Radiohead'],
            ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];

        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'PB & Jams',
            'tracks' => $tracks,
        ]);
    }

    #[Route(path:'/browse/{slug}', name:'browse')]
    public function browse(VinylMixRepository $vinylMixRepository, string $slug = ''): Response
    {
        return $this->render('vinyl/browse.html.twig', [
            'genre' => $this->prepareGenre($slug),
            'mixes' => $vinylMixRepository->findAllOrderedByVotes($slug),
        ]);
    }

    private function prepareGenre(string $slug): string
    {
        if ($slug) {
            $unicodeSlug = new UnicodeString($slug);

            return 'Genre: ' . $unicodeSlug->title(true);
        }

        return 'All genres';
    }
}