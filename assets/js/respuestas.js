const formulario = document.querySelector('form');



const iniciarModulo = (e) => {
    // generarTabla();
    selectSubPreguntas();
    // buttonModificar.parentElement.style.display = 'none'
    // buttonModificar.disabled = true
}



const selectSubPreguntas = async () => {
    const select = document.querySelector('#pregunta');
    const url = "../API/preguntas/buscar.php";
    const config = {
        method : 'GET'
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        const option = document.createElement('option');
        option.innerText = "SELECCIONE...";
        option.value = "";
        select.appendChild(option);
        data.forEach(d => {
            const option = document.createElement('option');
            option.innerText = d.descripcion;
            option.value = d.id;
            select.appendChild(option);
         
        })
        
    } catch (error) {
        console.log(error);
    }
}

const guardarRespuestas = async (e) => {
    e && e.preventDefault();
    if(!validarFormulario(formulario, ['id'])){
        alertToast('warning', 'Debe llenar todos los campos');
        return;
    }
    const body = new FormData(formulario);
    body.delete('id');
    const url = "../API/respuestas/guardar.php";
    const config = {
        method : 'POST',
        body
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        console.log(data)
        if(data.resultado){
            alertToast('success','Información guardada');
            limpiar(formulario);
            // generarTabla();
        }else{
            alertToast('error','Ocurrió un error');

        }
        
    } catch (error) {
        console.log(error);
    }
}






iniciarModulo()

formulario.addEventListener('submit', guardarRespuestas);
