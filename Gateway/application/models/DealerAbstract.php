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
       return $this->_helper->json($array);
    }

    protected function _view($response){
       echo json_encode($response);
    }

    protected function getModelLogin(){
        $model = new Account_Model_Account();
        return $model;
    }

    /**
     * @return Account_Model_Resource
     */
    protected function getModelResource(){
        return new Account_Model_Resource();
    }

    /**
     * @return Account_Model_Role
     */
    protected function getModelRole(){
        return new Account_Model_Role();
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
                        $this->view->errorCode  = 405;
                        $this->view->ErrorLogin = 'User Not Found !!';
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
                $noAuth = array('login' => false,
                    'errorCode' => '405',
                    'ErrorLogin' => 'User Not Found',
                );
                $this->getResponse()->setHttpResponseCode(401);
                $this->_helper->json($noAuth);
                die;

            }
            return $isLogin;
        }else{
            $noAuth = array('login' => false,
                'errorCode' => 500,
                'ErrorLogin' => 'Not Allowed For Use This Sistem !!',
            );
            $this->getResponse()->setHttpResponseCode(401);
            $this->_helper->json($noAuth);
//            die;
        }


    }

    /**
     * @param $param isi yang akan di tulis
     * @param $name nama log
     *  @info  EMERG   = 0;  // Emergency: system is unusable
        ALERT   = 1;  // Alert: action must be taken immediately
        CRIT    = 2;  // Critical: critical conditions
        ERR     = 3;  // Error: error conditions
        WARN    = 4;  // Warning: warning conditions
        NOTICE  = 5;  // Notice: normal but significant condition
        INFO    = 6;  // Informational: informational messages
        DEBUG   = 7;  // Debug: debug messages
     */
    protected function log($message,$level,$name){
        $level  = is_null($level) ? Zend_Log::DEBUG : $level;

        if (is_array($message) || is_object($message)) {
            $message = print_r($message, true);
        }

        $log = new Zend_Log();
        $format = '%timestamp% %priorityName% (%priority%): %message%' . PHP_EOL;
        $formatter = new Zend_Log_Formatter_Simple($format);
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH .'/../data/log/'.$name);
        $writer->setFormatter($formatter);
        $log->addWriter($writer);
        $log->log($message,$level);

    }

    protected function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['id_parent'] == $parentId) {
                $children = $this->buildTree($elements, $element['id_resource']);
                unset($element['id_resource']);
                unset($element['id_parent']);
                if ($children) {
                    $element['submenu'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }


}