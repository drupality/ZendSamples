<?php

class Person_PersonController extends Zend_Controller_Action
{
    private $flash;

    public function init()
    {
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $form = $this->createPersonForm();

        if ($request->isPost()) {

            $this->flash = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');



            if ($form->isValid($_POST)) {

                $this->flash->addMessage(array('success' => 'Success'));

            } else {

                $this->flash->addMessage(array('error' => 'Error'));

            }
        }


        $this->view->form = $form;


        return $this->view->render('person/index.phtml');

    }

    public function postDispatch()
    {
        if (! isset($this->flash) || ! $this->flash->hasCurrentMessages()) {
            return;
        }

        $messages = array();

        foreach($this->flash->getMessages() as $message) {
            $type = key($message);
            $messages[$type] = $message[$type];
        }

        $this->view->messages = $messages;

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

