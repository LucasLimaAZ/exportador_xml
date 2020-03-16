<?php

require_once 'funcoes.php';

foreach($_FILES as $file):

    $conteudo = file_get_contents($file['tmp_name']);
    $nomeArquivo = $file['tmp_name'];
    if(@strpos($conteudo, "evtAdmissao")){
        move_uploaded_file($nomeArquivo, "../arquivosCopiados/$nomeArquivo");
    }

endforeach;