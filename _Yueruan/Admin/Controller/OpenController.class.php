<?php
namespace Home\Controller;
use Think\Controller;
class OpenController extends Controller {
    public function index(){     
        
        echo "Welcome to YRSS Open Platform!";

        //$this->display(); 
    }
        
    public function api(){
      $this->show('<title>Open Platform</title>','utf-8');
       echo "Welcome to YRSS Open Platform!<br>Here is the api introduction!";
    }

}

