<?php
/**
 * Created by PhpStorm.
 * User: jonni
 * Date: 28.09.19
 * Time: 21:52
 */

namespace App\Form;


use App\Entity\Member;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberForm extends AbstractType
{
    const CATEGORY_LIST = [
        '' => 'Без категории',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
        'E' => 'E',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', StringType::class, ['label' => 'Фамилия'])
            ->add('name', StringType::class, ['label' => 'Имя'])
            ->add('middle_name', StringType::class, ['label' => 'Отчество'])
            ->add('category', ChoiceType::class, ['label' => 'Катергория', 'choices' =>self::CATEGORY_LIST])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Member::class,
        ));
    }
}