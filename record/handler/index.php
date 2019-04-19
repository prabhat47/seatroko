<?php
// session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include('../server.php');
include_once 'header.php';

 ?>



<div class="container">


  <h2>Enter Transport details.</h2>
  <form action="add_transport.php" method="POST">

    <div class="form-group">
      <label for="name">Name:</label>
      <input type="Text" class="form-control" placeholder="Enter name" name="name" required>
    </div>
    <div class="form-group">
      <label for="mode">Mode:</label>
      <select class="form-control" name="mode">
        <option value="1">Flight</option>
        <option value="2">Bus</option>
        <option value="3">Train</option>
      </select>
    </div>
    <div class="form-group row">
      <div class="col-xs-6">
        <label for="email">Source:</label>
        <select class="form-control" name="source">

            <?php
            // echo("hello");
            $query = 'SELECT * FROM `city`';
            $result = mysqli_query($db,$query);
            // $result1= $result;
            // echo(mysqli_num_rows($result));
            while ($row = mysqli_fetch_assoc($result)) {
              echo('<option value="'.$row['id'].'">'.$row['city'].'</option>');
            }
             ?>
        </select>
      </div>
      <div class="col-xs-6">
        <label for="email">Destination:</label>
        <select class="form-control" name="destination">
          <?php
          $query = 'SELECT * FROM `city`';
          $result = mysqli_query($db,$query);
          $result1= $result;
          // echo(mysqli_num_rows($result));
          while ($row = mysqli_fetch_assoc($result)) {
            echo('<option value="'.$row['id'].'">'.$row['city'].'</option>');
          }
           ?>
        </select>
      </div>

    </div>
    <div class="form-group">
      <label for="fare">Fare:</label>
      <input type="Number" class="form-control" placeholder="Enter fare" name="fare" required>
    </div>
    <div class="form-group">
      <label for="duration">Duration:</label>
      <input type="Number" class="form-control" placeholder="Enter duration" name="duration" required>
    </div>
    <div class="form-group">
      <label for="day">Days:</label>
      <input type="Text" class="form-control" placeholder="Enter Days (1,3,5)" name="day" required>
    </div>
    <div class="form-group">
      <label for="availability">Availability:</label>
      <input type="Number" class="form-control" placeholder="Enter availability" name="availability" required>
    </div>
    <div class="form-group">
      <label for="time">Time:</label>
      <input type="time" class="form-control" placeholder="Enter time" name="time" required>
    </div>



    <button type="submit" class="btn btn-default">Add </button>
  </form>
</div>

</body>
</html>
