<?php
namespace FirenetSolucoes\system\helpers;

class RedirectorHelper{
    protected $parameters = array();
    
    public function go($data){
        header("Location: ".WEBFILES.$data);
    }
    
    public function setUrlParameter($name, $value){
        $this->parameters[$name] = $value;
        return $this;
    }
    
    public function getUrlParameter(){
        $params = "";
        foreach($this->parameters as $name => $value){
            $params .= $name.'/'.$value.'/';
        }
        return $params;
    }
    
    public function goToController($controller){
        $this->go($controller.'/'.$this->getUrlParameter());
    }
    
    public function goToAction($action){
        $RemoveTexto = str_replace("Controller", "", $this->getCurrentController());
        $this->go($RemoveTexto.'/'.$action.'/'.$this->getUrlParameter());
    }
    
    public function goToControllerAction($controller, $action){
        $this->go($controller.'/'.$action.'/'.$this->getUrlParameter());
    }
    
    public function goToIndex(){
        $this->goToController('index');
    }
    
    public function goToUrl($url){
        header("Location: ".$url);
    }
    
    public function getCurrentController(){
        global $start;
        return $start->_controller;
    }
    
    public function getCurrentAction(){
        global $start;
        return $start->_action;
    }
}