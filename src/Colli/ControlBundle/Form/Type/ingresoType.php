<?php

namespace Colli\ControlBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ingresoType extends BaseAbstractType {

  protected $options = array(
      'name' => '',
  );

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('canton', 'model', array("label" => "Canton",
        'class' => 'Colli\ControlBundle\Model\Canton',
        'property' => 'Descripcion',
        'attr' => array('class' => 'form-control', 'id', '=', 'canton')
    ));

    $builder->add('sector', 'model', array("label" => "Canton",
        'class' => 'Colli\ControlBundle\Model\Sector',
        'property' => 'Descripcion',
        'placeholder' => 'Escoga el sector',
        'attr' => array('class' => 'form-control', 'id', '=', 'sector')
    ));

    $builder->add('cantidad_camionadas_sector', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "cantidad_camionadas_sector")
    ));

    $builder->add('precio_diesel_sector', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "precio_diesel_sector")
    ));

    $builder->add('galones_diesel_sector', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "galones_diesel_sector")
    ));

    $builder->add('dias_cantidad_sector', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "dias_cantidad_sector")
    ));

    $builder->add('horas_diarias_sector', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "horas_diarias_sector")
    ));

    $builder->add('horas_total_sector', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "horas_total_sector")
    ));

    $builder->add('grosor_balasto_sector', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "grosor_balasto_sector")
    ));

    $builder->add('reparacion_sector', 'checkbox', array(
        'required' => false,
        "attr" => array("class" => "form-control", "id" => "reparacion_sector")
    ));

    $builder->add('maquinaria', 'model', array("label" => "Maquinaria",
        'class' => 'Colli\ControlBundle\Model\Maquinaria',
        'property' => 'Descripcion',
        'placeholder' => 'Escoga la maquinaria',
        'attr' => array('class' => 'form-control', 'id', '=', 'maquinaria_id')
    ));

    $builder->add('bodega', 'model', array("label" => "Maquinaria",
        'class' => 'Colli\ControlBundle\Model\Bodega',
        'property' => 'id',
        'placeholder' => 'Escoga de bodega',
        'attr' => array('class' => 'form-control', 'id', '=', 'bodega_id')
    ));

    $builder->add('observaciones', 'text', array(
        'required' => false,
        "attr" => array("class" => "form-control", "id" => "observaciones")
    ));
    $builder->add("ingresar", "submit", array(
        "label" => "Ingresar",
        "attr" => array("class" => "btn btn-primary confirm-toggle")
    ));
  }

}
