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
        if(empty($params['username'])){
            $this->view->message = 'Username Can`t Empty';
        }
    }


    protected function getDataUser(){
        $params = $this->_request->getParams();
        $this->view->params = $this->getModelLogin()->getUser($params['username'],md5($params['password']));
    }
}