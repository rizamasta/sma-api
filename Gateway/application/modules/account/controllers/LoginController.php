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
        $this->view->response= $this->getModelLogin()->getUser($params['username'],sha1($params['password']));
    }
}