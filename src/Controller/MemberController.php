<?php

namespace App\Controller;

use App\Entity\Member;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/member/{id}", name="member")
     */
    public function index($id=null)
    {
        if (isset($id)) {
            $repository = $this->getDoctrine()->getRepository(Member::class);
            $member = $repository->find($id);
        } else {
            $member = new Member();
        }

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $company = $this->getUser()->getCompany();
        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }
}
