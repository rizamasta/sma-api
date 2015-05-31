<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 29/05/15
 * Time: 20:54
 */

class Account_Model_Role extends  Zend_Db_Table_Abstract{

    protected  $_name = 'tbl_role';

    public function getRole($securityToken){
        if (empty ($securityToken))
        return false;
        $query = $this->select();
        $query->from(array('rl'=>$this->_name),array());
        $query->setIntegrityCheck(false);
        $query->join(array('usr'=>'tbl_user'),'rl.id=usr.id_role',array('*'));
        $query->where('usr.session_id = ?',$securityToken);
        return $this->getAdapter()->fetchRow($query);
    }

    public function getRule($idrole){
        if(empty($idrole))
        return false;

        $query = $this->select();
        $query->from(array('rl'=>$this->_name),array());
        $query->setIntegrityCheck(false);
        $query->join(array('rule'=>'tbl_rule'),'rl.id=rule.id_role',array());
        $query->join(array('resource'=>'tbl_resource'),'rule.id_resource=resource.id_resource',array('*'));
        $query->where('rule.id_role = ?',$idrole);
        $query->order('resource.id_resource');
        return $this->getAdapter()->fetchAll($query);

    }
}