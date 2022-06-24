     <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                     <center>       <img src="assets/images/profile-image.png" class="circle" alt=""></center>
                        </div>
                        <div class="sidebar-profile-info">
                    <?php
$eid=$_SESSION['eid3'];
$sql = "SELECT FirstName,LastName,EmpId from  tblemployees where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);  
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>
                               <center>  <p><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p> </center>
                               <center> M:<?php echo htmlentities($result->EmpId)?> </center>
                         <?php }} ?>
                        </div>
                    </div>
                   
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">


  <li class="no-padding"><a class="waves-effect waves-grey" href="emp-changepassword.php"><i class="material-icons">settings_input_svideo</i>Change Mot De passe </a></li>
                    <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">apps</i>Congés<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="apply-leave.php">Demande De Congé</a></li>
                                <li><a href="leavehistory.php">Congés Historique</a></li>
                            </ul>
                        </div>
                    </li>



                  <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php"><i class="material-icons">exit_to_app</i>Quitter</a>
                            </li>


                </ul> 
                </div>
            </aside>
