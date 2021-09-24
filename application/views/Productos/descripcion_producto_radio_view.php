<script>
    var canvas = ['energiaRadar', 'lipidosRadar', 'azucaresRadar', 'grasasSatRadar', 'grasasTransRadar', 'sodioRadar'];

    for(i in canvas){
        generaGraficaRadio(canvas[i]);
    }

    function generaGraficaRadio(id){
        var ctx = document.getElementById(id);
        var valores = ctx.getAttribute('data-values').split(',');
        var etiquetas = ctx.getAttribute('data-labels').split(',');
        var colores = ctx.getAttribute('data-color').split(',');
        var unidad = ctx.getAttribute('data-unit');
        var titulo = ctx.getAttribute('data-title');
        var bgColor = [];
        var brColor = [];
        colores.forEach(function(estado){
            if (estado==1) {
                brColor.push('rgba(100, 0, 0, 1)');
                bgColor.push('rgba(170, 0, 0, 1)');
            }
            else{
                brColor.push('rgba(100, 100, 100, 0.5)');
                bgColor.push('rgba(170, 170, 170, 0.5)');
            }
        });
        var myChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: etiquetas,
                datasets: [{
                    label: unidad,
                    data: valores,
                    backgroundColor: bgColor,
                    borderColor: brColor,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            fontColor: "#000080",
                        }
                    },
                    title:{
                        display: false,
                        text: titulo,
                        color: 'rgba(170, 0, 0, 1)',
                        font: {
                            size: 18,
                        }
                    },
                    filler: {
                    propagate: false
                  },
                    'samples-filler-analyser': {
                    target: 'chart-analyser'
                  }
                },
                interaction: {
                  intersect: false
                },
                
                scales: {
                    x: {
                        ticks: {
                            display: false
                        }
                    },
                    y: {
                        ticks: {
                            display: false
                        }
                    },
                },
            }
        });
    }

</script>