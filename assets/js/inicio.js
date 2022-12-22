const buttonInicio = document.getElementById('btnInicio');
const divTabla = document.getElementById('divTabla');

const getModulos = async () => {
    const url = "../API/evaluaciones/inicio.php";
    const config = {
        method : 'GET'
    }

    try {
        const response = await fetch(url,config);
        const data = await response.json();
        
        if(data.MODULO){
            // console.log(data.MODULO);

            location.href = `evaluacion.php`

        }else{
            alertToast('error', 'ERROR AL INICIAR EVALUACIÓN');
        }
        
    } catch (error) {
        console.log(error);
    }
}

buttonInicio.addEventListener('click', getModulos);
// divTabla.style.display = 'none';