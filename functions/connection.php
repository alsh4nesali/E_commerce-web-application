<?php
    $host='localhost';
    $name="root";
    $mypass="";
    $dbms="bookhaven"; 

    $con = mysqli_connect($host,$name,$mypass,$dbms);
    if (!$con) die('Could not connect: ' . mysql_error());
    mysqli_select_db($con,$dbms) or die("cannot select DB" . mysql_error());
?>