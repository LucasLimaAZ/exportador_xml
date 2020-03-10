<?php

require_once("funcoes.php");
die(var_dump($_POST));

switch($_POST["modelo"]){

    case "1200":

        if($_POST["envio_retorno"] == "envio"){
            foreach($_FILES as $file){
                $arquivo = $file['tmp_name'];
                lerCSV($arquivo, "1200", "envio");
            }
        }else{
            foreach($_FILES as $file){
                $arquivo = $file['tmp_name'];
                lerCSV($arquivo, "1200", "retorno");
            }
        }

    break;

    case "1210":

        if($_POST["envio_retorno"] == "envio"){
            foreach($_FILES as $file){
                $arquivo = $file['tmp_name'];
                lerCSV($arquivo, "1210", "envio");
            }
        }else{
            foreach($_FILES as $file){
                $arquivo = $file['tmp_name'];
                lerCSV($arquivo, "1210", "retorno");    
            }
        }

    break;

    case "2200":

        if($_POST["envio_retorno"] == "envio"){
            foreach($_FILES as $file){
                $arquivo = $file['tmp_name'];          
                lerCSV($arquivo, "2200", "envio");  
            }
        }else{
            foreach($_FILES as $file){
                $arquivo = $file['tmp_name'];
                lerCSV($arquivo, "2200", "retorno");
            }
        }

    break;

}

die(json_encode("success"));