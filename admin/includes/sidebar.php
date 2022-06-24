     <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    
                    <center>
                   
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image" title="Clicker pour changer votre mot de passe">
                        <a href="changepassword.php"> <img src="../assets/images/profile-image.png" class="circle" alt=""> </a>
                        </div>
                        <div class="sidebar-profile-info">
                        <?php
$eid=$_SESSION['eid1'];
$sql = "SELECT FirstNAME,LastNAME,EmpId from  tblemployees where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);  
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>
                               <center>  <p><?php echo htmlentities($result->FirstNAME." ".$result->LastNAME);?></p> </center>
                              
                         <?php }} ?>
                        <!-- <a href="changepassword.php" title="Clicker pour changer votre mot de passe"> <p style="cursor: pointer;">Espace DRH</p></a> -->

                         
                        </div>
                    </div>
                   
                </center>
    
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                    <li class="no-padding"><a class="waves-effect waves-grey" href="dashboard.php"><i class="material-icons">settings_input_svideo</i>tableau de bord</a></li>
                  

                    <li class="no-padding">
                        <a href="manageregion.php" class="collapsible-header waves-effect waves-grey"><i class="material-icons">my_location</i>Région</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="#"></a></li>
                              
                            </ul>
                        </div>
                    </li> 
                    <li class="no-padding">
                        <a href="managesecteur.php" class="collapsible-header waves-effect waves-grey"><i class="material-icons">add_location</i>Secteur</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="#"></a></li>
                              
                            </ul>
                        </div>
                    </li>


                    







                 
                    <!-- <li class="no-padding">
                        <a  href="manageemployee.php" class="collapsible-header waves-effect waves-grey"><i class="material-icons">card_travel</i>Vendeur</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="#"></a></li>
                                
       
                            </ul>
                        </div>
                    </li> -->

   <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">card_travel</i>Vendeur<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="manageemployee.php"> Vendeur actif</a></li>
                                <li><a href="pending-leavehistory.php">Vendeur Hors service </a></li>
                               
       
                            </ul>
                        </div>
                    </li>




                        <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php"><i class="material-icons">exit_to_app</i>Quitter</a>
                            </li>  
                 

                 
              
                </ul> 
                </div>
            </aside>