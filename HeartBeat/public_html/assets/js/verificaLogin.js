
const loginlink = "http://"+EnderecoLink+"public_html/api/login/"
function requisitarLogin(metodo, funcao) {
    fetch(loginlink, {
        method: metodo
    }).then(respostaLogin => respostaLogin.json()).then(
        (respostaLogin) => {
            funcao(respostaLogin)
        }
    )
}

requisitarLogin("GET", (respostaLogin) => {
    if (respostaLogin.data.login == 1) {
        toastbody.innerHTML = respostaLogin.data.mensagem
        toastElement.show()
    } else {
        window.location.href = "login.html"
    }
})