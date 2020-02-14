<?php

require_once 'funcoes.php';

$conteudo = file_get_contents($_FILES['arquivo']['tmp_name']);
$flag = true;

do{
    
    $xml = extrairXmlDe($conteudo, 
        '<eSocial',
        '</eSocial>'
    );

    if($xml)
        criarArquivo($xml, @getId(simplexml_load_string($xml)));
    else
        $flag = false;

    $i++;
    $conteudo = after($xml, $conteudo);
    
    $scan = extrairXmlDe($conteudo, 
        '<eSocial',
        '</eSocial>'
    );

    $conteudo = after($scan, $conteudo);

    if($scan)
        criarArquivo($scan, @getId(simplexml_load_string($scan)));
    else
        $flag = false;
    
}while($flag);

echo json_encode("success");