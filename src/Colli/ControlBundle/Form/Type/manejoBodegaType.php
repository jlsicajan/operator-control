<?php

namespace Colli\ControlBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class manejoBodegaType extends BaseAbstractType {

  protected $options = array(
      'name' => 'manejo_bodega',
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
    $builder->add('bodega', 'model', array("label" => "Bodega",
        'class' => 'Colli\ControlBundle\Model\Bodega',
        'property' => 'Descripcion',
        'placeholder' => 'Escoga de la bodega',
        'attr' => array('class' => 'form-control', 'id' => 'bodega')
    ));
    
    $builder->add('fecha_retiro', 'text', array("label" => "Fecha retiro",
        "data" => date('d-m-Y'), "attr" => array("class" => "datepicker",
            "data-format" => "dd-mm-yyy"),
        "read_only" => false,
        'attr' => array('class' => 'form-control', 'id', '=', 'fecha_retiro')));
    
    $builder->add('maquinaria', 'model', array("label" => "Maquinaria",
        'class' => 'Colli\ControlBundle\Model\Maquinaria',
        'property' => 'Descripcion',
        'placeholder' => 'Escoga la maquinaria',
        'attr' => array('class' => 'form-control', 'id', '=', 'maquinaria')
    ));
    
    $builder->add('fecha_ingreso', 'text', array("label" => "Fecha ingreso",
        "data" => date('d-m-Y'), "attr" => array("class" => "datepicker",
            "data-format" => "dd-mm-yyy"),
        "read_only" => false,
        'attr' => array('class' => 'form-control', 'id', '=', 'fecha_ingreso')));
    
    $builder->add('canton', 'model', array("label" => "Canton",
        'class' => 'Colli\ControlBundle\Model\Canton',
        'property' => 'Descripcion',
        'placeholder' => 'Escoga el canton',
        'attr' => array('class' => 'form-control', 'id', '=', 'canton')
    ));
    
    $builder->add('sector', 'model', array("label" => "Canton",
        'class' => 'Colli\ControlBundle\Model\Sector',
        'property' => 'Descripcion',
        'placeholder' => 'Escoga el sector',
        'attr' => array('class' => 'form-control', 'id', '=', 'sector')
    ));
    
    $builder->add("ingresar", "submit", array(
        "label" => "Ingresar",
        "attr" => array("class" => "btn btn-primary confirm-toggle")
    ));
  }

}
