<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'website' => 'Wild Series',
            'categories' => $categories,
        ]);
    }

    #[Route('/category/{categoryName}', methods: ['GET'], name: 'category_show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category named ' . $categoryName . ' found in database'
            );
        }

        $filteredPrograms = $programRepository->findBy(['category' => $category]);

        return $this->render('category/show.html.twig', [
            'website' => 'Wild Series',
            'category' => $category,
            'programs' => $filteredPrograms,
        ]);        
    }
}