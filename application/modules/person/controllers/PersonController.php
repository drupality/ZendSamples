<?php

class Person_PersonController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        $this->view->form = $this->createPersonForm();
        return $this->view->render('person/index.phtml');

    }

    private function createPersonForm()
    {
        $form = new Zend_Form;
        $form->setMethod('post');

        $form->addElement('text', 'first_name', array(
          'label'      => 'First name:',
          'required'   => true,
          'filters'    => array('StringTrim'),
          'validators' => array(
            array('validator' => 'StringLength', 'options' => array(2, 50))
          )
        ));

        $form->addElement('text', 'last_name', array(
          'label'      => 'Last name:',
          'required'   => true,
          'filters'    => array('StringTrim'),
          'validators' => array(
            array('validator' => 'StringLength', 'options' => array(2, 50))
          )
        ));

        $form->addElement('password', 'pass', array(
          'label'      => 'Password:',
          'required'   => true,
          'filters'    => array('StringTrim'),
          'validators' => array(
            array('validator' => 'StringLength', 'options' => array(6))
          )
        ));

        $form->addElement('text', 'email', array(
          'label'      => 'Email address:',
          'required'   => true,
          'filters'    => array('StringTrim'),
          'validators' => array(
            'EmailAddress',
          )
        ));

        $form->addElement('submit', 'submit', array(
          'ignore'   => true,
          'label'    => 'Save',
        ));





        return $form;
    }


}

