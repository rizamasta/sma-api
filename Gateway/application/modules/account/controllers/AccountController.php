<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 12/05/15
 * Time: 20:02
 */
class Account_AccountController extends Application_Model_DealerAbstract{

    public function init(){
        $this->_generateToken();
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
            if(!empty($params))
            foreach($params as $key=>$val){
                if(!empty($key)){
                    $UpdateData[$key]=$val;
                    if($key==='password'){
                        $UpdateData['password']=sha1($val);
                    }
                    $UpdateData['update'] = new Zend_Db_Expr('NOW()');
                }
            }
            if(!empty($params['username'])){
                try{
                    $where = $this->getModelAccount()->getAdapter()->quoteInto('username = ?',$params['username']);
                    if($this->getModelAccount()->update($UpdateData,$where)){
                        $this->view->messageUpdate = 'Succes Update !!';
                        $params['Msg']='Succes Update !!';
                        $this->log($params,null,'succes.log');
                    }else{
                        $this->log($params,null,'fail.log');
                        $this->view->messageUpdate = 'Failed Update !!';
                    }

                }catch (Exception $e){
                    $this->view->errorMsg = $e->getMessage();
                }
            }else{
                $this->view->errorCode = 102;
                $this->view->messageUpdate = 'Failed Update,Please Check Your Params !!';
//                $this->logUpdate();
                $this->logUpdate($this->getRequest()->getParams());
            }


        }catch (Exception $e){
            $this->view->ErrorUpdate = $e->getMessage();
        }
    }

    protected function logUpdate($message){

        $this->log($message,null,'AccountUpdate.log');
    }


}