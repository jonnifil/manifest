<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('main.html.twig');
    }

    /**
     * @Route("/mail", name="test_mail")
     */
    public function sendTestMail(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Test mail symfony'))
            ->setFrom('jonnifilatov@gmail.com')
            ->setTo('132-62@mail.ru')
            ->setBody('Test mail from symfony, Karl', 'text/html')
        ;
        $mailer->send($message);
        return $this->render('main.html.twig');
    }
}
