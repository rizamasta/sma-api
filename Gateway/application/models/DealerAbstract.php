<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 11/05/15
 * Time: 19:28
 */
class  Application_Model_DealerAbstract extends REST_Controller{

    protected $_views = null;

    public function indexAction(){

    }

    public function postAction(){

    }

    protected function pr($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    protected function _view($response){
       echo json_encode($response);
    }

    protected function getModelLogin(){
        $model = new Account_Model_Account();
        return $model;
    }

    protected function getDataUsers(){
        $params = $this->_request->getParams();

        try{
            if(!empty($params['username']) && !empty($params['password'])){
                    $response= $this->getModelLogin()->getUser($params['username'],sha1($params['password']));
                    /* Start Update Data Login User*/
                    if(!empty($response)){
                            try{
                                    session_start();
                                    $upadateUser = array(
                                        'last_log'=>new Zend_Db_Expr('NOW()'),
                                        'session_id'=>sha1(session_id().$response['username']),
                                    );

                                    if(!empty($response['username'])){
                                        /*Save Data Update*/
                                        $where = $this->getModelLogin()->getAdapter()->quoteInto('username = ?',$response['username']);
                                        $this->getModelLogin()->update($upadateUser,$where);
                                        $response= $this->getModelLogin()->getUser($params['username'],sha1($params['password']));

                                        /*get Message Status*/
                                        $this->view->login = true;
                                        $this->view->securityToken = $response['session_id'];
                                        unset($response['session_id']);
                                        $this->view->responseData = $response;
                                    }
                            }catch (Exception $e){
                                    $this->view->errorMsg=$e->getMessage();
                            }

                    }else{
                        $this->view->login = false;
                        $this->view->errorCode  = '405';
                        $this->view->ErrorLogin = 'User Not Found';
                    }
            }else{
                $this->view->login = false;
                $this->view->errorCode  = 500;
                $this->view->ErrorLogin = 'Not Allowed For Use This Sistem !!';
            }
            /* End Update Data User*/


        }catch (Exception $e){
            $this->view->errorMsg= json_encode($e->getMessage());
        }
    }


    protected function _generateToken(){
        $params = $this->_request->getParams();
        if(!empty($params['securityToken'])){
            $findUser = $this->getModelLogin()->getAuth($params['securityToken']);
            $isLogin = false;
            if(!empty($findUser)){
                $this->view->login = true;
                $isLogin = true;
            }else{
                $this->view->login = false;
                $this->view->errorCode = '405';
                $this->view->ErrorLogin = 'User Not Found';
                $isLogin =false;
            }
            return $isLogin;
        }else{
            $this->view->login = false;
            $this->view->errorCode  = 500;
            $this->view->ErrorLogin = 'Not Allowed For Use This Sistem !!';
        }


    }

}