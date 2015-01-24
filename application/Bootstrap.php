<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
  public function _initRoutes()
  {
    $frontController = Zend_Controller_Front::getInstance();
    $route = new Zend_Controller_Router_Route(
      'result/', // The URL, after the baseUrl, with no params.
      array(
        'controller' => 'person', // The controller to point to.
        'action'     => 'result',  // The action to point to, in said Controller.
        'module' => 'person',
      )
    );
    $frontController->getRouter()->addRoute('success', $route);
  }
}

