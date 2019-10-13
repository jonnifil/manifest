<?php

namespace App\Form;

use App\Entity\Aff;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('level')
            ->add('work_day')
            ->add('flight')
            ->add('aff_client')
            ->add('aff_first')
            ->add('aff_second')
            ->add('aff_operator')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aff::class,
        ]);
    }
}
