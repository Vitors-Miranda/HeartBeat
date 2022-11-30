const loginlink = "http://"+EnderecoLink+"public_html/api/login/"
function requisitarLogin(metodo, dados, funcao) {
    fetch(loginlink, {
        method: metodo,
        body: dados
    }).then(respostaLogin => respostaLogin.json()).then(
        (respostaLogin) => {
            funcao(respostaLogin)
        }
    )
}
const formularioLogin = document.querySelector("#formlogin")

formularioLogin.addEventListener("submit", (evento) => {
    evento.preventDefault();
    let dadosLogin = new FormData(formularioLogin);
    requisitarLogin("POST", dadosLogin, (respostaLogin) => {

        if (respostaLogin.data.login == 1) {
            window.location.href = "home.html"
        } else {
            console.log(respostaLogin.data)
            toastbody.innerHTML = respostaLogin.data
            toastElement.show()
        }

        formularioLogin.reset()
    })
});