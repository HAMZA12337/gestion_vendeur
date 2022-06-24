<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['signin']))
{
$uname=$_POST['EmpId'];
$password=$_POST['password'];
$sql ="SELECT id FROM tblemployees WHERE EmpId=:uname  and Passsword=:password  ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
  foreach ($results as $result) {
    $_SESSION['eid1']=$result->id;
    echo $_SESSION['eid1'];
  }


  $_SESSION['emplogin1']=$_POST['EmpId'];
  $_SESSION['alogin']=$_POST['EmpId'];
 
echo "<script type='text/javascript'> document.location = 'admin/accueil.php'; </script>";








} 

else{

 $msg="Matricule ou Mot de passe est incorrecte!!.";

}

}



?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Title -->
        <title>Finetti | accueil</title>
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">


        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>

<style>
 h1 {
  animation-duration: 4s;
  animation-name: slidein;
  color: white;
  margin-left:400px;
  font-size:40px;

  margin-bottom:3px;
  margin-top:3px;
}

@keyframes slidein {
  from {
    margin-left: 0%;
    width: 100%;
  }

  to {
    margin-left:100% ;
    width: 100%;
  }
}

.mn-inner{
background: url('assets/images/2.gif') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
height:100%;
}

.div1{


  font-size:15px;
  width:500px;
  height:400px;
  margin-top:10%;
  margin-left:5%;


}

@media(max-width: 500px){
	 
  .mn-inner{
background: url('assets/images/12.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
height:100%;

}

.div1{

position:absolute;
font-size:9px;
width:400px;
height:400px;
margin-top:220px ;
opacity:0.93;
padding-left:10px;

}

h1 {

  color: white;
  margin-left:100px;
  font-size:40px;

  margin-bottom:3px;
  margin-top:3px;
}

h6{
  font-size:10px;
  margin-left:2px;
}

}

.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}


    </style>

    </head>
    <body >
        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-spinner-teal lighten-1">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mn-content fixed-sidebar">
           


           
            <main  class="mn-inner" >
                <div  >
                    <div >
                     <center>   <div class="page-title"><h1>Service Vendeur.RH</h1></div></center><br>
              
                          <div class="div1" style="margin-left:10px;">
                              <div class="card white darken-1">

                                  <div class="card-content  "  >
                                      <span class="card-title" style="font-size:15px;">Connexion</span>
                                         <?php if($msg){?><div class="errorWrap"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                       <div class="row">
                                           <form class="col s12" name="signin" method="post">
                                               <div class="input-field col s12">
                                                 <h6>Matricule</h6>
                                                   <input id="username" type="text" name="EmpId" class="validate" placeholder="Matricule" autocomplete="off" required >
                                                   
                                               </div>
                                               <div class="input-field col s12">
                                               <h6>Mot De Passe</h6>
                                                   <input id="password" type="password" class="validate" name="password" placeholder="Mot De Passe" autocomplete="off" required>
                                                   <i class="fas fa-eye"></i>
                                               </div>
                                               <div class="col s12 right-align m-t-sm">

                                                   <input type="submit" name="signin" value="Sign in" class="waves-effect waves-light btn teal">
                                                   <div class="col s12 left-align">

<a href="forgot-password.php">Mot De Passe Oublié</a>
</div>
                                               </div>
                                               
                                           </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </main>

        </div>
        <div class="left-sidebar-hover" ></div>
<script>
;(function($) {

$.fn.letterDrop = function() {
  // Chainability
  return this.each( function() { 
  
  var obj = $( this );
  
  var drop = {
    arr : obj.text().split( '' ),
    
    range : {
      min : 1,
      max : 9
    },
    
    styles : function() {
      var dropDelays = '\n', addCSS;
      
       for ( i = this.range.min; i <= this.range.max; i++ ) {
         dropDelays += '.ld' + i + ' { animation-delay: 1.' + i + 's; }\n';  
       }
      
        addCSS = $( '<style>' + dropDelays + '</style>' );
        $( 'head' ).append( addCSS );
    },
    
    main : function() {
      var dp = 0;
      obj.text( '' );
      
      $.each( this.arr, function( index, value ) {

        dp = dp.randomInt( drop.range.min, drop.range.max );
        
        if ( value === ' ' )
          value = '&nbsp'; //Add spaces
        
          obj.append( '<span class="letterDrop ld' + dp + '">' + value + '</span>' );
        
      });
          
    }
  };
   
  Number.prototype.randomInt = function ( min, max ) {
    return Math.floor( Math.random() * ( max - min + 1 ) + min );
  };
  
  
  // Create styles
  drop.styles();


    // Initialise
    drop.main();
  });

};

}(jQuery));


// USAGE
$( 'h1' ).letterDrop();

    </script>
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>

    </body>
</html>
