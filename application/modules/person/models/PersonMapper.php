<?php

class Person_Model_PersonMapper
{

  protected $_dbTable;

  public function setDbTable($dbTable)
  {
    if (is_string($dbTable)) {
      $dbTable = new $dbTable();
    }
    if (!$dbTable instanceof Zend_Db_Table_Abstract) {
      throw new Exception('Invalid table data gateway provided');
    }
    $this->_dbTable = $dbTable;
    return $this;
  }

  public function getDbTable()
  {
    if (null === $this->_dbTable) {
      $this->setDbTable('Person_Model_DbTable_Person');
    }
    return $this->_dbTable;
  }

  public function save(Person_Model_Person $person)
  {
    $data = array(
      'email'   => $person->getEmail(),
      'first_name' => $person->getFirstName(),
      'last_name'  => $person->getLastName(),
      'password'   => $person->getPassword(),
    );

    if (null === ($id = $person->getId())) {
      unset($data['id']);
      return $this->getDbTable()->insert($data);
    } else {
      return $this->getDbTable()->update($data, array('id = ?' => $id));
    }
  }

}

