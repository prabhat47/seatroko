<?php

include_once 'server.php';
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include_once 'header.php';


$ticket_id = $_POST['ticket_id'];

$query = 'SELECT * FROM `tickets` WHERE `id`="'.$ticket_id.'"';
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$seat = $row['seats'];
$transport_id = $row['transport_id'];

$query = 'UPDATE `tickets` SET `status`="-1" WHERE `id`="'.$ticket_id.'"';
$result = mysqli_query($db, $query);


$query = 'UPDATE `transport` SET `availability`=`availability`+'.$seat.' WHERE `id`="'.$transport_id.'"';
$result = mysqli_query($db, $query);

if($result){
  echo('

<div class="container">
	<div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
        <br><br> <h2 style="color:#0fad00">Successfully Cancelled</h2>


    <br><br>
        </div>

	</div>
</div>');
}
else{
  echo('
<div class="container">
	<div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
        <br><br> <h2 style="color:#f44242">Error canceling</h2>


    <br><br>
        </div>

	</div>
</div>');
}
 ?>
