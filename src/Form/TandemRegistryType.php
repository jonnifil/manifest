<?php

namespace App\Form;

use App\Entity\Flight;
use App\Entity\Member;
use App\Entity\Tandem;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TandemRegistryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('passenger', MemberForm::class)
            ->add('flight', EntityType::class, [
                'label' => 'Взлёт',
                'class' => Flight::class,
                'choices' => $options['flights_data']
            ])
            ->add('driver', EntityType::class, [
                'label' => 'Тандем мастер',
                'class' => Member::class,
                'choices' => $options['driver_data']
            ])
            ->add('operator', EntityType::class, [
                'label' => 'Оператор',
                'class' => Member::class,
                'choices' => $options['operator_data']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tandem::class,
        ]);
    }
}
