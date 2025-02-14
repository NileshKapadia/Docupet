<?php

namespace App\Form;

use App\Entity\Pet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => "What is Pet's Name",
            'attr' => ['class' => 'form-control mb-3'],
        ])
        ->add('type', ChoiceType::class, [
            'choices' => [
                'Select a pet type' => 'Select a pet type',
                'Cat' => 'Cat',
                'Dog' => 'Dog',
            ],
            'attr' => ['class' => 'form-select mb-3'],
        ])
        ->add('breed', ChoiceType::class, [
            'choices' => [
                'Select a pet type first' => 'Select a pet type first',
            ],
            'label' => "What breed are they?", 
            'attr' => ['class' => 'form-control mb-3'],
        ])
        ->add('dateOfBirth', DateType::class, [
            'widget' => 'single_text',
            'required' => false,
            'attr' => ['class' => 'form-control mb-3'],
        ])
        ->add('gender', ChoiceType::class, [
            'choices' => [
                'Male' => 'Male',
                'Female' => 'Female',
            ],
            'attr' => ['class' => 'form-select mb-3'],
        ])
        ->add('isDangerous', ChoiceType::class, [
            'choices' => [
                'Yes' => true,
                'No' => false,
            ],
            'attr' => ['class' => 'form-select mb-3'],
        ])
        ->add('approximateAge', IntegerType::class, [
            'required' => false,
            'attr' => ['placeholder' => 'Enter age in years']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pet::class,
        ]);
    }
}
