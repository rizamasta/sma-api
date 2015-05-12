<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 12/05/15
 * Time: 20:02
 */
class Account_AccountController extends Application_Model_DealerAbstract{

    public function init(){
        if(!empty($this->_generateToken()))
        $this->changePassword();

    }



    protected function getModelAccount(){
        $model = new Account_Model_Account();
        return $model;
    }

    protected function _validParams(){
        $params = $this->_request->getParams();
        if(empty($params['username'])){

        }
    }

    protected function changePassword(){
        $params = $this->_request->getParam('update');
        try{
            foreach($params as $key=>$val){
                if(!empty($key)){
                    $UpdateData[$key]=$val;
                    $UpdateData['update'] = new Zend_Db_Expr('NOW()');
                }
            }
            if(!empty($params['username'])){

                $where = $this->getModelAccount()->getAdapter()->quoteInto('username = ?',$params['username']);
                $this->getModelAccount()->update($UpdateData,$where);
                $this->view->messageUpdate = 'Succes Update !!';

            }else{
                $this->view->messageUpdate = 'Failed Update !!';
            }


        }catch (Exception $e){
            $this->view->ErrorUpdate = $e->getMessage();
        }
    }
}