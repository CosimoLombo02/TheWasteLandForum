<?php
session_start();
 echo $_POST['codDiscussione'];
 $_SESSION['codDiscussione'] = $_POST['codDiscussione'];
 echo "<br />".$_SESSION['codDiscussione'];
 header("discussione.php");