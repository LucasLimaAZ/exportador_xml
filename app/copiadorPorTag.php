<?php

require_once 'funcoes.php';

foreach($_FILES as $file):

    $conteudo = file_get_contents($file['tmp_name']);
    $nomeTmp = $file['tmp_name'];
    $nomeArquivo = $file['name'];
    if(@strpos($conteudo, "evtAdmissao")){
        move_uploaded_file($nomeTmp, "../arquivosCopiados/$nomeArquivo");
    }

endforeach;

die(json_encode("success"));