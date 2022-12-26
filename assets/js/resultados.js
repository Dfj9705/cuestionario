const tableResultados = document.querySelector('#tableResultados')
const tableBody = document.querySelector('#tableBody')
const tbodyDetalle = document.querySelector('#tbodyDetalle')
const btnImprimir  = document.querySelector('#btnImprimir')
const modalElement = document.getElementById('modalDetalle')
const modalDetalle = new bootstrap.Modal(modalElement)
const loaderResultados = document.getElementById('loaderResultados')

const getResultados = async () => {
    const url = "../API/evaluaciones/resultados.php";
    const config = {
        method : 'GET'
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        tableBody.innerHTML = '';
        let modulo = 1;
        let imprimir = [];
        data.forEach(d => {
            let fila = tableBody.insertRow();
            let celda1 = fila.insertCell();
            celda1.innerText = d.tema
            let celda2 = fila.insertCell();
            celda2.innerText = d.preguntas
            let celda3 = fila.insertCell();
            celda3.innerText = d.correctas
            let celda4 = fila.insertCell();
            celda4.innerText = d.incorrectas
            let celda5 = fila.insertCell();
         
            let celda6 = fila.insertCell();
            let buttonDetalle = document.createElement('button')
            buttonDetalle.classList.add('btn','btn-info')
            buttonDetalle.innerHTML = '<i class="bi bi-file-ruled"></i>'
            buttonDetalle.setAttribute('data-bs-target','#modalDetalle')
            buttonDetalle.setAttribute('data-bs-toggle','modal')
            buttonDetalle.dataset.tema = d.tema
            buttonDetalle.dataset.id = d.id
            celda6.appendChild(buttonDetalle)

            let celda7 = fila.insertCell();
            let buttonRepetir = document.createElement('button')
            buttonRepetir.classList.add('btn','btn-warning')
            buttonRepetir.innerHTML = '<i class="bi bi-arrow-repeat"></i>'
            // buttonRepetir.dataset.modulo = modulo
            buttonRepetir.addEventListener('click', repetirEvaluacion.bind(this, modulo, d.id)
            )
            celda7.appendChild(buttonRepetir)


            // if(d.correctas == 0 && d.incorrectas == 0){
                
            // }
            let total = parseInt(d.correctas) + parseInt(d.incorrectas);
            let porcentaje = d.correctas * 100 / 5;

            if(total >= 5 && porcentaje >= 60){
                celda5.innerHTML = `<span class="text-success">APROBADO</span>`
                imprimir = [...imprimir, true]
                // buttonRepetir.disabled = true
                // buttonRepetir.title = 'DEBE INICIAR LA EVALUACIÓN'
            }else if(d.correctas == 0 && d.incorrectas == 0){
                
                celda5.innerHTML = `<span class="text-info">NO INICIADO</span>`
                imprimir = [...imprimir, false]
                buttonDetalle.disabled = true
                buttonDetalle.title = 'DEBE INICIAR LA EVALUACIÓN'
                buttonRepetir.disabled = true
                buttonRepetir.title = 'DEBE INICIAR LA EVALUACIÓN'
            }else{
                
                celda5.innerHTML = `<span class="text-danger">REPROBADO</span>`
                imprimir = [...imprimir, false]
            }

            modulo++;
        });

        if(!imprimir.includes(false)){
            btnImprimir.style.display = ''
            btnImprimir.disabled = false
            btnImprimir.href = `certificado.php`
        }else{
            btnImprimir.style.display = 'none'
            btnImprimir.disabled = true
        }
        // if(data){
          

        // }else{
        //     alertToast('error', 'ERROR AL INICIAR EVALUACIÓN');
        // }
       
    } catch (error) {
        console.log(error);
    }
}

modalElement.addEventListener('show.bs.modal', async event => {
    const tema = event.relatedTarget.dataset.tema;
    const id = event.relatedTarget.dataset.id;
    
    document.getElementById('infomodalDetalle').innerText = `DETALLE DE EVALUACIÓN ${tema}`

    const url = `../API/evaluaciones/detalle.php?id=${id}`;
    const config = {
        method : 'GET'
    }

    tbodyDetalle.innerHTML = '';
    loaderResultados.style.display = ''
    
    try {
        const response = await fetch(url,config);
        const data = await response.json();
        data.forEach(d => {
            let fila = tbodyDetalle.insertRow();
            let celda1 = fila.insertCell();
            celda1.innerText = d.pregunta
            let celda2 = fila.insertCell();
            celda2.classList.add('text-center')
            celda2.innerHTML = d.correcta == d.seleccionada ? '<i class="bi bi-check-circle text-success"></i>' :'<i class="bi bi-x-circle text-danger"></i>'
        });
        loaderResultados.style.display = 'none'
    } catch (error) {
        console.log(error);
    }

})

const repetirEvaluacion = async (modulo, id, event) => {
    // const modulo = event.target.dataset.modulo;
    const url = `../API/evaluaciones/repetir.php?modulo=${modulo}&tema=${id}`;
    const config = {
        method : 'GET'
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        console.log(data);
        if(data){
           
            location.href = `evaluacion.php`

            

        }else{
            alertToast('error', 'ERROR AL INICIAR EVALUACIÓN');
        }
        
    } catch (error) {
        console.log(error);
    }
} 

getResultados();
btnImprimir.style.display = 'none'
btnImprimir.disabled = true