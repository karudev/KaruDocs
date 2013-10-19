<?php

namespace Doc\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doc\IndexBundle\Form\Type\AccountType;
use Doc\IndexBundle\Entity\Account;

class ProfilController extends Controller {

    /**
     * 
     * @Template()
     */
    public function indexAction() {
        $request = $this->getRequest();
        $account = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new AccountType(['password' => ['type' => 'text']]), $account);
        if ($request->getMethod() == "POST") {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($account);
                $em->flush();
            }
        }
        return ['form' => $form->createView()];
    }

}
