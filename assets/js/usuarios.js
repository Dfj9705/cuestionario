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
                        <button class='btn btn-warning' onclick='confirmarBorrado(${data}, 1)'><i class="bi bi-envelope me-2"></i>Cambiar correo</button>
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

generarTabla();