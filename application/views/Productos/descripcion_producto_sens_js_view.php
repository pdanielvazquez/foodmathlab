<script>
    var canvasIndex = ['sensChart'];

    for(i in canvasIndex){
        generaGraficaSens(canvasIndex[i]);
    }

    function generaGraficaSens(id){
        var ctx = document.getElementById(id);
        var valoresX = ctx.getAttribute('data-x').split(',');
        var valoresY = ctx.getAttribute('data-y').split(',');
        var etiquetas = ctx.getAttribute('data-labels').split(',');
        var colores = ctx.getAttribute('data-color').split(',');
        var titulo = ctx.getAttribute('data-title');
        var maxX = Math.max(...valoresX);
        var maxY = Math.max(...valoresY);
        var contaX = 0;
        var contaY = 0;
        var conjunto = [];
        for (var i = 0; i < valoresX.length; i++) {
            var valores = [];
            valores.push([valoresX[i], valoresY[i]]);
            contaX += parseInt(valoresX[i]);
            contaY += parseInt(valoresY[i]);
            var obj = {};
            obj['type'] = 'scatter';
            obj['label'] = etiquetas[i];
            obj['data'] = valores;
            if (parseInt(colores[i])==1) {
                obj['backgroundColor'] = ['rgba(170, 0, 0, 1)'];
                obj['borderColor'] = ['rgba(100, 0, 0, 1)'];
            }
            else{
                obj['backgroundColor'] = ['rgba(170, 170, 170, 0.5)'];
                obj['borderColor'] = ['rgba(100, 100, 100, 0.5)'];
            }
            conjunto.push(obj);
        }

        var myChart = new Chart(ctx, {
            /*type: 'scatter',*/
            data: {
                labels: etiquetas,
                datasets: conjunto,
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                      boxWidth: 80,
                      fontColor: 'black'
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 100
                    },
                    x: {
                        min: 0,
                        max: 100
                    }
                },
                responsive: true,
                plugins: {
                    title:{
                        display: true,
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