const Temas = document.querySelector('#tema')
const formulario = document.querySelector('form');
const buttonModificar = document.querySelector('#btnModificar')
const buttonGuardar = document.querySelector('#btnGuardar')
const buttonLimpiar = document.querySelector('#btnLimpiar')






const iniciarModulo = (e) => {
    generarTabla();
    selectTemas();
    buttonModificar.parentElement.style.display = 'none'
    buttonModificar.disabled = true
}


// FUNCION PARA HACER SELECT
const selectTemas = async () => {
    const select = document.querySelector('#tema');
    const url = "../API/temas/buscar.php";
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
            option.innerText = d.nombre;
            option.value = d.id;
            select.appendChild(option);
        })
        
    } catch (error) {
        console.log(error);
    }
}




const guardarSubtema = async (e) => {
    e && e.preventDefault();
    if(!validarFormulario(formulario, ['id'])){
        alertToast('warning', 'Debe llenar todos los campos');
        return;
    }
    const body = new FormData(formulario);
    body.delete('id');
    const url = "../API/subtemas/guardar.php";
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


// buscar tabla 

const generarTabla = async(e) => {
    const url = "../API/subtemas/buscar.php";
    const config = {
        method : 'GET'
    }
    try {
        const response = await fetch(url,config);
        const data = await response.json();
        // console.log(data);
        $("#tablaTemas").DataTable().destroy();
        let tabla = $("#tablaTemas").DataTable({
            language : lenguaje,
            data : data,
            columns : [
                {data : "contador", "width" : "5%"},
                {data : "tema"},
                {data : "nombre"},
                {
                    data : "id",
                    "render" : (data , type, row, meta) => `<button class='btn btn-warning' onclick='traerInformacion(${JSON.stringify(row)})'><i class="bi bi-pencil-square me-2"></i>Editar</button>`,
                    "width" : "20%"
                },
                {
                    data : "id",
                    "render" : data => `<button class='btn btn-danger' onclick='confirmarBorrado(${data}, 1)'><i class="bi bi-trash me-2"></i>Eliminar</button>`,
                    "width" : "20%"
                },
            ],
    
        })
                
    } catch (error) {
        console.log(error);
    }
}



const traerInformacion = (data) => {
    formulario.id.value = data.id;
    formulario.tema.value = data.tema;
    formulario.nombre.value = data.nombre;
    buttonModificar.parentElement.style.display = ''
    buttonModificar.disabled = false
    buttonGuardar.parentElement.style.display = 'none'
    buttonGuardar.disabled = true
    buttonLimpiar.parentElement.style.display = 'none'
    buttonLimpiar.disabled = true
}




const modificarSubtema = async (e) => {
    e &&  e.preventDefault();
    if(!validarFormulario(formulario)){
        alertToast('warning', 'Debe llenar todos los campos');
        return;
    }
    const body = new FormData(formulario);
    const url = "../API/subtemas/modificar.php";
    const config = {
        method : 'POST',
        body
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        if(data.resultado){
            alertToast('success','Información guardada');
            limpiar(formulario);
            generarTabla();
            buttonModificar.parentElement.style.display = 'none'
            buttonModificar.disabled = true
            buttonGuardar.parentElement.style.display = ''
            buttonGuardar.disabled = false
            buttonLimpiar.parentElement.style.display = ''
            buttonLimpiar.disabled = false
        }else{
            console.log(data.error);
            alertToast('error','Ocurrió un error');

        }
        
    } catch (error) {
        console.log(error);
    }
}


const eliminarRegistro = async (id) => {
    const body = new FormData();
    body.append('id', id);
    const url = "../API/subtemas/eliminar.php";
    const config = {
        method : 'POST',
        body
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        console.log(data);
        if(data.resultado){
            alertToast('success','Información eliminada');
            generarTabla();
        }else{
            alertToast('error','Ocurrió un error');

        }
        
    } catch (error) {
        console.log(error);
    }
}

iniciarModulo();
formulario.addEventListener('submit', guardarSubtema);
buttonModificar.addEventListener('click', modificarSubtema)
buttonLimpiar.addEventListener('click', limpiar(formulario))
