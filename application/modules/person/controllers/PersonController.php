<?php

class Person_PersonController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $form = $this->createPersonForm();

        if ($request->isPost()) {

            if ($form->isValid($_POST)) {

                $smtp_config = new Zend_Config_Ini(__DIR__ . '/../../../configs/smtp.ini', 'smtp');

                $config = array(
                  'ssl' => $smtp_config->ssl,
                  'port' => $smtp_config->port,
                  'auth' => $smtp_config->auth,
                  'username' => $smtp_config->username,
                  'password' => $smtp_config->password
                );

                $transport = new Zend_Mail_Transport_Smtp($smtp_config->host, $config);

                Zend_Mail::setDefaultTransport($transport);

                $mail = new Zend_Mail();
                $mail->setBodyText('Email body here.');
                $mail->setFrom('zendsamples@email.com', 'drupality');
                $mail->addTo($form->getValue('email'), $form->getValue('first_name'));
                $mail->setSubject('Hello World!');
                $mail->send();

                $this->setFlashMessage('Email has been sent', 'success');

                $person = new Person_Model_Person($form->getValues());
                $mapper = new Person_Model_PersonMapper();

                if ($mapper->save($person)) {
                  $this->setFlashMessage('Person object has been saved', 'success');
                } else {
                  $this->setFlashMessage('Person object save error', 'error');
                }

                $this->redirect('result');

            } else {

                $this->view->messages = array('error' => array('Form validation error'));

            }
        }


        $this->view->form = $form;


        return $this->view->render('person/index.phtml');

    }

    public function resultAction()
    {
    }

    public function postDispatch()
    {



        if (! $this->flashMessengerNotEmpty()) {
            return;
        }

        $flash = $this->getFlashMessenger();


        $messages['success'] = $flash->getMessages('success');
        $messages['error'] = $flash->getMessages('error');

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
          ),
        ));

        $form->addElement('password', 'pass', array(
          'label'      => 'Password:',
          'required'   => true,
          'filters'    => array('StringTrim'),
          'validators' => array(
            array('validator' => 'StringLength', 'options' => array(4))
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

        $form->setDefaults(array('first_name' => 'John', 'last_name' => 'Doe'));



        return $form;
    }

    private function setFlashMessage($message, $namespace) {
      $flash = $this->getFlashMessenger();
      $flash->setNamespace($namespace);
      $flash->addMessage($message, $namespace);
    }

    private function flashMessengerNotEmpty() {
      $flash = $this->getFlashMessenger();
      return $flash->hasMessages('success') || $flash->hasMessages('error');
    }

    private function getFlashMessenger() {
      static $flash = null;

      if (is_null($flash)) {
        $flash = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
      }

      return $flash;

    }


}



