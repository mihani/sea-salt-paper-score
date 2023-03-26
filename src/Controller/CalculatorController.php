<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/calculator')]
class CalculatorController extends AbstractController
{
    #[Route(path: '/calculate', name: 'app_calculator_calculate')]
    public function index()
    {
        return $this->render('main.html.twig');
    }
}
