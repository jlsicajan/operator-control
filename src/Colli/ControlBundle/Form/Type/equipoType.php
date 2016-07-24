<?php

namespace Colli\ControlBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class equipoType extends BaseAbstractType {

  protected $options = array(
      'name' => 'equipo',
  );

  public function buildForm(FormBuilderInterface $builder, array $options) {

    $builder->add('descripcion', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "descripcion")
    ));

    $builder->add("ingresar", "submit", array(
        "label" => "Ingresar",
        "attr" => array("class" => "btn btn-primary confirm-toggle")
    ));
  }

}
