<?php

namespace App\Controller;

use App\Entity\Flight;
use App\Entity\Member;
use App\Entity\Role;
use App\Entity\Tandem;
use App\Entity\WorkDay;
use App\Form\TandemRegistryType;
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
     * @Route("/tandem_registry", name="tandem_registry")
     */
    public function tandemRegistry(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $company = $this->getUser()->getCompany();

        $repository = $this->getDoctrine()->getRepository(WorkDay::class);
        $currentWorkDay = $repository->findCurrent($company);
//        if (!isset($currentWorkDay)) {
////            $this->redirectToRoute('work_day');
//        }

        $memberRepository = $this->getDoctrine()->getRepository(Member::class);
        $options = [
            'flights_data' => $currentWorkDay->getFlights(),
            'driver_data' => $memberRepository->findByRoles($company, $currentWorkDay, [Role::TANDEM_MASTER]),
            'operator_data' => $memberRepository->findByRoles($company, $currentWorkDay, [Role::OPERATOR])
        ];

        $tandem = new Tandem();
        $form = $this->createForm(TandemRegistryType::class, $tandem, $options);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tandem = $form->getData();
            $tandem->setWorkDay($currentWorkDay);
            $tandem->getPassenger()->setCompany($company);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tandem);
            $em->flush();
        }

        $this->render('work_day/tandem_registry', [
            'form' => $form->createView()
        ]);
    }
}
