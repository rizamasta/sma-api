<?php

class Account_LoginController extends Application_Model_DealerAbstract{


    protected function getModelLogin(){
        $model = new Account_Model_Account();
        return $model;
    }

    public function indexAction(){
        $this->_validParams();
        $this->getDataUser();

    }


    protected function  _validParams(){
        $params = $this->_request->getParams();
        if(!empty($params['username']) && is_numeric($params['username'])){
            $this->view->errorMsg = 'Username Can`t Be Numeric';

        }

    }

    protected function getDataUser(){
        $params = $this->_request->getParams();

        try{
            $response= $this->getModelLogin()->getUser($params['username'],sha1($params['password']));
            /* Start Update Data Login User */
            if(!empty($response)){
                try{
                    $upadateUser = array(
                        'last_log'=>new Zend_Db_Expr('NOW()')
                    );
                    $where = $this->getModelLogin()->getAdapter()->quoteInto('username = ?',$response['username']);
                    $this->getModelLogin()->update($upadateUser,$where);
                }catch (Exception $e){
                    $this->view->errorMsg=$e->getMessage();
                }

            }
            /* End Update Data User */
            echo json_encode($response);

        }catch (Exception $e){
            echo json_encode($e->getMessage());
        }

    }
}