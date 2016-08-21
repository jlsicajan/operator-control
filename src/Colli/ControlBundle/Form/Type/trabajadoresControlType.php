<?php

namespace Colli\ControlBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class trabajadoresControlType extends BaseAbstractType {

  protected $options = array(
      'name' => 'trabajador_control',
  );

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('fecha', 'text', array("label" => "Fecha",
        "data" => date('d-m-Y'), "attr" => array("class" => "datepicker",
            "data-format" => "dd-mm-yyyy", "id" => "fecha"),
        "read_only" => false));
    $builder->add('trabajador', 'model', array("label" => "Trabajador",
        'class' => 'Colli\ControlBundle\Model\Trabajador',
        'property' => 'Nombre',
        'attr' => array("class" => "form-control", "id" => "trabajador")
    ));
    $builder->add('trabajo_realizado', 'textarea', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "trabajo_realizado",
            "placeholder" => "", "rows" => "4")
    ));
    $builder->add("ingresar", "submit", array(
        "label" => "Ingresar",
        "attr" => array("class" => "btn btn-primary confirm-toggle")
    ));
  }

}
