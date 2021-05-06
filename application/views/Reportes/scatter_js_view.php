<script>
    var canvasIndex = ['saimlimChart'];

    for(i in canvasIndex){
        generaGraficaScatter(canvasIndex[i]);
    }

    function getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min)) + min;
    }

    function generaGraficaScatter(id){
        var ctx = document.getElementById(id);
        var valoresY = ctx.getAttribute('data-x').split(',');
        var valoresX = ctx.getAttribute('data-y').split(',');
        var etiquetas = ctx.getAttribute('data-labels').split(',');
        var unidad = ctx.getAttribute('data-unit');
        var maxX = 0;
        var maxY = 0;
        var conjunto = [];
        for (var i = 0; i < valoresX.length; i++) {
            var valores = [];
            valores.push([valoresX[i], valoresY[i]]);

            //conjunto.push([label:etiquetas[i], data:valores])
            var r = getRandomInt(0, 256);
            var g = getRandomInt(0, 256);
            var b = getRandomInt(0, 256);
            var obj = {};
            obj['type'] = 'scatter';
            obj['label'] = etiquetas[i];
            obj['data'] = valores;
            obj['backgroundColor'] = ['rgba('+r+', '+g+', '+b+', 0.2)'];
            obj['borderColor'] = ['rgba('+r+', '+g+', '+b+', 1)'];
            conjunto.push(obj);
        }
        console.log(maxY + ", " + maxX);

        var sainLine = {};
        sainLine['type'] = 'line';
        sainLine['data'] = [[0,5], [50,5]];
        sainLine['borderColor'] = ['rgba(255,0,0,1)'];
        sainLine['label'] = 'SAIN';
        conjunto.push(sainLine);

        var limLine = {};
        limLine['type'] = 'line';
        limLine['data'] = [[7,0], [7,30]];
        limLine['borderColor'] = ['rgba(0,143,57,1)'];
        limLine['label'] = 'LIM';
        conjunto.push(limLine);

        var myChart = new Chart(ctx, {
            /*type: 'scatter',*/
            data: {
                labels: etiquetas,
                /*datasets: [{
                    label: unidad,
                    data: valores,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]*/
                datasets: conjunto,
                /*datasets: [
                    {
                      label: 'Dataset 1',
                      data: [{x: -10, y: 0}],
                      backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                      borderColor: ['rgba(255, 99, 132, 1)']
                    },
                    {
                      label: 'Dataset 2',
                      data: [{x: -2, y: 10}],
                      backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                      borderColor: ['rgba(54, 162, 235, 1)']
                    }
                ],*/
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
                        display: false,
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