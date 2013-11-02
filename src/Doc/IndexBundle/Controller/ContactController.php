<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Doc\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doc\IndexBundle\Form\Type\ContactType;
use Doc\IndexBundle\Entity\Contact;
use Doc\IndexBundle\Models\Cache;

class ContactController extends Controller {

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
    public function showAction() {
        $cache = new Cache();
        $cacheId = 'contact_show';
        if($cache->getDriver()->contains($cacheId)){
            $contacts = $cache->getDriver()->fetch($cacheId);  
        }else{
            $em = $this->getDoctrine()->getManager();
            $contacts = $em->getRepository('DocIndexBundle:Contact')->findBy(['accountId' => $this->getUser()->getId()], ['lastname' => 'desc']);
            $cache->getDriver()->save($cacheId, $contacts);  
        }
       
       
        return ['contacts' => $contacts];
    }

    /**
     * 
     * @Template()
     */
    public function formAction($contact_id = null) {

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        # Formulaire
        if ($contact_id != null)
            $contact = $em->getRepository('DocIndexBundle:Contact')->find($contact_id);
        else
            $contact = new Contact();

        $form = $this->createForm(new ContactType(), $contact);
        if ($request->getMethod() == "POST") {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $contact->setAccountId($this->getUser());
                $contact->setDateCreated(new \DateTime('now'));
                $contact->setDateLastUpdated(new \DateTime('now'));
                $em->persist($contact);
                $em->flush();
                return $this->forward('DocIndexBundle:Contact:Show');
            }
            return new JsonResponse(false);
        }

        return ['form' => $form->createView(), 'contact_id' => $contact_id];
    }

    public function delAction($contact_id) {
        $contact_id = (int) $contact_id;
        if ($contact_id > 0) {
            $this->getDoctrine()->getManager()->getConnection()->delete('contact', ['contact_id' => (int) $contact_id]);
            return $this->forward('DocIndexBundle:Contact:Show');
        } else
            return new JsonResponse(false);
        
       
    }

}

