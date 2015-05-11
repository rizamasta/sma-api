<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 11/05/15
 * Time: 21:44
 */

class Account_Model_Account extends  Zend_Db_Table_Abstract{
    protected  $_name = 'tbl_user';

    public function getUser($username,$password){
        $select = $this->select();
        $select->from($this->_name,array());
        $select->columns('*');
        $select->where('nama_login = ?',$username);
        $select->where('password = ?',$password);
        return $this->getAdapter()->fetchRow($select);
    }
}