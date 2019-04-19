<?php

include_once '../server.php';
include_once 'header.php';
$name = mysqli_real_escape_string($db, $_POST['name']);
$mode = mysqli_real_escape_string($db, $_POST['mode']);
$source = mysqli_real_escape_string($db, $_POST['source']);
$destination = mysqli_real_escape_string($db, $_POST['destination']);
$fare = mysqli_real_escape_string($db, $_POST['fare']);
$duration = mysqli_real_escape_string($db, $_POST['duration']);
$day = mysqli_real_escape_string($db, $_POST['day']);
$availability = mysqli_real_escape_string($db, $_POST['availability']);
$time = mysqli_real_escape_string($db, $_POST['time']);

$query = 'INSERT INTO `transport` ( `mode`, `name`, `source`, `destination`, `fare`, `duration`, `day`, `availability`, `time`) VALUES ("'.$mode.'", "'.$name.'", "'.$source.'", "'.$destination.'", "'.$fare.'", "'.$duration.'", "'.$day.'", "'.$availability.'", "'.$time.'")';
// echo($query);
$result = mysqli_query($db, $query);

if($result){
  echo('

<div class="container">
	<div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
        <br><br> <h2 style="color:#0fad00">Success</h2>

        <a href="index.php" class="btn btn-success">     Home      </a>
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
        <br><br> <h2 style="color:#f44242">Error</h2>

        <a href="" class="btn btn-danger">    Home      </a>
    <br><br>
        </div>

	</div>
</div>');
}

 ?>
