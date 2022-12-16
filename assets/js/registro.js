const formulario = document.querySelector('form');

const registro = async (e) => {
    e && e.preventDefault();
    if(!validarFormulario(formulario)){
        alertToast('warning', 'Debe llenar todos los campos');
        return;
    }
    const body = new FormData(formulario);
    const url = "../API/login/registro.php";
    const config = {
        method : 'POST',
        body
    }

    // try {
    //     const response = await fetch(url,config);
    //     const data = await response.json();
    //     console.log(data);
    //     if(data.resultado){
    //         alertToast('success','Información guardada');
    //         limpiar(formulario);
    //         generarTabla();
    //     }else{
    //         alertToast('error','Ocurrió un error');

    //     }
        
    // } catch (error) {
    //     console.log(error);
    // }
}

formulario.addEventListener('submit', registro )