const usuarioLink = "http://"+EnderecoLink+"public_html/api/usuario/"
function requisitar(metodo, dados, funcao) {
    fetch(usuarioLink, {
        method: metodo,
        body: dados
    }).then(resposta => resposta.json()).then(
        (retorno) => {
            funcao(retorno)
        }
    )
}

const formulario = document.querySelector("#formcad")

formulario.addEventListener("submit", (evento) => {
    evento.preventDefault();
    let dados = new FormData(formulario)
    requisitar("POST", dados, (retorno) => {
        toastbody.innerHTML = retorno.data
        toastElement.show()
        formulario.reset()
    })
});