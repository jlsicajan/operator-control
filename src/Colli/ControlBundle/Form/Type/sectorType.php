<?php

namespace Colli\ControlBundle\Form\Type;

use Colli\ControlBundle\Model\CantonQuery;
use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class sectorType extends BaseAbstractType {

  protected $options = array(
      'name' => 'sector',
  );

  public function buildForm(FormBuilderInterface $builder, array $options) {
//    $builder->add('fi', 'text', array("label" => "Fecha Inicial", 
//        "data" => date('Y-m-d'), "attr" => array("class" => "datepicker", 
//            "data-format" => "yyyy-mm-dd"),
//        "read_only" => true));
//    $builder->add('descripcion', 'text', array("label" => "Fecha Inicial", 
//        "data" => date('Y-m-d'), "attr" => array("class" => "datepicker", 
//            "data-format" => "yyyy-mm-dd"),
//        "read_only" => true));
//    $builder->add('mm', 'model', array("label" => "Moneda",
//        'class' => 'Velfasa\SoporteBundle\Model\Moneda',
//        'property' => 'descripcion',
//        'query' => MonedaQuery::create()->orderByDescripcion(),
//        'attr' => array('class' => 'form-control')
//    ));
//    $builder->add('ap', 'model', array("label" => "Pagador",
//        'class' => 'Velfasa\SoporteBundle\Model\Compania',
//        'property' => 'descripcion',
//        'query' => CompaniaQuery::create()
//                ->orderByDescripcion()
//                ->usePerfilCompaniaQuery()
//                ->filterByTipo("pagador")
//                ->endUse(),
//        'attr' => array('class' => 'form-control')
//    ));
    $builder->add('descripcion', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "descripcion")
    ));
    $builder->add('ancho', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "ancho")
    ));
    $builder->add('unidad_ancho', 'choice', array(
        'label' => 'Seleccione la unidad de medida',
        'choices' => array("Metros" => 'Metros', "Kilometros" => 'Kilometros', "Pies" => 'Pies'),
        'attr' => array("class=" => "btn btn-default dropdown-toggle", "tabindex" => "-1", "data-toggle" => "dropdown"),
    ));
    $builder->add('largo', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "largo")
    ));
    $builder->add('unidad_largo', 'choice', array(
        'label' => 'Seleccione la unidad de medida',
        'choices' => array("Metros" => 'Metros', "Kilometros" => 'Kilometros', "Pies" => 'Pies'),
        'attr' => array(),
    ));
    $builder->add('canton', 'model', array("label" => "Canton",
        'class' => 'Colli\ControlBundle\Model\Canton',
        'property' => 'Descripcion',
        'attr' => array('class' => 'form-control')
    ));
    $builder->add("ingresar", "submit", array(
        "label" => "Ingresar",
        "attr" => array("class" => "btn btn-primary confirm-toggle")
    ));
  }
   

}
