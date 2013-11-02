<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Doc\IndexBundle\Form\Type;
use Symfony\Component\Form\FormBuilderInterface;
class ContactType extends \Symfony\Component\Form\AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
       $builder->add('firstname','text',['required' => false]);
       $builder->add('lastname','text',['required' => false]);
       $builder->add('phone','text',['required' => false]);
       $builder->add('fixe','text',['required' => false]);
       $builder->add('email','email',['required' => false]);
       $builder->add('website','url',['required' => false]);
       $builder->add('organisationName','text',['required' => false]);
       $builder->add('address','text',['required' => false]);
       $builder->add('cp','text',['required' => false]);
       $builder->add('city','text',['required' => false]);
       $builder->add('district','text',['required' => false]);
       $builder->add('country','text',['required' => false]);
    }
    public function getName() {
        return 'contact';
    }   
}

