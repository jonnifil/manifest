<?php

namespace App\Form;

use App\Entity\Aff;
use App\Entity\Flight;
use App\Entity\Member;
use App\Entity\Role;
use App\Repository\MemberRepository;
use App\Repository\WorkDayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AffType extends AbstractType
{

    private $m_repository;
    private $wd_repository;
    private $token;

    public function __construct(WorkDayRepository $wd_repository, MemberRepository $m_repository, TokenStorageInterface $tokenStorage)
    {
        $this->m_repository = $m_repository;
        $this->wd_repository = $wd_repository;
        $this->token = $tokenStorage->getToken();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!$this->token || !$this->m_repository || !$this->wd_repository)
            return;
        $user = $this->token->getUser();
        if (!is_object($user))
            return;
        $company = $user->getCompany();
        $currentWorkDay = $this->wd_repository->findCurrent($company);
        $clientData = $this->m_repository->findByRoles($company, $currentWorkDay, [Role::AFF_CLIENT]);
        $firstData = $this->m_repository->findByRoles($company, $currentWorkDay, [Role::AFF_FIRST]);
        $secondData = $this->m_repository->findByRoles($company, $currentWorkDay, [Role::AFF_FIRST, Role::AFF_SECOND]);
        $operatorData = $this->m_repository->findByRoles($company, $currentWorkDay, [Role::OPERATOR]);
        $levelData = [
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
        ];
        $builder
            ->add('level', ChoiceType::class, [
                'label' => 'Уровень',
                'choices' => $levelData,
                'placeholder' => 'Выберите уровень'
            ])
            ->add('flight', EntityType::class, [
                'label' => 'Взлёт',
                'class' => Flight::class,
                'choices' => $currentWorkDay->getFlights(),
                'choice_label' => 'displayName',
                'required'   => false,
                'placeholder' => 'Не выбран'
            ])
            ->add('aff_client', EntityType::class, [
                'label' => 'Студент',
                'class' => Member::class,
                'choices' => $clientData,
                'choice_label' => 'displayName',
                'placeholder' => 'Не выбран'
            ])
            ->add('aff_first', EntityType::class, [
                'label' => 'Основной инструктор',
                'class' => Member::class,
                'choices' => $firstData,
                'choice_label' => 'displayName',
                'required'   => false,
                'placeholder' => 'Не выбран'
            ])
            ->add('aff_second', EntityType::class, [
                'label' => 'Резервный инструктор',
                'class' => Member::class,
                'choices' => $secondData,
                'choice_label' => 'displayName',
                'required'   => false,
                'placeholder' => 'Не выбран'
            ])
            ->add('aff_operator', EntityType::class, [
                'label' => 'Оператор',
                'class' => Member::class,
                'choices' => $operatorData,
                'choice_label' => 'displayName',
                'required'   => false,
                'placeholder' => 'Не выбран'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aff::class,
        ]);
    }
}
