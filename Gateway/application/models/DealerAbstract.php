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
        $this->getDataUsers();
        $this->_generateToken();
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

    /**
     * @param null $response
     */
    protected function _getToken($response =null){
        $params = $this->_request->getParam('id');

        $code = (sha1("eticla21"));
        if(sha1($params) === $code){
            $this->view->SecureToken = sha1($params);
            $this->view->ResponseData = $response;
        }else{
            $errorMsg = array(
                'errorCode'=>'404',
                'errorMsg'=>'Pleas Check ID Authorization'
            );
            $this->view->Msg=$errorMsg;
        }

    }

    protected function getModelLogin(){
        $model = new Account_Model_Account();
        return $model;
    }

    protected function getDataUsers(){
        $params = $this->_request->getParams();

        try{
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

                    }

                    /* Get Data Session ID*/



                }catch (Exception $e){
                    $this->view->errorMsg=$e->getMessage();
                }

            }
            /* End Update Data User*/
            $this->view->securityToken = $response['session_id'];
            unset($response['session_id']);
            $this->view->responseData = $response;

        }catch (Exception $e){
            $this->view->msg= json_encode($e->getMessage());
        }
    }

    protected function _generateToken(){
        $params = $this->_request->getParams();
        if(!empty($params['securityToken'])){
             return $this->getModelLogin()->getAuth($params['securityToken']);
        }


    }

}