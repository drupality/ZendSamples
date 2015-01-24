<?php

class Person_Model_Person
{

  public function __construct($values = array()) {
    if ($values) {
      $this->first_name = $values['first_name'];
      $this->last_name = $values['last_name'];
      $this->email = $values['email'];
      $this->password = $values['pass'];
    }
  }

  /**
   * @return mixed
   */
  public function getFirstName() {
    return $this->first_name;
  }

  /**
   * @param mixed $first_name
   */
  public function setFirstName($first_name) {
    $this->first_name = $first_name;
  }

  /**
   * @return mixed
   */
  public function getLastName() {
    return $this->last_name;
  }

  /**
   * @param mixed $last_name
   */
  public function setLastName($last_name) {
    $this->last_name = $last_name;
  }

  /**
   * @return mixed
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param mixed $email
   */
  public function setEmail($email) {
    $this->email = $email;
  }

  /**
   * @return mixed
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * @param mixed $password
   */
  public function setPassword($password) {
    $this->password = $password;
  }

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  private $first_name;
  private $last_name;
  private $email;
  private $password;
  private $id = null;

}

