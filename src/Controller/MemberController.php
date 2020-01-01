<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @param Request $request
     * @param int|null $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/member/{id}", name="member")
     */
    public function add(Request $request, int $id=null)
    {
        if (isset($id)) {
            $repository = $this->getDoctrine()->getRepository(Member::class);
            $member = $repository->find($id);
        } else {
            $member = new Member();
        }

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $company = $this->getUser()->getCompany();

        $form = $this->createForm(MemberForm::class, $member);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $member = $form->getData();
            $member->setCompany($company);

            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();
            $this->redirect('/member/' . $member->getId());
        }

        return $this->render('member/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
