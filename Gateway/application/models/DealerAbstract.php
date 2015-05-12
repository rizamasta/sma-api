<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 11/05/15
 * Time: 19:28
 */
class  Application_Model_DealerAbstract extends REST_Controller{

    protected $_views = null;
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
}