const formulario = document.querySelector('form');

const registro = async (e) => {
    e && e.preventDefault();
    if(!validarFormulario(formulario)){
        alertToast('warning', 'Debe llenar todos los campos');
        return;
    }
    const body = new FormData(formulario);
    const url = "../API/usuarios/reestablecer.php";
    const config = {
        method : 'POST',
        body
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        console.log(data);


        if(data.errores){
            data.errores.forEach(error => {
                document.getElementById(error).classList.add('is-invalid');
                alertToast('warning','Revise la información ingresada');
            });
        }else if ( data.error ){
            console.log(error);
            alertToast('error','Ocurrió un error');

        }else if ( data.token ){

            alertToast('info',data.token);
        }else if( data.exito ){
            Swal.fire({
                title: 'REGISTRO CREADO',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Entendido',
            }).then((result) => {
                location.href = 'login.php';
            })
        }
    
        
    } catch (error) {
        console.log(error);
    }
}

formulario.addEventListener('submit', registro )