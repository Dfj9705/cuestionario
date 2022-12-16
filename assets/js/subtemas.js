const formulario = document.querySelector('form');



const iniciarModulo = (e) => {
    generarTabla();
    buttonModificar.parentElement.style.display = 'none'
    buttonModificar.disabled = true
}