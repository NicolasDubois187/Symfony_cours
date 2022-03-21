<?php

namespace App\Form;

use App\Entity\Students;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'renseigner le champ correctement'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Prénom minimum {{ limit }} caractères',
                        'max' => 25,
                        'maxMessage' => 'Prénom maximum {{ limit }} caractères',

                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('age', IntegerType::class, [
                'label' => 'Age'
            ])
            ->add('phone', IntegerType::class, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('team', TextType::class, [
                'label' => 'Classe'
            ])
            ->add('firstQuarter', IntegerType::class, [
                'label' => 'Premier Trimestre'
            ])
            ->add('secondQuarter',  IntegerType::class, [
                'label' => 'Second Trimestre'
            ])
            ->add('lastQuarter',  IntegerType::class, [
                'label' => 'Troisième Trimestre'
            ])
            ->add('active', CheckboxType::class, [
                'label' => 'Inscrit'
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Students::class,
        ]);
    }
}
