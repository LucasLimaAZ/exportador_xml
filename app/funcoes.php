<?php

function after ($inthis, $inthat)
{
    if (!is_bool(@strpos($inthat, $inthis)))
    return substr($inthat, strpos($inthat,$inthis)+strlen($inthis));
}

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

function extrairXmlDe($conteudo, $palavraInicial, $palavraFinal) 
{ 
    if(@strpos($conteudo, $palavraInicial)){
        $recorte = @strpos($conteudo, $palavraInicial);
        $tamanho = (@strpos($conteudo, $palavraFinal, $recorte) + strlen($palavraFinal)) - $recorte; 
    
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

function getNumeroLote($lote)
{
    $nomeArquivo = extrairXmlEntre($lote, 
        "'",
        "'"
    );

    return $nomeArquivo;
}

function lerCSV($arquivo, $modelo, $envio_retorno)
{
    $handle = fopen("{$arquivo}", "r");
    $row = 0;
    while ($coluna = fgetcsv($handle, 1000, ";")) {
        if ($row++ == 0) {
            continue;
        }

        switch($modelo){

            case "1200":
        
                if($envio_retorno == "envio"){
                    montarXml1200Envio($coluna);
                }else{
                    montarXml1200Retorno($coluna);
                }
        
            break;
        
            case "1210":
        
                if($envio_retorno == "envio"){
                    montarXml1210Envio($coluna);
                }else{
                    montarXml1210Retorno($coluna);
                }
        
            break;
        
            case "2200":
        
                if($envio_retorno == "envio"){
                    montarXml2200Envio($coluna);
                }else{
                    montarXml2200Retorno($coluna);
                }
        
            break;
        
        }

    }
    fclose($handle);
}

function montarXml1200Envio($coluna)
{
    $coluna[5] .= rand(10000000000000, 99999999999999);

    $xml = '
        <eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtRemun/v02_04_02">
        <evtRemun Id="'.$coluna[0].'">
        <ideEvento>
        <indRetif>1</indRetif>
        <indApuracao>1</indApuracao>
        <perApur>'.$coluna[2].'</perApur>
        <tpAmb>1</tpAmb>
        <procEmi>1</procEmi>
        <verProc>METADADOS 4.23.2.1</verProc>
        </ideEvento>
        <ideEmpregador>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[1]).'</nrInsc>
        </ideEmpregador>
        <ideTrabalhador>
        <cpfTrab>'.$coluna[3].'</cpfTrab>
        <nisTrab>'.$coluna[4].'</nisTrab>
        </ideTrabalhador>
        <dmDev>
        <ideDmDev>'.$coluna[5].'</ideDmDev>
        <codCateg>101</codCateg>
        <infoPerApur>
        <ideEstabLot>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[7]).'</nrInsc>
        <codLotacao>SIRH.0748.1600</codLotacao>
        <remunPerApur>
        <matricula>'.$coluna[6].'</matricula>
        <itensRemun>
        <codRubr>SIRH.0748.7001</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <qtdRubr>40</qtdRubr>
        <vrRubr>493.68</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.78101</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <vrRubr>493.68</vrRubr>
        </itensRemun>
        <infoAgNocivo>
        <grauExp>1</grauExp>
        </infoAgNocivo>
        </remunPerApur>
        </ideEstabLot>
        </infoPerApur>
        </dmDev>
        <dmDev>
        <ideDmDev>'.$coluna[5].'</ideDmDev>
        <codCateg>101</codCateg>
        <codCateg>101</codCateg>
        <infoPerApur>
        <ideEstabLot>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[7]).'</nrInsc>
        <codLotacao>SIRH.0748.1600</codLotacao>
        <remunPerApur>
        <matricula>'.$coluna[6].'</matricula>
        <itensRemun>
        <codRubr>SIRH.0748.20</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <qtdRubr>184.8</qtdRubr>
        <vrRubr>1036.73</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.30</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <qtdRubr>29.33</qtdRubr>
        <vrRubr>164.54</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.4050</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <qtdRubr>5.05</qtdRubr>
        <fatorRubr>50</fatorRubr>
        <vrRubr>42.5</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.6001</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <qtdRubr>1.2</qtdRubr>
        <vrRubr>6.75</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.41101</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <qtdRubr>1</qtdRubr>
        <vrRubr>31.71</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.52101</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <vrRubr>493.68</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.57001</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <vrRubr>1</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.63101</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <vrRubr>100.04</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.77101</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <vrRubr>1250.52</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.78101</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <vrRubr>756.84</vrRubr>
        </itensRemun>
        <itensRemun>
        <codRubr>SIRH.0748.79101</codRubr>
        <ideTabRubr>SIRH.1</ideTabRubr>
        <vrRubr>1250.52</vrRubr>
        </itensRemun>
        <infoAgNocivo>
        <grauExp>1</grauExp>
        </infoAgNocivo>
        </remunPerApur>
        </ideEstabLot>
        </infoPerApur>
        </dmDev>
        </evtRemun>
        <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
        <SignedInfo>
        <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        <SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
        <Reference URI="">
        <Transforms>
        <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
        <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        </Transforms>
        <DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
        <DigestValue>GgTyKfEEQwJc6g0ciCtniL+XEY2S+oh5YnJaXK4Db6o=</DigestValue>
        </Reference>
        </SignedInfo>
        <SignatureValue>
        amvLp+BFp275LaEBkn0+zT8wGxNc2MojTjuXOvjofXGWS+F7A+tt5BPfD/TT+Zc3ozOYN6OvBUctNP1MY3YAaQvQ3dXzCo6HOkpxqRQA0AR7IMQt97gUFmfXH8TguBAskguCmeOdb0EKs1MnqvVtRHhEocj+fg56yge1I1Q7aEEWCiPVqGxmFAcihSn4llMFN7d8g4k3EXZe4lK1WRphDwxYW8UomF+2thSIB8OPQfppLwhP2Uy3/0sSu3LpcMoQLFTUGLaaOlTpA9SYX7SJjvEY6O4iYTmYpMhadNkcn6J65VT/TCXUGR81cYttGr2g309qWZr7gXvY/vc24E+dvg==
        </SignatureValue>
        <KeyInfo>
        <X509Data>
        <X509Certificate>
        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
        </X509Certificate>
        </X509Data>
        </KeyInfo>
        </Signature>
        </eSocial>
    ';

    $montar_xml = fopen("../output/s1200_envio_".rand(0, 99999999999999).".xml", "w");
    fwrite($montar_xml, $xml);
}

function montarXml1200Retorno($coluna)
{
    $xml = '
        <eSocial xmlns="http://www.esocial.gov.br/schema/evt/retornoEvento/v1_2_1">
        <retornoEvento Id="'.$coluna[0].'">
        <ideEmpregador>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[1]).'</nrInsc>
        </ideEmpregador>
        <recepcao>
        <tpAmb>1</tpAmb>
        <dhRecepcao>2020-02-06T15:32:55.36</dhRecepcao>
        <versaoAppRecepcao>0.1.0-A0384</versaoAppRecepcao>
        <protocoloEnvioLote>1.1.202002.0000000000888473633</protocoloEnvioLote>(verificar se tem que colocar numero aleatorio e ano 2019)
        </recepcao>
        <processamento>
        <cdResposta>201</cdResposta>
        <descResposta>Sucesso.</descResposta>
        <versaoAppProcessamento>12.0.0-A4631</versaoAppProcessamento>
        <dhProcessamento>2020-02-06T15:32:59.603</dhProcessamento>
        </processamento>
        <recibo>
        <nrRecibo>'.$coluna[8].'</nrRecibo>
        <hash>e6V4FgHOaBGBek2/1e12t+3dUR88SI7dIZtGWADLrsI=</hash>
        </recibo>
        </retornoEvento>
        <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
        <SignedInfo>
        <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        <SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
        <Reference URI="">
        <Transforms>
        <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
        <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        </Transforms>
        <DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
        <DigestValue>LEigGpEMnuY9kIScEm7o9rd43SmWmjJkEnRtDE5PQUM=</DigestValue>
        </Reference>
        </SignedInfo>
        <SignatureValue>
        VmAf3Y6P5RJLRRFsrgqXBBLuSMZPCznZl/t10w6iU3sqPBasQ2M52xq+hfY450UEL45kxnQW4L2xKdHmM22yeV4AXsnhDYMfaWV+ecGX9KXjYlVB4D2updHtLFVKWaQIaPbwAtgHHMZtrEaWY+bco/1USFtB1NCSUDlrKZ6NL8RbsT+QUEmd5I84JYUV4IWf+ZATrjT6ab1IMPEIAVUMlO0c/Z8p1tlRcJttccllfkbC7wXS27q3KueQM+8XMVvTcUswWqPkJ8RjWGtdv7kvT7TnOmmXUphvE1GlP8BGfo1kE0NXqkoxA5xxUiWm6P5SL6kBEb9r19b9n0KqXvkVhA==
        </SignatureValue>
        <KeyInfo>
        <X509Data>
        <X509Certificate>
        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
        </X509Certificate>
        </X509Data>
        </KeyInfo>
        </Signature>
        </eSocial>
    ';

    $montar_xml = fopen("../output/s1200_retorno_".rand(0, 99999999999999).".xml", "w");
    fwrite($montar_xml, $xml);
}

function montarXml1210Envio($coluna)
{
    $xml = '

        <eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtPgtos/v02_04_02">
        <evtPgtos Id="'.$coluna[0].'">
        <ideEvento>
        <indRetif>1</indRetif>
        <indApuracao>1</indApuracao>
        <perApur>'.$coluna[2].'</perApur>
        <tpAmb>1</tpAmb>
        <procEmi>1</procEmi>
        <verProc>METADADOS 4.23.2.1</verProc>
        </ideEvento>
        <ideEmpregador>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[1]).'</nrInsc>
        </ideEmpregador>
        <ideBenef>
        <cpfBenef>'.$coluna[4].'</cpfBenef>
        <deps>
        <vrDedDep>379.18</vrDedDep>
        </deps>
        <infoPgto>
        <dtPgto>2019-04-04</dtPgto>
        <tpPgto>1</tpPgto>
        <indResBr>S</indResBr>
        <detPgtoFl>
        <perRef>'.$coluna[2].'</perRef>
        <ideDmDev>'.$coluna[3].'</ideDmDev>
        <indPgtoTt>S</indPgtoTt>
        <vrLiq>1158.67</vrLiq>
        </detPgtoFl>
        </infoPgto>
        <infoPgto>
        <dtPgto>2019-04-04</dtPgto>
        <tpPgto>1</tpPgto>
        <indResBr>S</indResBr>
        <detPgtoFl>
        <perRef>'.$coluna[2].'</perRef>
        <ideDmDev>'.$coluna[3].'</ideDmDev>
        <indPgtoTt>S</indPgtoTt>
        <vrLiq>693.44</vrLiq>
        </detPgtoFl>
        </infoPgto>
        </ideBenef>
        </evtPgtos>
        <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
        <SignedInfo>
        <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        <SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
        <Reference URI="">
        <Transforms>
        <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
        <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        </Transforms>
        <DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
        <DigestValue>POlAIBlHYU0xgYFC4AzEt2CntJmteqOuGfsJ0xOIse0=</DigestValue>
        </Reference>
        </SignedInfo>
        <SignatureValue>
        HnmU7/ptiavbq2NpUNm5XnNeMUGRrSOs6J2nOhAgc0IFYusJmuR7U1j1+A1PfeSUQaAAJMoFiuBDwS9cuRpUWM0iQ3DK/+/EvdcgSbSJqJ1hl3Zrr2+O2sdyfA+6VZBYA551AjUPZrUJ/9QXQ+gXPNufcyuQaYd2FC9WTeeFU32Tq8NSuHMmhVftiTJW2Zmnor4SfmZLXvMzG7Rl1dvxozJJlqOQcURtaaNToQ95GXDjSv3LdClFytqlrgdodwWgdGSnF+1EfmaKNbHT8q8+g3QL22yZei76x8+X+Ht2MQMPPWPeR6j9UDLJY5Z7jcD9ZM7DBKoHgo7Y/aV7hiCaHQ==
        </SignatureValue>
        <KeyInfo>
        <X509Data>
        <X509Certificate>
        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
        </X509Certificate>
        </X509Data>
        </KeyInfo>
        </Signature>
        </eSocial>

    ';

    $montar_xml = fopen("../output/s1210_envio_".rand(0, 99999999999999).".xml", "w");
    fwrite($montar_xml, $xml);
}

function montarXml1210Retorno($coluna)
{
    $xml = '

        <eSocial xmlns="http://www.esocial.gov.br/schema/evt/retornoEvento/v1_2_0">
        <retornoEvento Id="'.$coluna[0].'">
        <ideEmpregador>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[1]).'</nrInsc>
        </ideEmpregador>
        <recepcao>
        <tpAmb>1</tpAmb>
        <dhRecepcao>2019-04-04T13:52:23.66</dhRecepcao>
        <versaoAppRecepcao>0.1.0-A0316</versaoAppRecepcao>
        <protocoloEnvioLote>'.$coluna[5].'</protocoloEnvioLote>
        </recepcao>
        <processamento>
        <cdResposta>201</cdResposta>
        <descResposta>Sucesso.</descResposta>
        <versaoAppProcessamento>10.0.1-A3184</versaoAppProcessamento>
        <dhProcessamento>2019-04-04T13:52:26.177</dhProcessamento>
        </processamento>
        <recibo>
        <nrRecibo>'.$coluna[5].'</nrRecibo>
        <hash>POlAIBlHYU0xgYFC4AzEt2CntJmteqOuGfsJ0xOIse0=</hash>
        </recibo>
        </retornoEvento>
        <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
        <SignedInfo>
        <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        <SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
        <Reference URI="">
        <Transforms>
        <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
        <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        </Transforms>
        <DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
        <DigestValue>dFalR8hJ9bD5zxHM5xEzLGyIn4wlStfn4f/GfEK/QzE=</DigestValue>
        </Reference>
        </SignedInfo>
        <SignatureValue>
        ZCpb3WFYEySYts0BsuBDkS6qbzid6kvultFVtH306lH4UWAZ3ZMDp8p0/rrSEPoTGinCwfJ5yak0AstIDK+TkbyG+StH+cJ5D0oyM03h+hwET3kE1A7li2gdRYMqvcswm0P4MPmCOlqr+orVheEm0I7VUym1ZarHNyQtIeECSsj7gUy/Atpz2G7hHkha/oV5ruEeEMFydgcr3HCSHzXIi3ruPfY6ifh2GALtf3ApzHmFuX3qmeUt+8kKKjD9k6YQRX2q23PduuBKeDobNRke+7UpK08ip+Cvk1IaddE8F+RnSalGTY5KkyPliRleyrd4L9+IeA18Gip+vTy3R7suIg==
        </SignatureValue>
        <KeyInfo>
        <X509Data>
        <X509Certificate>
        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
        </X509Certificate>
        </X509Data>
        </KeyInfo>
        </Signature>
        </eSocial>

    ';

    $montar_xml = fopen("../output/s1210_retorno_".rand(0, 99999999999999).".xml", "w");
    fwrite($montar_xml, $xml);
}

function montarXml2200Envio($coluna)
{
    $coluna[8] = @date_format(date_create($coluna[8]), "Y-m-d");
    $coluna[17] = @date_format(date_create($coluna[17]), "Y-m-d");
    $coluna[19] = @date_format(date_create($coluna[19]), "Y-m-d");

    $xml = '
        <eSocial xmlns="http://www.esocial.gov.br/schema/evt/evtAdmissao/v02_04_01">
        <evtAdmissao Id="'.$coluna[0].'">
        <ideEvento>
        <indRetif>1</indRetif>
        <tpAmb>1</tpAmb>
        <procEmi>1</procEmi>
        <verProc>METADADOS 4.22.4.2</verProc>
        </ideEvento>
        <ideEmpregador>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[1]).'</nrInsc>
        </ideEmpregador>
        <trabalhador>
        <cpfTrab>'.$coluna[3].'</cpfTrab>
        <nisTrab>'.$coluna[4].'</nisTrab>
        <nmTrab>'.$coluna[22].'</nmTrab>
        <sexo>'.$coluna[5].'</sexo>
        <racaCor>1</racaCor>
        <estCiv>'.$coluna[6].'</estCiv>
        <grauInstr>'.$coluna[7].'</grauInstr>
        <nascimento>
        <dtNascto>'.$coluna[8].'</dtNascto>
        <codMunic>'.$coluna[9].'</codMunic>
        <uf>'.$coluna[11].'</uf>
        <paisNascto>105</paisNascto>
        <paisNac>105</paisNac>
        <nmMae>'.$coluna[23].'</nmMae>
        <nmPai>'.$coluna[12].'</nmPai>
        </nascimento>
        <documentos>
        <CTPS>
        <nrCtps>'.$coluna[13].'</nrCtps>
        <serieCtps>'.$coluna[14].'</serieCtps>
        <ufCtps>'.$coluna[15].'</ufCtps>
        </CTPS>
        <RG>
        <nrRg>'.$coluna[16].'</nrRg>
        <orgaoEmissor>SJS/RS</orgaoEmissor>
        <dtExped>'.$coluna[17].'</dtExped>
        </RG>
        </documentos>
        <endereco>
        <brasil>
        <tpLograd>R</tpLograd>
        <dscLograd>LIBERATO SALZANO</dscLograd>
        <nrLograd>108</nrLograd>
        <complemento>N/A</complemento>
        <bairro>CENTRO</bairro>
        <cep>99690000</cep>
        <codMunic>4303905</codMunic>
        <uf>RS</uf>
        </brasil>
        </endereco>
        <infoDeficiencia>
        <defFisica>N</defFisica>
        <defVisual>N</defVisual>
        <defAuditiva>N</defAuditiva>
        <defMental>N</defMental>
        <defIntelectual>N</defIntelectual>
        <reabReadap>N</reabReadap>
        <infoCota>N</infoCota>
        </infoDeficiencia>
        <dependente>
        <tpDep>00</tpDep>
        <nmDep>N/A</nmDep>
        <dtNascto>0000-00-00</dtNascto>
        <depIRRF>N</depIRRF>
        <depSF>S</depSF>
        <incTrab>N</incTrab>
        </dependente>
        <contato>
        <foneAlternat>000000000</foneAlternat>
        <emailPrinc>AREZZO@SCHUTZ.COM.BR</emailPrinc>
        <emailAlternat>AREZZO@SCHUTZ.COM.BR</emailAlternat>
        </contato>
        </trabalhador>
        <vinculo>
        <matricula>'.$coluna[18].'</matricula>
        <tpRegTrab>1</tpRegTrab>
        <tpRegPrev>1</tpRegPrev>
        <cadIni>S</cadIni>
        <infoRegimeTrab>
        <infoCeletista>
        <dtAdm>'.$coluna[19].'</dtAdm>
        <tpAdmissao>'.$coluna[20].'</tpAdmissao>
        <indAdmissao>'.$coluna[21].'</indAdmissao>
        <tpRegJor>1</tpRegJor>
        <natAtividade>1</natAtividade>
        <cnpjSindCategProf>88063334000155</cnpjSindCategProf>
        <FGTS>
        <opcFGTS>1</opcFGTS>
        <dtOpcFGTS>2006-12-06</dtOpcFGTS>
        </FGTS>
        </infoCeletista>
        </infoRegimeTrab>
        <infoContrato>
        <codCargo>SIRH.0748.16106030</codCargo>
        <codFuncao>SIRH.0748.01800000</codFuncao>
        <codCateg>101</codCateg>
        <remuneracao>
        <vrSalFx>4294.16</vrSalFx>
        <undSalFixo>5</undSalFixo>
        </remuneracao>
        <duracao>
        <tpContr>1</tpContr>
        </duracao>
        <localTrabalho>
        <localTrabGeral>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[24]).'</nrInsc>
        </localTrabGeral>
        </localTrabalho>
        <horContratual>
        <qtdHrsSem>44</qtdHrsSem>
        <tpJornada>1</tpJornada>
        <tmpParc>0</tmpParc>
        <horario>
        <dia>1</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        </horario>
        <horario>
        <dia>2</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        </horario>
        <horario>
        <dia>3</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        </horario>
        <horario>
        <dia>4</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        </horario>
        <horario>
        <dia>5</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        </horario>
        </horContratual>
        <filiacaoSindical>
        <cnpjSindTrab>88063458000130</cnpjSindTrab>
        </filiacaoSindical>
        </infoContrato>
        <sucessaoVinc>
        <cnpjEmpregAnt>16590234002039</cnpjEmpregAnt>
        <matricAnt>786</matricAnt>
        <dtTransf>2017-08-01</dtTransf>
        </sucessaoVinc>
        </vinculo>
        </evtAdmissao>
        <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
        <SignedInfo>
        <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        <SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
        <Reference URI="">
        <Transforms>
        <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
        <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        </Transforms>
        <DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
        <DigestValue>Yy0zeSz2VKABpnhyb+ouWuN6QNgZqdSTNyZWbNn8e48=</DigestValue>
        </Reference>
        </SignedInfo>
        <SignatureValue>
        fBOU234v/v3abZdhl78tYM4Zp+krpQ6+IeEROZiedBAgTj3U/w9YEgTMOt79oyN9RxRFMaFz5fiACXM4JU88VSaLbtWcOnOxZk8VMDiMbg+z+CkvwUOJdgZR1YA4Zkcjp80CZyWcjC3BeoDLd7jL15m+D7XTYEsaxEK5F/pXcS1fd12n+0SbMQ8WFHQV2z1cQSf7K57eIrwVfu4fbflELa7l7YUolBWzYRt/zOSdSbtA4TLyo4pakjni28OzL4lJrNGt8urKGHHmBoGjJEpJr4/ZMWSEcZFh/VKopbU2Ivn3EkqQPlXAhwHq89nHQdcXuamShgKAJqda+4A7qFs4Tg==
        </SignatureValue>
        <KeyInfo>
        <X509Data>
        <X509Certificate>
        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
        </X509Certificate>
        </X509Data>
        </KeyInfo>
        </Signature>
        </eSocial>
    ';

    $montar_xml = fopen("../output/s2200_envio_".rand(0, 99999999999999).".xml", "w");
    fwrite($montar_xml, $xml);
}

function montarXml2200Retorno($coluna)
{
    $coluna[8] = @date_format(date_create($coluna[8]), "Y-m-d");
    $coluna[17] = @date_format(date_create($coluna[17]), "Y-m-d");
    $coluna[19] = @date_format(date_create($coluna[19]), "Y-m-d");

    $xml = '
        <eSocial xmlns="http://www.esocial.gov.br/schema/evt/retornoEvento/v1_2_0">
        <retornoEvento Id="'.$coluna[0].'">
        <ideEmpregador>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[1]).'</nrInsc>
        </ideEmpregador>
        <recepcao>
        <tpAmb>1</tpAmb>
        <dhRecepcao>2018-03-08T18:16:09.147</dhRecepcao>
        <versaoAppRecepcao>0.1.0-A0280</versaoAppRecepcao>
        <protocoloEnvioLote>1.1.201803.0000000000003759417</protocoloEnvioLote>
        </recepcao>
        <processamento>
        <cdResposta>201</cdResposta>
        <descResposta>Sucesso.</descResposta>
        <versaoAppProcessamento>8.0.1-A2842</versaoAppProcessamento>
        <dhProcessamento>2018-03-08T18:16:19.2</dhProcessamento>
        </processamento>
        <recibo>
        <nrRecibo>'.$coluna[2].'</nrRecibo>
        <hash>Yy0zeSz2VKABpnhyb+ouWuN6QNgZqdSTNyZWbNn8e48=</hash>
        <contrato>
        <ideEmpregador>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[1]).'</nrInsc>
        </ideEmpregador>
        <trabalhador>
        <cpfTrab>'.$coluna[3].'</cpfTrab>
        <nisTrab>'.$coluna[4].'</nisTrab>
        <nmTrab>'.$coluna[22].'</nmTrab>
        </trabalhador>
        <infoDeficiencia>
        <infoCota>N</infoCota>
        </infoDeficiencia>
        <vinculo>
        <matricula>'.$coluna[18].'</matricula>
        </vinculo>
        <infoCeletista>
        <dtAdm>'.$coluna[19].'</dtAdm>
        <tpRegJor>1</tpRegJor>
        <cnpjSindCategProf>88063334000155</cnpjSindCategProf>
        </infoCeletista>
        <infoContrato>
        <cargo>
        <codCargo>SIRH.0748.16106030</codCargo>
        <nmCargo>ANALISTA DE CUSTO</nmCargo>
        <codCBO>252210</codCBO>
        </cargo>
        <funcao>
        <codFuncao>SIRH.0748.01800000</codFuncao>
        <dscFuncao>ANALISTA DE CUSTO</dscFuncao>
        <codCBO>252210</codCBO>
        </funcao>
        <codCateg>101</codCateg>
        </infoContrato>
        <remuneracao>
        <vrSalFx>4294.16</vrSalFx>
        <undSalFixo>5</undSalFixo>
        </remuneracao>
        <duracao>
        <tpContr>1</tpContr>
        </duracao>
        <localTrabGeral>
        <tpInsc>1</tpInsc>
        <nrInsc>'.trim($coluna[24]).'</nrInsc>
        <cnae>1531901</cnae>
        </localTrabGeral>
        <horContratual>
        <qtdHrsSem>44</qtdHrsSem>
        <tpJornada>1</tpJornada>
        <tmpParc>0</tmpParc>
        <horario>
        <dia>1</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        <hrEntr>0730</hrEntr>
        <hrSaida>1748</hrSaida>
        <durJornada>528</durJornada>
        <perHorFlexivel>S</perHorFlexivel>
        <horarioIntervalo>
        <tpInterv>2</tpInterv>
        <durInterv>90</durInterv>
        <iniInterv>0000</iniInterv>
        <termInterv>0000</termInterv>
        </horarioIntervalo>
        </horario>
        <horario>
        <dia>2</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        <hrEntr>0730</hrEntr>
        <hrSaida>1748</hrSaida>
        <durJornada>528</durJornada>
        <perHorFlexivel>S</perHorFlexivel>
        <horarioIntervalo>
        <tpInterv>2</tpInterv>
        <durInterv>90</durInterv>
        <iniInterv>0000</iniInterv>
        <termInterv>0000</termInterv>
        </horarioIntervalo>
        </horario>
        <horario>
        <dia>3</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        <hrEntr>0730</hrEntr>
        <hrSaida>1748</hrSaida>
        <durJornada>528</durJornada>
        <perHorFlexivel>S</perHorFlexivel>
        <horarioIntervalo>
        <tpInterv>2</tpInterv>
        <durInterv>90</durInterv>
        <iniInterv>0000</iniInterv>
        <termInterv>0000</termInterv>
        </horarioIntervalo>
        </horario>
        <horario>
        <dia>4</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        <hrEntr>0730</hrEntr>
        <hrSaida>1748</hrSaida>
        <durJornada>528</durJornada>
        <perHorFlexivel>S</perHorFlexivel>
        <horarioIntervalo>
        <tpInterv>2</tpInterv>
        <durInterv>90</durInterv>
        <iniInterv>0000</iniInterv>
        <termInterv>0000</termInterv>
        </horarioIntervalo>
        </horario>
        <horario>
        <dia>5</dia>
        <codHorContrat>SIRH.0748.4029</codHorContrat>
        <hrEntr>0730</hrEntr>
        <hrSaida>1748</hrSaida>
        <durJornada>528</durJornada>
        <perHorFlexivel>S</perHorFlexivel>
        <horarioIntervalo>
        <tpInterv>2</tpInterv>
        <durInterv>90</durInterv>
        <iniInterv>0000</iniInterv>
        <termInterv>0000</termInterv>
        </horarioIntervalo>
        </horario>
        </horContratual>
        </contrato>
        </recibo>
        </retornoEvento>
        <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
        <SignedInfo>
        <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        <SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
        <Reference URI="">
        <Transforms>
        <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
        <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        </Transforms>
        <DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
        <DigestValue>ubXv3Yo8V4huQXAvThly+o2ZjhzgAR9dVHRRjmgzvlw=</DigestValue>
        </Reference>
        </SignedInfo>
        <SignatureValue>
        H+nQuOtBBbJxF43AlOyG9bFrLiWFX9mD3OD+D2T0XQNqnkpdbw4czxTt/QC5kvZLqNHeM5ORMrLzSR2VmaMRwmMxlSLknXkitlkOqR+UNHxWHkvAHu9Ww3Gxka3RuTydIR4wzhQ5c2KLkJMW0qxxwgD5iFYS7p4SapNRsC3P0oP1UxKlknFc06rv60ieTsZgIhOnYigQp7/xdXfteLlYHi0cCdpW1Sn2pyUMads8YH3Ev36yV1T9b8w80u2GMKYvZ2dbs9UmljgU0+2CSQ5bRuqyOsNShSRYj0ijABDhzhht0A414ttb/uSGlRx7UkNBr7tyTJK7Pf7bVbdYl1B8qA==
        </SignatureValue>
        <KeyInfo>
        <X509Data>
        <X509Certificate>
        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
        </X509Certificate>
        </X509Data>
        </KeyInfo>
        </Signature>
        </eSocial>
    ';

    $montar_xml = fopen("../output/s2200_retorno_".rand(0, 99999999999999).".xml", "w");
    fwrite($montar_xml, $xml);
}