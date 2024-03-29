<script>
    var canvasIndex = ['ffChart'];

    for(i in canvasIndex){
        generaGraficaSens(canvasIndex[i]);
    }

    function generaGraficaSens(id){
        var ctx = document.getElementById(id);
        var valores = document.getElementById('data-values');
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
            type: 'bar',
            data: {
                labels: etiquetas,
                datasets: [{
                    data: valores,
                    backgroundColor: bgColor,
                    borderColor: brColor,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            display: false
                        }
                    },
                    y: {
                        ticks: {
                            display: true
                        }
                    },
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        position: 'bottom',
                        labels: {
                          boxWidth: 80,
                          fontColor: 'black'
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
            }
        });
    }

    

</script>