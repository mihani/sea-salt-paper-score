<?php

namespace App\Form;

use App\Config\DuoCard;
use App\Dto\Cards\DuoCardDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DuoCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', EnumType::class, [
                'class' => DuoCard::class,
                'choice_label' => function (DuoCard $choice) {
                    return $choice->translationKey();
                },
            ])
            ->add('quantity', IntegerType::class, [
                'empty_data' => 0
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DuoCardDto::class,
        ]);
    }
}
