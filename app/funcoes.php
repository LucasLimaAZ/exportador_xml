<?php

function after ($inthis, $inthat)
{
    if (!is_bool(@strpos($inthat, $inthis)))
    return substr($inthat, strpos($inthat,$inthis)+strlen($inthis));
};

function criarArquivo($xml, $nomeArquivo)
{
    $novoArquivo = fopen("../output/$nomeArquivo.xml", "w");
    fwrite($novoArquivo, $xml);
    fclose($novoArquivo);
}

function extrairXmlEntre($conteudo, $palavraInicial, $palavraFinal) 
{ 
    if(@strpos($conteudo, $palavraInicial)){
        $recorte = @strpos($conteudo, $palavraInicial); 
        $recorte += strlen($palavraInicial);   
        $tamanho = @strpos($conteudo, $palavraFinal, $recorte) - $recorte;   
    
        return substr($conteudo, $recorte, $tamanho);   
    }
} 

function getId($object)
{
    foreach($object as $key => $value){
        if(isset($value["Id"])){
            return $value["Id"];
        }
    }
}