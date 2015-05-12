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
        $select->columns('username');
        $select->columns('realname');
        $select->columns('session_id');
        $select->columns('id_role');
        $select->columns('last_log');
        $select->where('username = ?',$username);
        $select->where('password = ?',$password);
        try{
            return $data = $this->getAdapter()->fetchRow($select);
        }catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAuth($session_id){
        $select = $this->select();
        $select->from($this->_name,array());
        $select->columns('session_id');
        $select->columns('realname');
        $select->where('session_id =?',$session_id);
        try{
            return $data = $this->getAdapter()->fetchRow($select);
        }catch (Exception $e) {
            return $e->getMessage();
        }
    }

}