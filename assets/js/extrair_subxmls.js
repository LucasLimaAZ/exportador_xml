$("#importar").click(() => {

    $("#loader").show()

    if($("#arquivo_lote").val() == ''){
        alert('Nenhum arquivo selecionado!')
        return
    }

    let arquivo = lerArquivo()

    $.ajax({
        url: 'app/extrairLote.php',
        type: 'post',
        data: arquivo,
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

function lerArquivo()
{
    let fd = new FormData()
    let files = $('#arquivo_lote')[0].files
    let quantidade = files.length
    
    for(i = 0; i < quantidade; i ++){
        fd.append(`arquivo-${i}`,files[i])
    }

    return fd
}