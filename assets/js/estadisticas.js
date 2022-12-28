const formFiltro = document.getElementById('formFiltro');

const getEstadisticas = async (inicio, fin) => {
    const url = `../API/estadisticas/usuarios.php?inicio=${inicio}&fin=${fin}`;
    const config = {
        method : 'GET'
    }
    try {
        const response = await fetch(url,config);
        const data = await response.json();
        // console.log(data);
        const { usuarios, iniciadas, finalizadas, certificaciones } = data;
        document.getElementById('datoUsuarios').innerText = usuarios;
        document.getElementById('datoIniciadas').innerText = iniciadas;
        document.getElementById('datoFinalizadas').innerText = finalizadas;
        document.getElementById('datoCertificaciones').innerText = certificaciones;
    } catch (error) {
        console.log(error);
    }
}

const generaGraficoDependencias = async (inicio, fin) => {
    const ctx = document.getElementById('graficoDependencias');
    const url = `../API/estadisticas/comandos.php?inicio=${inicio}&fin=${fin}`;
    const config = {
        method : 'GET'
    }
    window.chartComandos && window.chartComandos.destroy()
    try {
        const response = await fetch(url,config);
        const data = await response.json();
        // console.log(data);
        let labels = [];
        let activos = []
        let evaluados = []
        let iniciados = []
        let certificados = []
        data.forEach(d => {
            labels = [...labels , d.comando];
            activos = [...activos , d.activos];
            evaluados = [...evaluados , d.evaluados];
            iniciados = [...iniciados , d.iniciados];
            certificados = [...certificados , d.certificados];
        });

        let dataGrafico = {
            type : 'bar',
            data : { 
                datasets: [{
                        label: 'U. ACTIVOS',
                        backgroundColor: 'rgb(255, 99, 132)',
                        data: activos,
                        barThickness : 10,
                        maxBarThickness : 15
                        
                    }, 
                    {
                        label: 'U. CERTIFICADOS',
                        backgroundColor: 'rgb(255, 102, 255)',
                        data: certificados,
                        barThickness : 10,
                        maxBarThickness : 15
                    },
                    {
                        label: 'E. INICIADAS',
                        backgroundColor: 'rgb(0, 204, 0)',
                        data: iniciados,
                        barThickness : 10,
                        maxBarThickness : 15
                    },
                    {
                        label: 'E. TERMINADAS',
                        backgroundColor: 'rgb(0, 128, 255)',
                        data: evaluados,
                        barThickness : 10,
                        maxBarThickness : 15
                    },
                  
                ],
                labels: labels,
               
            },
            options: {
                responsive: true,
                interaction: {
                    intersect: false,
                },
                indexAxis: 'y',
                plugins: {
                    title: {
                        display: true,
                        text: 'ESTADISTICAS POR COMANDO'
                    },
                 
                },
                scales: {
                    y: {
                        ticks: {
                        
                            stepSize: 1
                        }
                    },
                }
              }
        }
        window.chartComandos = new Chart( ctx, dataGrafico )
        window.chartComandos.update();
        // console.log(labels);
    } catch (error) {
        console.log(error);
    }


}   

const buscarEstadisticas = e => {
    e && e.preventDefault();
    let inicio = formFiltro.inicio.value;
    let fin = formFiltro.fin.value;

    getEstadisticas(inicio, fin);
    generaGraficoDependencias(inicio, fin);

}

buscarEstadisticas();
formFiltro.addEventListener('submit', buscarEstadisticas )
