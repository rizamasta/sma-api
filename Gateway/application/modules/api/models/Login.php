<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 11/05/15
 * Time: 15:23
 */
class Api_Model_Login extends Zend_Db_Table_Abstract{
    protected $_name = 'tabel_user';

    public function getLogin($username,$password){
        $select = $this->select();
        $select->from($this->_name,array());
        $select->columns('user_name');
        $select->columns('id_role');
        $select->columns('nama');
        $select->where('user_name = ?',$username);
        $select->where('password = ?',$password);
        $data =  $this->getAdapter()->fetchRow($select);
//      echo $select;
        return $data;
//        return json_encode($select);
    }

}