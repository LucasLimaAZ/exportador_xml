<?php

require_once 'funcoes.php';

foreach($_FILES as $file){

    $conteudo = file_get_contents($file['tmp_name']);
    $flag = true;
    
    do{
        $xml = extrairXmlEntre($conteudo, 
            'XML do Evento Assinado para Envio<i/><br/><textarea class="areaDeTextoDaLinhaOk">',
            '</textarea>'
        );
        
        if($xml)
            criarArquivo($xml, @getId(simplexml_load_string($xml)));
        else
            $flag = false;
    
        $conteudo = after($xml, $conteudo);
        
        $scan = extrairXmlEntre($conteudo, 
            'XML do Evento Assinado para Envio<i/><br/><textarea class="areaDeTextoDaLinhaOk">',
            '</textarea>'
        );
    
        if($scan)
            criarArquivo($scan, @getId(simplexml_load_string($scan)));
        else
            $flag = false;
        
    }while($flag);
    
    $flag = true;
    $conteudo = file_get_contents($file['tmp_name']);
    
    do{
        $xml = extrairXmlEntre($conteudo, 
            'XML de Retorno do Processamento do Lote',
            '</textarea>'
        );
    
        if($xml)
            criarArquivo($xml, @getNumeroLote(($xml)));
        else
            $flag = false;
    
        $conteudo = after($xml, $conteudo);
        
        $scan = extrairXmlEntre($conteudo, 
            'XML de Retorno do Processamento do Lote',
            '</textarea>'
        );
    
        if($scan)
            criarArquivo($scan, @getNumeroLote(($scan)));
        else
            $flag = false;
        
    }while($flag);
    
}

echo json_encode("success");
