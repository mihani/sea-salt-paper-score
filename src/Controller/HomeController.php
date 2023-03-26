<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/')]
class HomeController extends AbstractController
{
    #[Route(name: 'app_index')]
    public function index()
    {
        return $this->redirectToRoute('app_calculator_calculate');
    }
}
