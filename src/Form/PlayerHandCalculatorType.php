<?php

namespace App\Form;

use App\Dto\PlayerHandDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class PlayerHandCalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duoCards', LiveCollectionType::class, [
                'entry_type' => DuoCardType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('collectionCards', LiveCollectionType::class, [
                'entry_type' => CollectionCardType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('boostCards', LiveCollectionType::class, [
                'entry_type' => BoostCardType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('mermaidCards', LiveCollectionType::class, [
                'entry_type' => MermaidCardType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayerHandDto::class,
        ]);
    }
}
