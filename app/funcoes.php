<?php

function after ($inthis, $inthat)
{
    if (!is_bool(@strpos($inthat, $inthis)))
    return substr($inthat, strpos($inthat,$inthis)+strlen($inthis));
};

function criarArquivo($xml)
{
    $nomeArquivo = rand(0, 9999999);
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

// function getId($object)
// {
//     foreach($object as $prop){
//         if($prop["Id"]){
//             return $prop["Id"];
//         }
//     }
// }