<?php

namespace Colli\ControlBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class cantonType extends BaseAbstractType {

  protected $options = array(
      'name' => 'canton',
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
        "attr" => array("class" => "form-control", "id" => "regular1")
    ));
    $builder->add("ingresar", "submit", array(
        "label" => "Ingresar",
        "attr" => array("class" => "btn btn-primary confirm-toggle")
    ));
  }

}
