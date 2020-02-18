<?php

require_once 'funcoes.php';

$conteudo = file_get_contents($_FILES['arquivo']['tmp_name']);
$conteudo = after("<eSocial", $conteudo);
$flag = true;

do{
    
    $xml = extrairXmlDe($conteudo, 
        '<eSocial',
        '</eSocial>'
    );

    if($xml){
        if(strpos($xml, "<retornoEvento"))
            criarArquivo($xml, "retorno_".@getId(simplexml_load_string($xml)));
        else
            criarArquivo($xml, @getId(simplexml_load_string($xml)));
    }else{
        $flag = false;
    }

    $conteudo = after($xml, $conteudo);
    
    $scan = extrairXmlDe($conteudo, 
        '<eSocial',
        '</eSocial>'
    );

    $conteudo = after($scan, $conteudo);

    if($scan){
        if(strpos($xml, "<retornoEvento"))
            criarArquivo($xml, "retorno_".@getId(simplexml_load_string($xml)));
        else{
            criarArquivo($scan, @getId(simplexml_load_string($scan)));
        }
    }else{
        $flag = false;
    }
        
    
}while($flag);

echo json_encode("success");