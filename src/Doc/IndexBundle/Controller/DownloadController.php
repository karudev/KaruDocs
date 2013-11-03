<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Doc\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doc\IndexBundle\Entity\Letter;
require_once(__DIR__.'/../Models/html2pdf/html2pdf.class.php');


class DownloadController extends Controller {

   public function letterAction(Letter $letter) {
    
      
     
       $html = $this->get('templating')->render('DocIndexBundle:Download:Letter.html.twig',['letter' => $letter]);
       
        try {
            $html2pdf = new \HTML2PDF('P', 'A4', 'fr',true,'UTF-8',[20,20,20,20]);
            $html2pdf->writeHTML($html);
            $html2pdf->Output($letter->getObject().'.pdf');
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
        die();
      
    }
}

