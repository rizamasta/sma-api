<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 29/05/15
 * Time: 20:54
 */

class Account_Model_Resource extends  Zend_Db_Table_Abstract{

    protected  $_name = 'tbl_resource';

    public function getResource(){
        $select = $this->select();
        $select->from($this->_name,array('*'));
        $select->order('id_parent');
        return $this->getAdapter()->fetchAll($select);
    }

}