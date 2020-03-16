$(document).ready(() => {
    
    $.get("app/listaIds.php", response => {
        ids = JSON.parse(response)

        ids.forEach(id => {
            if(id != '.' && id != '..' && id != '.DS_Store'){
                $("#lista_ids").append(`<li>${id.replace(".xml", "")}</li>`)
            }
        })
    })

})