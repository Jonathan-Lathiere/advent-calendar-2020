<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $finder = new Finder();

        $days = $finder->files()->in('../src/Day/*/')->name('*.php');
        $daysResults = [];
        foreach ($days as $day) {
            [$dayName, $extension] = explode('.', $day->getFilename());
            $dayClassname = "App\\Day\\{$dayName}\\{$dayName}";
            $dayService = new $dayClassname;

            $dayService->configure();
            $firstPuzzleResult = $dayService->firstPuzzle();
            $secondPuzzleResult = $dayService->secondPuzzle();

            $daysResults[$dayName] = [
                'first_puzzle' => $firstPuzzleResult,
                'second_puzzle' => $secondPuzzleResult,
            ];
        }

        return $this->render('index/index.html.twig', [
            'days_results' => $daysResults,
        ]);
    }
}
