<?php

require_once 'funcoes.php';

// foreach($_FILES as $file):

//     $conteudo = file_get_contents($file['tmp_name']);
//     $nomeTmp = $file['tmp_name'];
//     $nomeArquivo = $file['name'];
//     if(@strpos($conteudo, "evtAdmissao")){
//         move_uploaded_file($nomeTmp, "../arquivosCopiados/$nomeArquivo");
//     }

// endforeach;
$i = 0;
$arquivos = scandir("../arquivosParaCopiar");

foreach($arquivos as $arquivo){
    $arquivoXml = fopen("../arquivosParaCopiar/$arquivo", "r");
    $conteudo = fread($arquivoXml, filesize("../arquivosParaCopiar/$arquivo"));
    if(@strpos($conteudo, "evtAdmissao")){
        $arquivosEncontrados[$i] = $arquivo;

        if(@strpos($conteudo, "<retornoEvento")){
            $fp = fopen("../arquivosCopiados/".getId(simplexml_load_string(utf8_encode($conteudo)))."_retorno.xml", "w");
            fwrite($fp, $conteudo);
        }else{
            $fp = fopen("../arquivosCopiados/".getId(simplexml_load_string(utf8_encode($conteudo))).".xml", "w");
            fwrite($fp, $conteudo);
        }
        
        $i++;
    }
}

die(json_encode($arquivosEncontrados));