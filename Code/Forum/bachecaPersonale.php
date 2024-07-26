<!--Questa è la pagina scheletro di ogni bacheca personale-->
<?php 
session_start();
require "funzioniUtili.php";
require "../connection.php";
$conta=1;
if(isset($_SESSION['username']))
$username = $_SESSION['username'];
else{
    session_destroy();
    header("Location: ../reservedArea.php");
}

if($username==="admin"){
    echo "comando io";
}else{
    if($conta==1){echo popUp($_SESSION['username']); }


    $sql = "select * from utenti where nomeUtente='$username'";
    $result=mysqli_query($conn,$sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            echo $row['nomeUtente'];
            $avatar=$row['nomeFileAvatar'];
            
    
        }
    }//end if result
    
    $path = "../Avatar/".$avatar;
    
    echo "<img src='$path'/>";
    
    
    
}//end else admin
  




