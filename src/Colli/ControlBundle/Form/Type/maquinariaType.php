<?php

namespace Colli\ControlBundle\Form\Type;

use Colli\ControlBundle\Model\MaquinariaQuery;
use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class maquinariaType extends BaseAbstractType {

  protected $options = array(
      'name' => 'maquinaria',
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
    $builder->add('numero', 'number', array(
        'required' => true,
        "attr" => array("class" => "form-control", "id" => "numero")
    ));
    
    $builder->add("ingresar", "submit", array(
        "label" => "Ingresar",
        "attr" => array("class" => "btn btn-primary confirm-toggle")
    ));
  }
   

}
