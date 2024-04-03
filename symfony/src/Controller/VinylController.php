<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\UnicodeString;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class VinylController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {}

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
    public function browse(string $slug = ''): Response
    {
        return $this->render('vinyl/browse.html.twig', [
            'genre' => $this->prepareGenre($slug),
            'mixes' => $this->getMixes(),
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

    private function getMixes(): array
    {
        try {
            $response = $this->httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');

            return $response->toArray();
        } catch (Exception) {
            return [];
        }
    }
}