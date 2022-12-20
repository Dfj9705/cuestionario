const formulario = document.querySelector('#formCorreo');
const modalCorreo = new bootstrap.Modal(document.getElementById('modalCorreo'))
const generarTabla = async(e) => {
    const url = "../API/usuarios/usuarios.php";
    const config = {
        method : 'GET'
    }
    try {
        const response = await fetch(url,config);
        const data = await response.json();
        console.log(data);
        $("#tablaTemas").DataTable().destroy();
        let tabla = $("#tablaTemas").DataTable({
            language : lenguaje,
            data : data,
            columns : [
                {data : "contador", "width" : "5%"},
                {data : "nombre"},
                {data : "catalogo"},
                {data : "correo"},
                {
                    data : "id",
                    "render" : data => `
                    <div class='btn-group'>
                        <button class='btn btn-info' onclick='generartoken(${data})'><i class="bi bi-pencil-square me-2"></i>Generar enlace</button>
                        <button class='btn btn-warning' onclick='asignarId(${data})' data-bs-target='#modalCorreo' data-bs-toggle='modal'><i class="bi bi-envelope me-2"></i>Cambiar correo</button>
                        <button class='btn btn-danger' onclick='confirmarBorrado(${data}, 1)'><i class="bi bi-trash me-2"></i>Desactivar</button>
                    </div>
                        `,
                    "width" : "40%"
                },
            ],
    
        })
        
        
    } catch (error) {
        console.log(error);
    }
}

const generartoken = async ( id ) => {
    const body = new FormData();
    body.append('id', id)
    const url = "../API/usuarios/enlace.php";
    const config = {
        method : 'POST',
        body
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        console.log(data);

        if(data.token){

            Swal.fire({
                title: 'ENLACE GENERADO',
                text: location.protocol + '//' + location.host + '/CIBERCUESTIONARIO/cp_login/password.php?token=' + data.token,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Entendido',
            })
            // console.log(); 
            
        }else{

        }
        
 
    } catch (error) {
        console.log(error);
    }
}

const asignarId = id => {
    document.querySelector('#id').value = id;
}

const cambiarCorreo = async (e) => {
    e && e.preventDefault();
    if(!validarFormulario(formulario)){
        alertToast('warning', 'Debe llenar todos los campos');
        return;
    }
    const body = new FormData(formulario);
    const url = "../API/usuarios/correo.php";
    const config = {
        method : 'POST',
        body
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        console.log(data);
        if(data.mensaje){
            alertToast('warning', data.mensaje );

        }else if (data.resultado){
            alertToast('success', 'CORREO ACTUALIZADO' );
            limpiar(formulario);
            generarTabla();
            modalCorreo.hide();
        }else{
            alertToast('error','Ocurrió un error');

        }
        
    } catch (error) {
        console.log(error);
    }
}

const eliminarRegistro = async id => {
    // console.log(id);

    const body = new FormData();
    body.append('id', id )
    const url = "../API/usuarios/desactivar.php";
    const config = {
        method : 'POST',
        body
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        console.log(data);
        if (data.resultado){
            alertToast('success', 'USUARIO DESACTIVADO' );
            generarTabla();
        }else{
            alertToast('error','Ocurrió un error');

        }
        
    } catch (error) {
        console.log(error);
    }
}

generarTabla();
formulario.addEventListener('submit', cambiarCorreo);