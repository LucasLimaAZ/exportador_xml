<?php

require_once 'funcoes.php';

$conteudo = file_get_contents($_FILES['arquivo']['tmp_name']);
$flag = true;

do{
    $xml = extrairXmlEntre($conteudo, 
        'XML do Evento Assinado para Envio<i/><br/><textarea class="areaDeTextoDaLinhaOk">',
        '</textarea>'
    );
    
    criarArquivo($xml);

    $conteudo = after($xml, $conteudo);
    
    $scan = extrairXmlEntre($conteudo, 
        'XML do Evento Assinado para Envio<i/><br/><textarea class="areaDeTextoDaLinhaOk">',
        '</textarea>'
    );

    if($scan != false){
        
        criarArquivo($scan);
    }else{
        $flag = false;
    }
    
}while($flag);

$flag = true;
$conteudo = file_get_contents($_FILES['arquivo']['tmp_name']);

do{
    $xml = extrairXmlEntre($conteudo, 
        'XML de Retorno do processamento do lote',
        '</textarea>'
    );
    
    criarArquivo($xml);

    $conteudo = after($xml, $conteudo);
    
    $scan = extrairXmlEntre($conteudo, 
        'XML de Retorno do processamento do lote',
        '</textarea>'
    );

    if($scan != false){
        
        criarArquivo($scan);
    }else{
        $flag = false;
    }
    
}while($flag);

echo json_encode("success");