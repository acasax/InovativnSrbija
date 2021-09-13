<?php

class USER {

    public function returnJSON($type,$data,$params=null)
    {
        $array=[];
        $array['type']=$type;
        $array['data']=$data;
        $array['params']= $params;
        echo json_encode($array);
    }


    public function returnErrorByField($field,$errorMsg) {
       $array=[];
       $array['type']='FIELD_ERROR';
       $array['field']= $field;
       $array['msg']= $errorMsg;
       echo json_encode($array);
    }

    public function redirect($location) {
        return Header ("Location: {$location}");
    }

    public function logged_in() {
        /* if (isset($_COOKIE[*email]))
        {
            return true;
        }else */ if (isset($_SESSION['user_login'])){
            return true;
        }else {
            return false;
        }
    }

}