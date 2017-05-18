<?php
use FirenetSolucoes\system\controller;

class IndexController extends Controller{
    public function index_action(){
        $this->view('index');
    }
}