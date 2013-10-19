<?php

namespace Doc\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doc\IndexBundle\Form\Type\AccountType;
use Doc\IndexBundle\Entity\Account;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;
class LoginController extends Controller
{
    /**
     * 
     * @Template()
     */
    public function loginAction()
    {
        
        $request = $this->getRequest();
        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
             die($error);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        $form = $this->createForm(new AccountType(),new Account());
       
        return array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
            'form' => $form->createView()
        );
        
      
    }
    public function logincheckAction(){
        return [];
    }
    public function logoutAction(){
        
    }
    public function inscriptionAction(){
        
        $request = $this->getRequest();
        $account =  new Account();
        $form = $this->createForm(new AccountType(),$account);
        if ($request->getMethod() == "POST") {

            $form->handleRequest($request);
             if($form->isValid())
              { 
            $em = $this->getDoctrine()->getManager();
           
            $account->setDateCreated(new \DateTime());
            $account->setDateLastUpdated(new \DateTime());
            $account->setIsActive(1);
            $account->setIp($_SERVER['SERVER_ADDR']);
            // On cré un salt pour amélioré la sécurité
            $account->setSalt(md5(time()));

            // On crée un mot de passe (attention, comme vous pouvez le voir, il faut utiliser les même paramètres
            // que spécifiés dans le fichier security.ym, a sacoir SHA512 avec 10 itérations.        
            $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
            // On cré donc le mot de passe "admin2" à partir de l'encodage choisi au-dessus
            $password = $encoder->encodePassword($account->getPassword(), $account->getSalt());
            // On applique le mot de passe à l'utilisateur
            $account->setPassword($password);
            
         
            $em->persist($account);
            $em->flush();
            
             // Création d'un nouveau token basé sur l'utilisateur qui vient de s'inscrire
              $token = new UsernamePasswordToken($account, $account->getPassword(), 'secured_area', $account->getRoles());
              // On passe le token créé au service security context afin que l'utilisateur soit authentifié
              $this->get('security.context')->setToken($token);
          
              $session = $this->getRequest()->getSession(); 
              //print_r($token); die();
              $session->set('_security_secured_area', serialize($token));
           	
            return $this->redirect($this->generateUrl('_account_home'));
            
            }
        }

       
    }
}
