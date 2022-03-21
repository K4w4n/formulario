const elFormulario = document.querySelector('.formulario');
const elNome = elFormulario.querySelector('#nome');
const elTelefone = elFormulario.querySelector('#telefone');
const elMensagem = elFormulario.querySelector('#mensagem');

elNome.addEventListener('keyup', event => {
    if (event.key === 'Enter') {
        console.log(event.key);
        event.preventDefault();
        elTelefone.focus();
        return false;
    }
});

elTelefone.addEventListener('keyup', event => {
    if (event.key === 'Enter') {
        console.log(event.key);
        event.preventDefault();
        elMensagem.focus();
        return false;
    }
});