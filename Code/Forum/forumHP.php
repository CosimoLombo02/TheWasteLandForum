<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title> Home page forum</title> 
    <!--<link rel="stylesheet" href="foglioDiStile.css " type="text/css" /></head>-->
    <link rel ="stylesheet" href="CSS/homepage.css" type = "text/css" />
    <link rel="icon" type="image/x-icon" href="ImmaginiVideoSito/favicon.ico"/> <!--Rubata dai dati di gioco di Fallout New Vegas-->
    <link href='https://fonts.googleapis.com/css?family=Share Tech Mono' rel='stylesheet'/> <!--font di usato nei terminali presenti in Fallout-->
    <style type="text/css">
        body {
            font-family: 'Share Tech Mono';font-size: 22px;
            background-color: black;
        }
    </style>
</head>
<body>
    <!--i link cambiano a seconda se si è loggati o meno-->
    <?php if(isset($_SESSION['username'])){

            echo "<div class='topnav'><a href='logout.php'>Logout</a><a href='#'>Forum</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a></div>";

        }else{

            echo "<div class='topnav'><a href='reservedArea.php'>Login</a><a href='#'>Forum</a><a href='fallout1.php'>Fallout 1</a><a href='fallout2.php'>Fallout 2</a><a href='fallout3.php'>Fallout 3</a><a href='fallout4.php'>Fallout 4</a><a href='falloutT.php'>Fallout Tactics</a><a href='falloutB.php'>Fallout Brotherhood Of Steel</a><a href='falloutN.php'>Fallout New Vegas</a><a href='fallout76.php'>Fallout 76</a></div>";


            }//end else?>
    

    <div class="container">
        <div class="itemText">
            <p style="color:green">Questa è la pagina principale del forum, qui potrai trovare e/o creare discussioni 
                su qualsiasi media della saga
            </p>
        </div>
    </div>

    <div class="container">
        <div class="videoCentrato">
        <video width="480" height="360" controls>
        <source src="ImmaginiVideoSito/videoPagPrincipale.mp4" type="video/mp4">
        </video> 
        </div>
        <!--<div class="item"></div>-->
    </div>



</body>


</html> 