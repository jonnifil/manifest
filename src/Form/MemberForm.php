<?php
/**
 * Created by PhpStorm.
 * User: jonni
 * Date: 28.09.19
 * Time: 21:52
 */

namespace App\Form;


use App\Entity\Member;
use App\Entity\Role;
use App\Repository\RoleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberForm extends AbstractType
{
    const CATEGORY_LIST = [
        'Без категории' => '',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
        'E' => 'E',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', TextType::class, ['label' => 'Фамилия'])
            ->add('name', TextType::class, ['label' => 'Имя'])
            ->add('middle_name', TextType::class, ['label' => 'Отчество'])
            ->add('category', ChoiceType::class, ['label' => 'Катергория', 'choices' =>self::CATEGORY_LIST])
            ->add('roles', EntityType::class, ['label' => 'Доступные роли',
                'multiple' => true,
                'expanded' => true,
                'class' => Role::class,
                'choice_label' => 'displayName',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Member::class,
        ));
    }
}