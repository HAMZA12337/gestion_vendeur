<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Dashboard</title>
        <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">

        	
        <!-- Theme Styles -->
         <script type="text/javascript" src="./charts/js/jquery.min.js"></script>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/> 
       <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        
        
        <script type="text/javascript" src="./charts/js/Chart.min.js"></script> 
         
        <style>

#chart {
                    width:70%;
                    padding-left: 12%;
                    margin-left:100px;
                    margin-top:0px !important;
                    padding-top:0px !important;
                    padding-left:0px !important;
                }
                
                #chart-container {
                    width: 100%;
                    height: auto;
                }



</style>











    </head>




    




    <body>
           <?php include('includes/header.php');?>
         
       <?php include('includes/sidebar.php');?>
     
            <main class="mn-inner py-0">
                <div class="middle-content">
                    <div class="row no-m-t no-m-b">
                    <div class="col s12 m12 l4">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Nombre d'Agences </span>
                                <span class="stats-counter">
<?php
$sql = "SELECT id from region";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$empcount=$query->rowCount();
?>

                                    <span class="counter"><?php echo htmlentities($empcount);?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                        <div class="col s12 m12 l4">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Nombre de Vendeurs Actifs </span>
    <?php
$sql = "SELECT * from vendeur where STATUS=0";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$dptcount=$query->rowCount();
?>                            
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($dptcount);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
                    <div class="col s12 m12 l4">
                        <div class="card stats-card">
                            <div class="card-content">
                                <span class="card-title">Le meilleur vendeur</span>
                                    <?php
                                    $yea=date('Y');
                                    $mon=date('m')-1;
                                    ECHO $yea ." / ".$mon;
$sql = "SELECT s.nomp,s.prenom from operation2 v join vendeur s on v.pda=s.pda where year(v.date_ver)=:yea and month(v.date_ver)=:mon
and v.net_pay=(select max(net_pay) from operation2 where year(date_ver)=:yea  and month(date_ver)=:mon )";
$query = $dbh -> prepare($sql);
$query->bindParam(':yea',$yea,PDO::PARAM_STR);
$query->bindParam(':mon',$mon,PDO::PARAM_STR);

$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$leavtypcount=$query->rowCount();
foreach($results as $result)
{ 
?>   
    <!-- <?php echo htmlentities($result->nomp);?> -->
                              <p style='color:#40A6AA; font-family: "Lucida Console", "Courier New", monospace;'><?php echo htmlentities($result->nomp).' '.htmlentities($result->prenom);?></p>
                                <?php }?> 
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                 
                     </div>
                     <aside id="chart">
        <center>
        <!-- ____________________________________________________________________________________________
        <!-- <h1>STATISTIQUES DES VENDEURS</h1> -->
        <!-- _____________________________________________________________________________________________  -->
        </center>
        <div id="chart-container">
            <canvas id="graphCanvas"></canvas>
        </div>
        <center>
            </aside>
       
              
            </main>

            
            
        
            <script>
        $(document).ready(function () {
            barChart();
            
        });
        function barChart() {
            {
                $.post("./charts/datas.php",
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
    

    
        <!-- Javascripts -->
        

        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../assets/plugins/chart.js/chart.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/dashboard.js"></script>
       

        <!-- <script type="text/javascript" src="./charts/js/jquery.min.js"></script> -->
        <script type="text/javascript" src="./charts/js/Chart.min.js"></script> 















        
         
    </body>
</html>
<?php } ?>