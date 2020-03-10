$("#botao-converter").click(() => {

    let dados = $("#converter").serialize()

    $("#loader").show()

    if($("#arquivo_importado").val() == ''){
        alert('Nenhum arquivo selecionado!')
        return
    }

    fd = lerArquivo()
    fd.append("dados", dados)

    $.ajax({
        url: 'app/montador_xml.php',
        type: 'post',
        data: fd,
        dataType: 'json',
        contentType: false,
        processData: false,
    })
    .done(() => {
        exibirSucesso()
    })
    .fail(() => {
        exibirFalha()
    })
    .always(() => {
        $("#loader").hide()
    })

})

function lerArquivo()
{
    let fd = new FormData()
    let files = $('#arquivo_importado')[0].files
    let quantidade = files.length
    
    for(i = 0; i < quantidade; i ++){
        fd.append(`arquivo-${i}`,files[i])
    }

    return fd
}

function exibirSucesso()
{
    $("#sucesso").fadeToggle(300)
    $("#erro").hide()

        window.setTimeout(() => {
            $("#sucesso").fadeToggle(300)

    }, 1500)
}

function exibirFalha()
{
    $("#erro").fadeToggle(300)
    $("#sucesso").hide()

        window.setTimeout(() => {
            $("#erro").fadeToggle(300)

    }, 1500)
}