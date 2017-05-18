<?php
use FirenetSolucoes\system\controller;
use FirenetSolucoes\system\helpers\authHelper;
use FirenetSolucoes\system\helpers\redirectorHelper;

class AdmController extends Controller {

	public function index_action(){
        $redirect = new RedirectorHelper();
        
        if(!empty($_SESSION['pagina'])){
            $pagina = $_SESSION['pagina'];
        }else{
            $pagina = "inicio";
        }
        $redirect->setUrlParameter('secao', $pagina)
                 ->goToAction('gerenciar');
    }

    public function login(){
        $this->auth = new authHelper();
        if($this->getParam('acao')){
            $this->auth->setTableName('usuario')
                 ->setUserColumn('login')
                 ->setPassColumn('senha')
                 ->setUser($_POST['login'])
                 ->setPass(md5($_POST['senha']))
                 ->setPagina($_POST['pagina'])
                 ->setLoginControllerAction('adm', 'index')
                 ->login();
        }
        $this->view('index');
    }

    public function logout(){
        $this->auth = new authHelper();
        $this->auth->logout();
        $redirect = new RedirectorHelper();
        $redirect->go();
    }


    public function gerenciar(){
        $this->auth = new authHelper();
        $this->auth->setLoginControllerAction('adm', 'login')
                   ->checkLogin('redirect');

        $redirect = new RedirectorHelper();

        $secao = $this->getParam('secao');
        $acao = $this->getParam('acao');
        $id = $this->getParam('id');
        $buscar = $this->getParam('buscar');
        $post = $_POST;

        if($secao=="inicio"){

        }

        $datas['secao'] = $secao;
        $datas['acao'] = $acao;
        $datas['id'] = $id;
        $datas['buscar'] = $buscar;
        $datas['post'] = $post;
        
        $this->view('admGerenciar', $datas);
    }
}