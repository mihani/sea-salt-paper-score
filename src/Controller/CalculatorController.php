<?php

declare(strict_types=1);

namespace App\Controller;

use App\Calculator\PointCalculatorMediator;
use App\Dto\PlayerHandDto;
use App\Form\PlayerHandCalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/calculator')]
class CalculatorController extends AbstractController
{
    #[Route(path: '/calculate', name: 'app_calculator_calculate')]
    public function calculate(Request $request, PointCalculatorMediator $mediator): Response
    {
        $playerHandDto = new PlayerHandDto();

        $form = $this->createForm(PlayerHandCalculatorType::class, $playerHandDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calculatorResult = $mediator->getPoints($playerHandDto);

            $this->addFlash('success', sprintf('Tu as %s points', $calculatorResult->getPoints()));

            $playerHandDto = new PlayerHandDto();

            $form = $this->createForm(PlayerHandCalculatorType::class, $playerHandDto);
            $form->handleRequest($request);
        }

        return $this->render('calculator/calculate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
