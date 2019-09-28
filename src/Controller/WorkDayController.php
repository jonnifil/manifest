<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WorkDayController extends AbstractController
{
    /**
     * @Route("/work_day", name="work_day")
     */
    public function index()
    {

        return $this->render('work_day/index.html.twig', [
            'controller_name' => 'WorkDayController',
        ]);
    }
}
