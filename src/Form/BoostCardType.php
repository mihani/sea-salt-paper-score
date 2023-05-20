<?php

namespace App\Form;

use App\Config\BoostCard;
use App\Dto\Cards\BoostCardDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoostCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', EnumType::class, [
                'class' => BoostCard::class,
                'choice_label' => function (BoostCard $choice) {
                    return $choice->translationKey();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BoostCardDto::class,
        ]);
    }
}
