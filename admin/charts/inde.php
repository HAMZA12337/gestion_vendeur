
        <!-- <style type="text/css">
            #chart {
                    width:60%;
                    padding-left: 12%;
                    margin-left:300px;
                    margin-top:200px;
                }
                
                #chart-container {
                    width: 100%;
                    height: auto;
                }
        </style> -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/Chart.min.js"></script>
   
    <aside id="chart">
        <center>
        ____________________________________________________________________________________________
        <h1>STATISTIQUES DES VENDEURS</h1>
        _____________________________________________________________________________________________
        </center>
        <div id="chart-container">
            <canvas id="graphCanvas"></canvas>
        </div>
        <center>
            </aside>
       
    <script>
        $(document).ready(function () {
            barChart();
            
        });
        function barChart() {
            {
                $.post("datas.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [0.1,0.9,0.4,0.43,0.23,0.54,1];
                    for (var i in data) {
                        name.push(data[i].nomp);
                        marks.push(data[i]);
                    }
                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'STATISTIQUES DES VENDEURS',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }
                        ]
                    };
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,    
            borderWidth: 1
                    });
                });
            }
        }
       
    </script>
<script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/Chart.min.js"></script>