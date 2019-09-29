<?php

namespace App\Controller;

use App\Entity\WorkDay;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
                $currentWorkDay->setCompany($company);
                $currentWorkDay->setDay(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($currentWorkDay);
                $em->flush();

            } else return $this->render('work_day/empty.html.twig');
        }

        return $this->render('work_day/index.html.twig', [
            'date' => $currentWorkDay->getDay()->format('d.m.Y'),
        ]);
    }
}
