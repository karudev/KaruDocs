<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Doc\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doc\IndexBundle\Entity\Letter;
use Doc\IndexBundle\Form\Type\LetterType;
use Symfony\Component\HttpFoundation\JsonResponse;

class LetterController extends Controller {

    /**
     * 
     * @Template()
     */
    public function indexAction() {
        return [];
    }

    /**
     * 
     * @Template()
     */
    public function formAction($letter_id = null) {
        $request = $this->getRequest();
        $letter = new Letter();
        if ($letter_id == null) {
            $letter = new Letter();
        } else {
            $letter = $this->getDoctrine()->getRepository('DocIndexBundle:Letter')->find($letter_id);
        }
        $form = $this->createForm(new LetterType(), $letter);
        if ($request->getMethod() == "POST") {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $letter->setDateCreated(new \DateTime('now'));
                $letter->setDateLastUpdated(new \DateTime('now'));
                $letter->setAccountId($this->getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($letter);
                $em->flush();
                 return $this->forward('DocIndexBundle:Letter:Show');
            } else {
                return new JsonResponse(false);
            }
        }
        return ['form' => $form->createView()];
    }

    /**
     * 
     * @Template()
     */
    public function showAction() {

        $em = $this->getDoctrine()->getManager();
        $letters = $em->getRepository('DocIndexBundle:Letter')->findBy(['accountId' => $this->getUser()->getId()]);
        return ['letters' => $letters];
    }

    public function delAction($letter_id) {
        $letter_id = (int) $letter_id;
        if ($letter_id > 0) {
            $this->getDoctrine()->getManager()->getConnection()->delete('letter', ['letter_id' => $letter_id]);
            return $this->forward('DocIndexBundle:Letter:Show');
        } else
            return new JsonResponse(false);
    }

}

