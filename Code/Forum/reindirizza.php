<?php
session_start();
 echo $_POST['codDiscussione'];
 $_SESSION['codDiscussione'] = $_POST['codDiscussione'];
 echo "<br />".$_SESSION['codDiscussione'];
 $_SESSION['codice'] = $_SESSION['codDiscussione'];
 header("Location:discussione.php");