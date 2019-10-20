<?php

namespace App\Controller;

use App\Entity\Aff;
use App\Entity\Flight;
use App\Entity\Member;
use App\Entity\Role;
use App\Entity\Tandem;
use App\Entity\WorkDay;
use App\Form\AffType;
use App\Form\MemberForm;
use App\Form\TandemRegistryType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WorkDayController extends AbstractController
{
    /**
     * @Route("/work_day/{create}", name="work_day")
     */
    public function index($create = null)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $company = $this->getUser()->getCompany();

        $repository = $this->getDoctrine()->getRepository(WorkDay::class);
        $currentWorkDay = $repository->findCurrent($company);
        if (!isset($currentWorkDay)) {
            if ($create) {
                $currentWorkDay = new WorkDay();
                $currentWorkDay
                    ->setCompany($company)
                    ->setDay(new \DateTime());

                $flight = new Flight();
                $flight
                    ->setWorkDay($currentWorkDay)
                    ->setNumber(1)
                    ->setType(1)
                    ->setStatus(1)
                    ->setStartTime(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($currentWorkDay);
                $em->persist($flight);
                $em->flush();

            } else return $this->render('work_day/empty.html.twig');
        }

        return $this->render('work_day/index.html.twig', [
            'date' => $currentWorkDay->getDay()->format('d.m.Y'),
            'flights' => $currentWorkDay->getFlights()
        ]);
    }

    /**
     * @Route("/tandem_registry/{id}", name="tandem_registry")
     */
    public function tandemRegistry(Request $request, int $id=null)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $company = $this->getUser()->getCompany();

        $repository = $this->getDoctrine()->getRepository(WorkDay::class);
        $currentWorkDay = $repository->findCurrent($company);
        if (!isset($currentWorkDay)) {
            return $this->redirectToRoute('work_day');
        }

        $memberRepository = $this->getDoctrine()->getRepository(Member::class);
        $roleRepository = $this->getDoctrine()->getRepository(Role::class);
        $tandemRepository = $this->getDoctrine()->getRepository(Tandem::class);
        $options = [
            'flights_data' => $currentWorkDay->getFlights(),
            'driver_data' => $memberRepository->findByRoles($company, $currentWorkDay, [Role::TANDEM_MASTER]),
            'operator_data' => $memberRepository->findByRoles($company, $currentWorkDay, [Role::OPERATOR])
        ];

        if (isset($id)) {
            $tandem = $tandemRepository->find($id);
        } else
            $tandem = new Tandem();
        $form = $this->createFormBuilder($tandem)
            ->add('passenger', MemberForm::class)
            ->add('flight', EntityType::class, [
                'label' => 'Взлёт',
                'class' => Flight::class,
                'choices' => $options['flights_data'],
                'choice_label' => 'displayName',
                'required'   => false,
                'placeholder' => 'Не выбран'
            ])
            ->add('driver', EntityType::class, [
                'label' => 'Тандем мастер',
                'class' => Member::class,
                'choices' => $options['driver_data'],
                'choice_label' => 'displayName',
                'required'   => false,
                'placeholder' => 'Не выбран'
            ])
            ->add('operator', EntityType::class, [
                'label' => 'Оператор',
                'class' => Member::class,
                'choices' => $options['operator_data'],
                'choice_label' => 'displayName',
                'required'   => false,
                'placeholder' => 'Не выбран'
            ])
            ->getForm()
        ;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tandem = $form->getData();
            $tandem->setWorkDay($currentWorkDay);
            $tandem->getPassenger()->setCompany($company);
            $tandem->getPassenger()->setRoles([$roleRepository->find(Role::TANDEM_CLIENT)]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tandem);
            $em->flush();
            return $this->redirectToRoute('/tandem_registry/' . $tandem->id);
        }

        return $this->render('work_day/tandem_registry.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/worker_registry", name="worker_registry")
     */
    public function workerRegistry(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $company = $this->getUser()->getCompany();

        $repository = $this->getDoctrine()->getRepository(WorkDay::class);
        $currentWorkDay = $repository->findCurrent($company);
        if (!isset($currentWorkDay)) {
            return $this->redirectToRoute('work_day');
        }
        $memberRepository = $this->getDoctrine()->getRepository(Member::class);
        $form = $this->createFormBuilder($currentWorkDay)
            ->add('members', EntityType::class, ['label' => 'Присутствующие инструктора',
                'multiple' => true,
                'expanded' => true,
                'class' => Member::class,
                'choices' => $memberRepository->findByRoles($company, null, Role::WORKERS),
                'choice_label' => 'displayName',])
            ->getForm()
            ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $currentWorkDay = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($currentWorkDay);
            $em->flush();
            return $this->redirectToRoute('work_day');
        }

        return $this->render('work_day/worker_registry.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/aff_registry", name="aff_registry")
     */
    public function affRegistry(Request $request)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $company = $this->getUser()->getCompany();

        $repository = $this->getDoctrine()->getRepository(WorkDay::class);
        $currentWorkDay = $repository->findCurrent($company);
        if (!isset($currentWorkDay)) {
            return $this->redirectToRoute('work_day');
        }
        $form = $this->createForm(AffType::class);
        $aff = new Aff();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $aff = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($aff);
            $em->flush();
            return $this->redirectToRoute('work_day');
        }

        return $this->render('work_day/aff_registry.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
