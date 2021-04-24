<script>
    var canvas = ['energiaChart', 'azucaresaChart', 'acidosgsChart', 'lipidosChart', 'sodioChart', 'hidratosChart', 'fibraChart', 'proteinaChart'];

    for(i in canvas){
        generaGrafica(canvas[i]);
    }

    function generaGrafica(id){
        var ctx = document.getElementById(id);
        var valores = ctx.getAttribute('data-values').split(',');
        var etiquetas = ctx.getAttribute('data-labels').split(',');
        var unidad = ctx.getAttribute('data-unit');
        var myChart = new Chart(ctx, {
            type: 'radar',
            data: {
                /*labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],*/
                labels: etiquetas,
                datasets: [{
                    label: unidad,
                    /*data: [12, 19, 13, 15, 12, 3],*/
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
                }]
            },
            options: {
                /*scales: {
                    y: {
                        beginAtZero: true
                    }
                },*/
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

    $(function(){

        $('.btn-graph').on('click', function(){
            var graph = $(this).attr('data');
            var display = $('#'+graph).css('display');
            if (display=='none') {
                $('#'+graph).show(200);
            }
            else{
                $('#'+graph).hide(200);
            }
            return false;
        });

        $('.btn-summary').on('click', function(){
            var summary = $(this).attr('data');
            var display = $('#'+summary).css('display');
            if (display=='none') {
                $('#'+summary).show(200);
            }
            else{
                $('#'+summary).hide(200);
            }
            return false;
        });

        $('.btn-remove').on('click', function(){
            $(this).parent().parent().parent().parent().hide(200);
        });

    })

</script>