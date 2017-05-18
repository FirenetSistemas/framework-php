<?php
use FirenetSolucoes\system\model;

class AdmModel extends Model{

    public function Cadastrar($sessao, $campo1, $campo2) {
        $this->insert(array(
            "campo1" => $campo1,
            "campo2" => $campo2
        ));
    }

	public function Atualizar($where, $campo1, $campo2) {
        $this->update(array(
            "campo1" => $campo1,
            "campo2" => $campo2
        ), "$where");
    }

	public function sqlDeletar($where){
        return $this->delete($where);
    }

    public function sqlArquivoDeletar($where, $imagem){
        $apagar_arquivo = new UploadHelper();
        $apagar_arquivo->excluirArquivo('upload/'.$imagem);
        return $this->delete($where);
    }
    
    public function ArquivoDeletar($imagem){
        $apagar_arquivo = new UploadHelper();
        $apagar_arquivo->excluirArquivo('upload/'.$imagem);
    }
}