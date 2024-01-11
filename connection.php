<?php
$con = mysqli_connect("localhost","root","root","doctor");
if(!$con)
{
    die('Could not connect: ' . mysqli_error($con));
}
?>