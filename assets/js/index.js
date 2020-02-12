$("#importar").click(() => {

    if($("#arquivo_importado").val() == ''){
        alert('Nenhum arquivo selecionado!')
        return
    }

    let arquivo = lerArquivo()

    $.ajax({
        url: 'app/varreduraArquivo.php',
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

function lerArquivo()
{
    let fd = new FormData()
    let files = $('#arquivo_importado')[0].files[0]
    fd.append('arquivo',files)
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