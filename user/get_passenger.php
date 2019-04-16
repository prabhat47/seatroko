<?php
// session_start();
include('server.php');
include_once 'header.php';

 ?>



<div class="container">

  <h1>Total Fare = Rs. <?php echo($_SESSION['fare']); ?></h1>
  <h2>Enter passenger details.</h2>
  <form action="checkout.php" method="POST">

    <?php
    // echo($_SESSION['seat']);
    for ($i=1; $i <= $_SESSION['seat'] ; $i++) {
      echo('<h3>Passanger '.$i.'</h3>');
      echo('<div class="form-group">
        <label for="name">Name:</label>
        <input type="Text" class="form-control" placeholder="Enter name" name="name'.$i.'" required>
      </div>
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" class="form-control" placeholder="Enter age" name="age'.$i.'" required>
      </div>');
    }
     ?>


    <button type="submit" class="btn btn-default">Pay </button>
  </form>
</div>

</body>
</html>
