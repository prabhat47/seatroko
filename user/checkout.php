<?php
include_once 'server.php';
include_once 'header.php';
for ($i=1; $i <= $_SESSION['seat']; $i++) {
  $name="name".$i;
  $age="age".$i;
  $query='INSERT INTO `passangers` ( `ticket_id`, `name`, `age`) VALUES ( "'.$_SESSION['booking_id'].'", "'.$_POST[$name].'", "'.$_POST[$age].'")';
  $result = mysqli_query($db,$query);
}

$query = 'UPDATE `tickets` SET `status`="1" WHERE `id`="'.$_SESSION['booking_id'].'"';
$result = mysqli_query($db,$query);
unset($_SESSION['booking_id']);
unset($_SESSION['seat']);
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
