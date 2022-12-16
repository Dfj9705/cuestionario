let valideCat = false,
    validecontra = false
  
const getuser= (user)=>{
    let catalogo = document.getElementById("cat_us").value
    if(catalogo.length >= 6){
        
        document.getElementById("contenedor_carga").style.visibility = "visible"
        document.getElementById("contenedor_carga").style.opacity = "1"
        if(catalogo!=''){
            xajax_getUser(catalogo, user)
        }else{
            document.getElementById('nombre').innerText = "INGRESE UN CATÁLOGO"
            document.getElementById("contenedor_carga").style.visibility = "hidden"
            document.getElementById("contenedor_carga").style.opacity = "0"
            valideCat = false
            valideFields()
        }

    }else{
        valideCat = false
        valideFields()
    }
    
}

const soloNumeros=(evt)=>{
    var code = (evt.which) ? evt.which : evt.keyCode;
    if(code==8) 
    {
        return true;
    }
    else if(code>=48 && code<=57) 
    {
        return true;
    }
    else
    {
        return false;
    }
}
const sinSimbolos=(evt)=>{
    var code = (evt.which) ? evt.which : evt.keyCode;
    if((code==8) || (code>=48 && code<=57) || (code>=65 && code<=90) || (code>=97 && code<=122) ) 
    {
        return true;
    }
    else
    {
        return false;
    }
}
//SOLO LETRAS
const soloLetras=(evt)=>{

 
    var code = (evt.which) ? evt.which : evt.keyCode;
    // codigo ASCII para retroceso, espacio,mayusculas, minusculas,Ñ,ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú
    if((code==8) || code == 32 || (code>=65 && code<=90)  || (code>=97 && code<=122) || (code==241) || (code==209) || code == 38) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

const numeroDocumentos=(evt)=>{

    //con guion y diagonales
    var code = (evt.which) ? evt.which : evt.keyCode;
    // console.log(code)
    if((code==8) || code == 32 || code == 44 ||(code>=48 && code<=57) || (code>=65 && code<=90)  || (code>=97 && code<=122) || (code==241) || (code==209) || code == 45 || code == 47) 
    {
        return true;
    }
    else
    {
        return false;
    }
}
const sinSimbolos4=(evt)=>{

    //con guion y diagonales
    var code = (evt.which) ? evt.which : evt.keyCode;

    if((code==8) || (code>=46&& code<=57) || (code>=65 && code<=90) || (code>=97 && code<=122) || code == 32 || code == 45 ||code == 164) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

const confirmarBorrado = (id, tipo) =>{
    
    Swal.fire({
        title: '¿Desea borrar este registro?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'No'
        }).then((result) => {
        if (result.value) {
            eliminarRegistro(id)
        }
        })
}

const items = document.querySelectorAll(".nav-link, .dropdown-item")

window.addEventListener("load", e => {
    items.forEach(item => {

        if(item.href == location.href){
            // console.log(item.href);
            item.classList.add('active')
            if(item.parentElement.parentElement.previousElementSibling){
                item.parentElement.parentElement.previousElementSibling.classList.add('active')

            }
        }
    })
})

const limpiar = ( formulario ) => {
    formulario.reset();
}

let validacionNits = false;
const validarNit=(e)=>{
    let nit = e.target.value;

    
    if(nit.length >=7){
        nit = nit.toUpperCase()
            numbers = Array.from(nit)
            j=1;
            let count =0,num=0
            for(let i = nit.length -2 ; i>=0;i-- ){
                j++;
                num = numbers[i]*(j) 
                count = count+num 
                
            }
            modulo = count % 11
            console.log(modulo)
            resultado = 11-modulo
            if(numbers[ nit.length -1]=='k' || numbers[nit.length -1] == 'K'){
                numbers[nit.length -1]= 10
            }
            if(modulo !=0){
                if(resultado == numbers[nit.length -1]){
                    validacionNits = true
                    e.target.classList.remove('is-invalid')
                    e.target.classList.add('is-valid')
                }else{
                    validacionNits = false
                    e.target.classList.add('is-invalid')
                    e.target.classList.remove('is-valid')
                }
            }else{
                if(modulo == numbers[nit.length -1]){
                    validacionNits = true 
                    e.target.classList.remove('is-invalid')
                    e.target.classList.add('is-valid')
                }else{
                    validacionNits = false
                    e.target.classList.add('is-invalid')
                    e.target.classList.remove('is-valid')
                    
                }
            }
        
    }else{
        nitvalido = false
        e.target.classList.add('is-invalid')
    }
    return nitvalido;
}


const validarFormulario = (formulario, excepciones = [] ) => {
    const elements = formulario.querySelectorAll("input, select, textarea");
    let validarFormulario = []
    elements.forEach( element => {
        if(!element.value.trim() && ! excepciones.includes(element.id) ){
            element.classList.add('is-invalid');
          
            validarFormulario.push(false)
        }else{
            element.classList.remove('is-invalid');
        }
    });

    let noenviar = validarFormulario.includes(false);

    return !noenviar;
}


const removerValidaciones = (formulario) =>{
    const elements = formulario.querySelectorAll("input, select, textarea");
    elements.forEach( element => {
       
        element.classList.remove('is-invalid');
        
    });
}


const alertToast = (tipo = 'succes', titulo = 'Operación exitosa') =>{
    Swal.fire({
        icon: tipo,
        title: titulo,
        toast: true,
        position: 'top-end',
        timer: 2000,
        showConfirmButton: false,
        timerProgressBar: true
    });
}




