<?php
namespace FirenetSolucoes\system;

class System {
    private $_url;
    private $_explode;
    public $_controller;
    public $_action;
    public $_params;
    
    public function __construct() {
        $this->setUrl();
        $this->setExplode();
        $this->setController();
        $this->setAction();
        $this->setParams();
    }
    
    private function setUrl(){
        $_GET['url'] = (isset($_GET['url']) ? $_GET['url'] : 'index/index_action');
        $this->_url = $_GET['url'];
    }
    
    private function setExplode(){
        $this->_explode = explode('/', $this->_url);
    }
    
    private function setController(){
        $this->_controller = $this->_explode[0].'Controller';
    }
    
    private function setAction(){
        $ac = (!isset($this->_explode[1]) || $this->_explode[1] == null || $this->_explode[1] == 'index' ? 'index_action' : $this->_explode[1]);
        $this->_action = $ac;
    }
    
    private function setParams(){
        unset($this->_explode[0], $this->_explode[1]);
        
        if(end($this->_explode) == null){
            array_pop($this->_explode);
        }
        
        $i = 0;
        
        $ind = array();
        $value = array();
        
        if(!empty($this->_explode)){
            foreach ($this->_explode as $val) {
                if($i % 2 == 0){
                    $ind[] = $val;
                }else{
                    $value[] = $val;
                }
                ++$i;
            }
        }
        
        if(count($ind) == count($value) && !empty($ind) && !empty($value)){
            $this->_params = array_combine($ind, $value);
        }else{
            if(count($ind) == ""){
              $this->_params = array();
            }else{
                $this->_params = $ind[0];  
            }
        }
    }
    
    public function getParam($ind = null){
        if($ind != null){
            $verificar_paramentros = is_array($this->_params);
            if($verificar_paramentros == "1"){
                if(array_key_exists($ind, $this->_params)){
                    return $this->_params[$ind];
                }else{
                    return false;
                }
            }
            
        }else{
            $verificar_paramentros = is_array($this->_params);
            if($verificar_paramentros == "1"){
                $valor = array_values($this->_params);
                if(!empty($valor[0])){
                    return $valor[0];
                }
            }
        }
    }
    
    public function run(){
        $controller_path = CONTROLLERS.$this->_controller.'.php';
        if(!file_exists($controller_path)){
            //die('Houve um erro. Controller nao existe.');
            require_once(VIEWS.'url.phtml');
            die();
        }else{
            require_once($controller_path);
        }
        $app = new $this->_controller();
        if(!method_exists($app, $this->_action)){
            //die('Houve um erro. Action nao existe.');
            require_once(VIEWS.'url.phtml');
            die();
        }
        $action = $this->_action;
        $app->init();
        $app->$action();
    }
    
}