<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Doc\IndexBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LetterType extends AbstractType{
    
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('receiverId','entity',[
            'class' => 'DocIndexBundle:Contact',
        ]);
        $builder->add('object','text');
        $builder->add('text','textarea');
       
    }
     public function getName() {
        return 'letter';
    }  
}
