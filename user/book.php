<?php
include_once "../server.php";
// session_start();
// unset($_SESSION['booking_id']);
// unset($_SESSION['seat']);
$transport_id = mysqli_real_escape_string($db, $_POST['transport_id']);
$date = mysqli_real_escape_string($db, $_POST['date']);
$seat = mysqli_real_escape_string($db, $_POST['seat']);

if(empty($transport_id)) { array_push($errors, "Transport ID required"); echo"1";}
if(empty($date)) {array_push($errors, "Date is required"); echo "2";}
if(empty($seat)) {array_push($errors, "Seat count is required"); echo "3";}
// include_once './errors.php';
$query = 'SELECT * FROM `transport` WHERE `id` = "'.$transport_id.'" AND `availability`>="'.$seat.'"';
$result = mysqli_query($db, $query);

if(mysqli_num_rows($result) == 0){
  array_push($errors, "Seat no available");
}

if(count($errors) != 0){
  header('Location: search.php');
}


$query='SELECT * FROM `transport` WHERE `id` = "'.$transport_id.'"';
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$fare = $row['fare'];
$query =  'INSERT INTO `tickets` (`transport_id`, `date`, `fare`, `user_id`, `seats`, `status`) VALUES ("'.$transport_id.'", "'.$date.'", "'.$row['fare']*$seat.'", "'.$_SESSION['userId'].'", "'.$seat.'", "0")';
$result = mysqli_query($db, $query);
$last_id = mysqli_insert_id($db);
// echo($last_id);
if($result){
  $query = 'UPDATE `transport` SET `availability`=`availability`-'.$seat.' WHERE `id`="'.$transport_id.'"';
  $result = mysqli_query($db, $query);
  if($result){
    $_SESSION['fare']=$fare*$seat;
  }
}


$_SESSION['booking_id'] = $last_id;
$_SESSION['seat'] = $seat;
// echo("seat".$_SESSION['seat']);
header('location: get_passenger.php');
 ?>
