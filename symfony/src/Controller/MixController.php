<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\VinylMix;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MixController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    #[Route('/mix/new', 'mix_add_new')]
    public function new(): Response
    {
        $mix = new VinylMix();
        $mix->setTitle('Do you Remember... Phil Collins?!');
        $mix->setDescription('A pure mix of drummers turned singers!');

        $genres = ['pop', 'rock'];
        $mix->setGenre($genres[array_rand($genres)]);

        $mix->setTrackCount(rand(5, 20));
        $mix->setVotes(rand(-50, 50));

        $this->entityManager->persist($mix);
        $this->entityManager->flush();

        return new Response(
          sprintf('Mix %d is %d tracks of pure 80\'s haven', $mix->getId(), $mix->getTrackCount())
        );
    }

    #[Route('/mix/{id}', 'mix_show')]
    public function show(VinylMix $mix): Response
    {
        return $this->render('mix/show.html.twig', [
            'mix' => $mix
        ]);
    }
}