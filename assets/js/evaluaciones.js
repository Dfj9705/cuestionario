const modalElement = document.getElementById('modalEvaluacion')
const modalEvaluacion = new bootstrap.Modal(modalElement)
const carouselElement = document.querySelector('#carouselEvaluacion')
const buttonFinalizar = document.querySelector('#buttonFinalizar')
const buttonSiguiente = document.querySelector('#buttonSiguiente')
const buttonAnterior = document.querySelector('#buttonAnterior')
const formCarousel = document.querySelector('#formCarousel');
const loaderPreguntas = document.querySelector('#loaderPreguntas');

const carousel = new bootstrap.Carousel(carouselElement, {
  interval: 1000,
  ride: true,
  touch : false,
  keyboard: false,
  pause: false,
  wrap: false
})

carousel.to(0);
carousel.pause();
buttonFinalizar.style.display = 'none'
buttonAnterior.style.display = 'none'
buttonSiguiente.style.display = ''
console.log(carousel);


const getPreguntas = async () => {
    const url = "../API/evaluaciones/preguntas.php";
    const config = {
        method : 'GET'
    }
    try {
        const response = await fetch(url,config);
        const data = await response.json();
        // console.log(data);
        // <div class="carousel-item active">
        //     hola 1
        // </div>
        loaderPreguntas.style.display = 'none'
        formCarousel.innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;
        data.forEach(pregunta => {
            const div = document.createElement('div')
            div.classList.add('carousel-item')
            if(contador == 1){
                div.classList.add('active')
            }

            const titulo = document.createElement('h6');
            titulo.textContent = `Pregunta #${contador}`
            
            const p = document.createElement('p')
            p.textContent = pregunta.pregunta;

            const divRespuestas = document.createElement('div');
            console.log(pregunta.respuestas);
            pregunta.respuestas.forEach( r => {
                const divRadio = document.createElement('div')
                divRadio.classList.add('form-check')

                const inputRadio = document.createElement('input');
                inputRadio.type = 'radio'
                inputRadio.name = `respuesta${pregunta.id}`; 
                inputRadio.id = `respuesta${r.id}`; 
                inputRadio.value = r.id;
                inputRadio.classList.add('form-check-input')

                const label = document.createElement('label');
                label.htmlFor = `respuesta${r.id}`;
                label.textContent = r.respuesta
                label.classList.add('form-check-label')

                divRadio.appendChild(inputRadio)
                divRadio.appendChild(label)

                divRespuestas.appendChild(divRadio)
            });

            div.appendChild(titulo);
            div.appendChild(p);
            div.appendChild(divRespuestas)

            fragment.appendChild(div)
            contador ++
        });
        formCarousel.appendChild(fragment)
    } catch (error) {
        console.log(error);
    }
}

const siguientePregunta = async () => {
    carousel.next();
}
const anteriorPregunta = async () => {
    carousel.prev();
}

const finalizarModulo = async e => {
    e && e.preventDefault();
    // console.log(validarFormulario(formCarousel));
    let inputRadios =  document.querySelectorAll('input:checked')
    
    
    if(inputRadios.length < document.querySelectorAll('.carousel-item').length ){
        alertToast('warning', 'Debe seleccionar todas las respuestas');
        return;
    }
    const body = new FormData(formCarousel);
    // body.delete('id');
    const url = "../API/evaluaciones/avanzar.php";
    const config = {
        method : 'POST',
        body
    }

    
        Swal.fire({
            title: 'Confirmación',
            text: '¿Esta seguró que desea enviar la evaluación?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, enviar',
            cancelButtonText: 'No'
        }).then( async (result) => {
            try {
                if (result.value) {
                    const response = await fetch(url,config);
                    const data = await response.json();
                    console.log(data);
                    if(data.mensaje){
                        alertToast('error', data.mensaje)
                    }else if( data.error){
                        alertToast('error', 'OCURRIÓ UN ERROR')
                        console.log(data.error);
                    }else if( data.resultado ){
                        Swal.fire({
                            title: 'Evaluación guardada',
                            text: 'Ha finalizado el módulo ¿Desea avanzar o ver los resultados?',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Avanzar',
                            cancelButtonText: 'Ver resultados'
                        }).then((result) => {
                            if(result.value){
                                location.reload();
                            }else{
                                location.href = 'resultados.php';
                            }
                        })
                    }else{
                        alertToast('error', 'OCURRIÓ UN ERROR')
                    }
                    
                    
                }
            } catch (error) {
                console.log(error);
            }
        })
       
        
   
}

modalElement.addEventListener('show.bs.modal', event => {
    carousel.to(0);
    carousel.pause();
    getPreguntas();
    // console.log(event);

})

carouselElement.addEventListener('slide.bs.carousel', event => {
    // console.log(event);
    if(event.to >= document.querySelectorAll('.carousel-item').length - 1){
        buttonFinalizar.style.display = ''
        buttonSiguiente.style.display = 'none'
        buttonAnterior.style.display = ''
    }else if(event.to == 0 ){
        buttonFinalizar.style.display = 'none'
        buttonSiguiente.style.display = ''
        buttonAnterior.style.display = 'none'
    }else if (event.to > 0){
        buttonAnterior.style.display = ''
        buttonSiguiente.style.display = ''
        buttonFinalizar.style.display = 'none'

    }
})



buttonSiguiente.addEventListener('click', siguientePregunta);
buttonAnterior.addEventListener('click', anteriorPregunta);
formCarousel.addEventListener('submit', finalizarModulo )