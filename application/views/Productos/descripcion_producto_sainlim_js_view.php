<script>
    var canvasIndex = ['saimlimChart'];

    for(i in canvasIndex){
        generaGraficaScatter(canvasIndex[i]);
    }

    function generaGraficaScatter(id){
        var ctx = document.getElementById(id);
        var valoresY = ctx.getAttribute('data-x').split(',');
        var valoresX = ctx.getAttribute('data-y').split(',');
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

        var mediaX = contaX/valoresX.length;
        var mediaY = contaY/valoresX.length;

        var sainLine = {};
        sainLine['type'] = 'line';
        sainLine['data'] = [
            {
                x: 0,
                y: mediaY
            },
            {
                x: maxX+50,
                y: mediaY
            },
        ];
        sainLine['borderColor'] = ['rgba(255,0,0,1)'];
        sainLine['label'] = 'SAIN';
        conjunto.push(sainLine);

        var limLine = {};
        limLine['type'] = 'line';
        limLine['data'] = [
            {
                x: mediaX,
                y: 0
            },
            {
                x: mediaX,
                y: maxY+50
            },
        ];
        limLine['borderColor'] = ['rgba(0,143,57,1)'];
        limLine['label'] = 'LIM';
        conjunto.push(limLine);

        var myChart = new Chart(ctx, {
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
                    xAxes: [{
                      scaleLabel: {
                        display: true,
                        labelString: "LIM",
                        fontColor: "orange"
                      }
                    }],
                    yAxes: [{
                      scaleLabel: {
                        display: true,
                        labelString: "SAIN",
                        fontColor: "green"
                      }
                    }]
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