const formulario = document.querySelector('form');



const iniciarModulo = (e) => {
    generarTabla();
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
            option.innerText = d.descripcion;
            option.value = d.jerarquia;
            select.appendChild(option);
        })
        
    } catch (error) {
        console.log(error);
    }
}
