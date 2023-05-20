<?php

declare(strict_types=1);

namespace App\Twig;

use App\Dto\PlayerHandDto;
use App\Form\PlayerHandCalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent(name: 'player_hand_calculator_form', template: 'calculator/components/player-hand-calculator.html.twig')]
class PlayerHandCalculatorFormComponent extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    #[LiveProp(fieldName: 'formData')]
    public ?PlayerHandDto $playerHandDto = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(
            PlayerHandCalculatorType::class,
            $this->playerHandDto
        );
    }
}
