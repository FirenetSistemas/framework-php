<?php
namespace FirenetSolucoes\system\helpers;

class UploadHelper{
    protected $path = 'upload/', $file, $filename, $fileTmpName;
    
    public function setPath($path){
        $this->path = $path;
        return $this;
    }
    
    public function setFile($file){
        $this->file = $file;
        $this->setFileName();
        $this->setFileTmpName();
        return $this;
    }
    
    protected function setFileName(){
        $arquivo_nome = $this->file['name'];
        $arquivo_nome_separa = explode('.', $arquivo_nome);
        $arquivo_nome_extensao = array_pop($arquivo_nome_separa);
        $nome_arquivo = date("Ymd_").strftime("%H%M%S").".".$arquivo_nome_extensao;
        $this->filename = $nome_arquivo;
    }
    
    protected function setFileTmpName(){
        $this->fileTmpName = $this->file['tmp_name'];
    }
    
    public function getFile($url, $pasta){
        return $url.$this->path.$pasta.$this->filename;
    }
    
    public function upload($url, $pasta){
        if(move_uploaded_file($this->fileTmpName, $_SERVER["DOCUMENT_ROOT"].$url.$this->path.$pasta.$this->filename)){
            return true;
        }else{
            return false;
        }
    }
    
    public function excluirArquivo($file){
        if(file_exists($file)){
           unlink($file);
        }
    } 
    
}