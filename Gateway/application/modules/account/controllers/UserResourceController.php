<?php
/**
 * Created by PhpStorm.
 * User: leomasta
 * Date: 29/05/15
 * Time: 17:32
 */

class Account_UserResourceController extends Application_Model_DealerAbstract{

    public function resourceAction (){

        $path =APPLICATION_PATH .'/configs/user-resource.json';
        $resource = file_get_contents($path);
        $data = json_decode($resource);

        $datas = array();
        foreach($data as $key=>$val){
            $datas['text']=$val->text;
            $datas['sref']=$val->sref;
            if(!empty($val->submenu)){
                foreach ($val->submenu as $key=>$val) {
                    $datas['text']=$val->text;
                    $datas['sref']=$val->sref;
                }

            }
            print_r($datas);
        }



    }


}