<?php

class Account_LoginController extends Application_Model_DealerAbstract{


    public function init(){
          $this->getDataUsers();
    }

    public function indexAction(){


    }


    protected function  _validParams(){
        $params = $this->_request->getParams();
        if(!empty($params['username']) && is_numeric($params['username'])){
            $this->view->errorMsgLogin = 'Username Can`t Be Numeric';

        }

    }
    protected function _getDataUser(){
        $params = $this->_request->getParams();

            try{
                if(!empty($params['username']) && $params['password'])
                 $response= $this->getModelLogin()->getUser($params['username'],sha1($params['password']));

                /* Start Update Data Login User*/
                if(!empty($response)){
                    try{
                        $upadateUser = array(
                            'last_log'=>new Zend_Db_Expr('NOW()')
                        );

                        if(!empty($response['username'])){
                            $where = $this->getModelLogin()->getAdapter()->quoteInto('username = ?',$response['username']);
                            $this->getModelLogin()->update($upadateUser,$where);
                        }

                    }catch (Exception $e){
                        $this->view->errorMsg=$e->getMessage();
                    }

                }
                /* End Update Data User*/
                $this->view->ResponseData = $response;

            }catch (Exception $e){
                $this->view->errorMsg= json_encode($e->getMessage());
            }

    }
}