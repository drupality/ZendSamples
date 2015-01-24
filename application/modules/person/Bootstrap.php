<?php

class Person_Bootstrap extends Zend_Application_Module_Bootstrap
{
  protected function _initAutoload()
  {

    $autoloader = new Zend_Application_Module_Autoloader(array(
      'basePath' => APPLICATION_PATH.'/modules/person/',
      'namespace' => '',
      'resourceTypes' => array(
        'model' => array(
          'path' => 'models/',
          'namespace' => 'Person_'
        )
      ),
    ));
    return $autoloader;


//      array(
//        'basePath' => APPLICATION_PATH . '/modules/person',
//        'namespace' => 'Person_',
//        'resourceTypes' => array( 'model' => array( 'path'=>'models/', 'namespace'=>'Person_' ))
//      )
//
//
//    $autoLoader = Zend_Loader_Autoloader::getInstance();
//
//    $autoLoader->setAutoloaders()

  }



}

