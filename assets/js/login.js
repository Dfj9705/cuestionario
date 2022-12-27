const formulario = document.querySelector('form');

const registro = async (e) => {
    e && e.preventDefault();
    if(!validarFormulario(formulario)){
        alertToast('warning', 'Debe llenar todos los campos');
        return;
    }
    const body = new FormData(formulario);
    const url = "../API/usuarios/login.php";
    const config = {
        method : 'POST',
        body
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        // console.log(data);
        
        if(data.mensaje){
            alertToast('warning', data.mensaje);
        }else if(data.exito){
            Swal.fire({
                title: 'INICIO DE SESIÓN EXITOSO',
                text: data.exito,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Entendido',
            }).then((result) => {
                location.href = '../cp_menu/menu.php';
            })
        }else{
            console.log(data);
            
        }
 
    } catch (error) {
        console.log(error);
    }
}

formulario.addEventListener('submit', registro )