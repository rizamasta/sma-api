<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 29/05/15
 * Time: 17:32
 */

class Account_UserResourceController extends Application_Model_DealerAbstract{


    public function indexAction(){
        $this->_generateToken();
        $this->getRole();
    }

    public function getResource(){
        $resource =  $this->getModelResource()->getResource();
        $menuResource = array();
        foreach ($resource as $key=>$val){
            $val['id_resource']= (int)$val['id_resource'];
            $val['id_parent']= (int)$val['id_parent'];
            $menuResource[]=$val;

        }

        $path =APPLICATION_PATH .'/configs/user-resource.php';
        include ($path);

        $treeMenus = $this->buildTree($menu);
        $this->view->resourceMenu  =$treeMenus;
    }

    public function resourceAction (){

        $path =APPLICATION_PATH .'/configs/user-resource.php';
        include ($path);

        /** Variabel Menu Diambil daro variable yang berasal dari file $path */
        try{
            foreach($menu  as $val){
                $this->getModelResource()->insert($val);
            }
        }catch (Exception $e){
            $this->view->errorMsg=$e->getMessage();
        }

    }

    public function addUserRoleAction(){
        $data = $this->getRequest()->getParam('role');
        $data['create_at']= new Zend_Db_Expr('NOW()');
        try{
            $this->getModelRole()->insert($data);
            $this->_helper->json('SUCESS SAVE');
        }catch (Exception $e){
            $this->_helper->json($e->getMessage());
        }

    }

    protected function getRole(){
        $idrole =$this->getRequest()->getParam('securityToken');

      if(is_null($idrole)) return false;
        $role= $this->getModelRole()->getRole($idrole);
        if(!empty($role['id_role'])){
            $ruleMenu = $this->getModelRole()->getRule($role['id_role']);
            if(!empty($ruleMenu)){
                $menuTree = $this->buildTree($ruleMenu);
                $this->log($menuTree,null,'userResource.log');
                $this->_helper->json($menuTree);
            }else{
                $this->log($this->getRequest()->getParams(),null,'ERRORuserResource.log');
                $this->view->errorCode =111;
                $this->view->errorMessage = 'User Resource Menu Not Found, Please Contact Call Center';
            }

        }else{
            $this->log($this->getRequest()->getParams(),null,'ERRORuserResource.log');
            $this->view->errorCode =111;
            $this->view->errorMessage = 'User Resource Menu Not Found, Please Contact Call Center';
        }
    }
}

