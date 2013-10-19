<?php

namespace Doc\IndexBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

//use Doctrine\ORM\EntityRepository;

class AccountType extends AbstractType {

    public $params;

    public function __construct($params = []) {
        $this->params = $params;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder->add('firstname', 'text', ['label' => 'Prénom : ', 'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom']]);
        $builder->add('lastname', 'text', ['label' => 'Nom : ', 'attr' => ['class' => 'form-control', 'placeholder' => 'Nom']]);
        $builder->add('tel', 'text', ['label' => 'Téléphone : ', 'required' => false, 'attr' => ['class' => 'form-control', 'placeholder' => 'Téléphone']]);
        $builder->add('cp', 'text', ['label' => 'Cp : ', 'required' => false, 'attr' => ['class' => 'form-control', 'placeholder' => 'Cp']]);
        $builder->add('city', 'text', ['label' => 'Ville : ', 'required' => false, 'attr' => ['class' => 'form-control', 'placeholder' => 'Ville']]);
        $builder->add('district', 'text', ['label' => 'Région : ', 'required' => false, 'attr' => ['class' => 'form-control', 'placeholder' => 'Région']]);
        $builder->add('country', 'text', ['label' => 'Pays : ', 'required' => false, 'attr' => ['class' => 'form-control', 'placeholder' => 'Pays']]);
        $builder->add('email', 'email', ['label' => 'Email : ', 'attr' => ['class' => 'form-control', 'placeholder' => 'Email']]);
        $builder->add('username', 'text', ['label' => 'Identifiant : ', 'attr' => ['class' => 'form-control', 'placeholder' => 'Identifiant']]);
        $builder->add('password', isset($this->params['password']['type']) ? $this->params['password']['type'] : 'password', ['label' => 'Mot de passe :', 'attr' => ['class' => 'form-control', 'placeholder' => 'Mot de passe']]);
    }

    public function getName() {
        return 'account';
    }

}

?>