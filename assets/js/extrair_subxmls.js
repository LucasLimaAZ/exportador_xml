$("#importar").click(() => {

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
    let files = $('#arquivo_lote')[0].files[0]
    fd.append('arquivo',files)
    return fd
}