<?php
namespace FirenetSolucoes\system\helpers;

class PaginacaoHelper {
    public $pagina, $registros, $registros_total;
    
    public function direcaoPaginas($pagina, $registros){
        $regpag = ($pagina*$registros)-$registros;
        $avancar_pagina = $pagina+1;
        $voltar_pagina = $pagina-1;
        $direcao = array("avancar" => $avancar_pagina, "voltar" =>$voltar_pagina, "regpag" =>$regpag, "pagina" => $pagina, "registros" => $registros);
        return $direcao;
    }
    
    public function guiaPaginas($pagina, $registros, $registros_total, $caminho){
        $listar_paginas = "";
        $max_pagina = "10";
        $total_paginas = round($registros_total);
        $total_paginas_geral = round($registros_total);
        
        //se o total de pagina for menor que a paginação segue caso contrario a paginação para para não passar do total
        if($total_paginas < $max_pagina){
            $max_pagina1 = "$total_paginas";
        }else{
            $max_pagina1 = "$max_pagina";
        }
        
        //se pagina atual for menor que o total de paginas ele mostra ler essa linha do if
        if($pagina<="$max_pagina1"){
            //quando a pagina chegar até o numero 5 ele acrescenta +5 pagina na frente e tira -5 nas paginas anterior
            if($pagina>=5){
            $x_pagina = "5";
            $max_links = $max_pagina1+5;
            }else{
            $x_pagina = "1";
            $max_links = "$max_pagina1";
            }    
        }else{
            $max_links_soma = "$pagina";
            if($total_paginas == $pagina){
                $max_links = "$total_paginas";    
            }else{
                $max_links = ++$max_links_soma+5;
            }
            $x_pagina_soma = $max_links-$max_pagina1;
            $x_pagina = "$x_pagina_soma";
        }

        //esquema para quando faltar 6 paginas para acabar ele diminuir a páginação para não utrapassar ao total de páginas
        if($max_links >= $total_paginas){
            $max_links = "$total_paginas";
        }
        
        for ($x=$x_pagina; $x<=$max_links; $x++){
	if($x==$pagina){
		$listar_paginas.="<div id='paginacao-numero'>$x</div>";
	}else{
		$listar_paginas.="<div class='paginacao-numeros' onclick=window.open('$caminho/pagina/$x/registros/$registros/','_top');>$x</div>";
	}
        }
        
        $total_pagina = $x-1;
        
        $paginas = array("total" => $total_pagina, "listar" => $listar_paginas, "total_geral" => $total_paginas_geral);
        
        return $paginas;
    }
    
}