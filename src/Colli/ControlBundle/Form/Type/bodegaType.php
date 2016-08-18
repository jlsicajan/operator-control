<?php

namespace Colli\ControlBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class bodegaType extends BaseAbstractType {

  protected $options = array(
      'name' => 'bodega',
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
    $builder->add('equipo', 'model', array("label" => "Equipo",
        'class' => 'Colli\ControlBundle\Model\Equipo',
        'property' => 'Descripcion',
        'placeholder' => 'Escoga el equipo',
        'attr' => array('class' => 'form-control', 'id', '=', 'equipo')
    ));
    
    $builder->add('cantidad', 'text', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "cantidad")
    ));
    
    $builder->add('precio', 'text', array(
        'required' => false,
        "attr" => array("class" => "form-control", "id" => "precio")
    ));
    
    $builder->add('estado', 'choice', array(
        'label' => 'Estado',
        'choices' => array("Nuevo" => 'Nuevo', "Usado" => 'Usado'),
        'attr' => array("id" => "estado", "class=" => "btn btn-default dropdown-toggle", "tabindex" => "-1", "data-toggle" => "dropdown"),
    ));
    
    $builder->add('maquinaria', 'model', array("label" => "Maquinaria",
        'class' => 'Colli\ControlBundle\Model\Maquinaria',
        'property' => 'Descripcion',
        'required' => false,
        'placeholder' => 'Escoga la maquinaria',
        'attr' => array('class' => 'form-control', 'id', '=', 'maquinaria')
    ));
    
    $builder->add("ingresar", "submit", array(
        "label" => "Ingresar",
        "attr" => array("class" => "btn btn-primary confirm-toggle")
    ));
  }

}
