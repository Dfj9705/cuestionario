const formulario = document.querySelector('form');
const buttonModificar = document.querySelector('#btnModificar')
const buttonGuardar = document.querySelector('#btnGuardar')
const buttonLimpiar = document.querySelector('#btnLimpiar')


const iniciarModulo = (e) => {
    generarTabla();
    selectSubtemas();
    buttonModificar.parentElement.style.display = 'none'
    buttonModificar.disabled = true
}



const selectSubtemas = async () => {
    const select = document.querySelector('#subtema');
    const url = "../API/subtemas/buscar.php";
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



const guardarPreguntas = async (e) => {
    e && e.preventDefault();
    if(!validarFormulario(formulario, ['id'])){
        alertToast('warning', 'Debe llenar todos los campos');
        return;
    }
    const body = new FormData(formulario);
    body.delete('id');
    const url = "../API/preguntas/guardar.php";
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
            generarTabla();
        }else{
            alertToast('error','Ocurrió un error');

        }
        
    } catch (error) {
        console.log(error);
    }
}





const eliminarRegistro = async (id) => {
    const body = new FormData();
    body.append('id', id);
    const url = "../API/preguntas/eliminar.php";
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




const traerInformacion = (data) => {
    console.log(data)
    formulario.id.value = data.id;
    formulario.subtema.value = data.id_subtema;
    formulario.pregunta.value = data.descripcion;
    buttonModificar.parentElement.style.display = ''
    buttonModificar.disabled = false
    buttonGuardar.parentElement.style.display = 'none'
    buttonGuardar.disabled = true
    buttonLimpiar.parentElement.style.display = 'none'
    buttonLimpiar.disabled = true
}


const modificarPregunta = async (e) => {
    e &&  e.preventDefault();
    if(!validarFormulario(formulario)){
        alertToast('warning', 'Debe llenar todos los campos');
        return;
    }
    const body = new FormData(formulario);
    const url = "../API/preguntas/modificar.php";
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



const generarTabla = async(e) => {
    const url = "../API/preguntas/buscar.php";
    const config = {
        method : 'GET'
    }
    try {
        const response = await fetch(url,config);
        const data = await response.json();
        // console.log(data);
        $("#tablaPreguntas").DataTable().destroy();
        let tabla = $("#tablaPreguntas").DataTable({
            language : lenguaje,
            data : data,
            columns : [
                {data : "contador", "width" : "5%"},
                {data : "descripcion"},
                {data : "subtema"},
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


iniciarModulo()
formulario.addEventListener('submit', guardarPreguntas);
buttonLimpiar.addEventListener('click', limpiar(formulario))
buttonModificar.addEventListener('click', modificarPregunta)
